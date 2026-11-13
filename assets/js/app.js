const API_BASE = 'http://localhost/cafeinv-api/api';

let editModal;
let addModal;

// ================================
// INIT GLOBAL (SATU KALI SAJA)
// ================================
document.addEventListener('DOMContentLoaded', () => {

  // === EDIT PRODUCT MODAL ===
  const editEl = document.getElementById('editModal');
  if (editEl && typeof bootstrap !== 'undefined') {
    editModal = new bootstrap.Modal(editEl);
  }

  // === ADD PRODUCT MODAL ===
  const addEl = document.getElementById('addModal');
  if (addEl && typeof bootstrap !== 'undefined') {
    addModal = new bootstrap.Modal(addEl);
  }

  // === PRODUCTS PAGE ===
  if (document.getElementById('productTable')) {
    loadProducts();
  }

  // === STOCK IN PAGE ===
  if (document.getElementById('stockin_product')) {
    loadProductsForSelect('stockin_product');
  }

  // === STOCK OUT PAGE ===
  if (document.getElementById('stockout_product')) {
    loadProductsForSelect('stockout_product');
  }

  // === DASHBOARD PAGE ===
  if (document.getElementById('total_products')) {
    loadDashboardSummary();
    loadLowStock();
    loadRecentTransactions();
  }

  console.log('app.js loaded safely');
});


// ================================
// PRODUCTS
// ================================
function loadProducts() {
  fetch(`${API_BASE}/products/index.php`)
    .then(res => res.json())
    .then(data => {
      const table = document.getElementById('productTable');
      table.innerHTML = '';

      data.forEach((item, index) => {
        const stock = Number(item.stock);
        const minStock = Number(item.min_stock);

        const statusBadge =
          stock <= minStock
            ? `<span class="badge bg-dark">LOW</span>`
            : `<span class="badge bg-secondary">OK</span>`;


        table.innerHTML += `
          <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.category}</td>
            <td>${item.stock}</td>
            <td>${item.min_stock}</td>
            <td>Rp ${item.price}</td>
            <td>${statusBadge}</td>
            <td class="text-center">
              <button class="btn btn-sm btn-warning me-1" onclick="openEditModal(${item.id})">Edit</button>
              <button class="btn btn-sm btn-danger" onclick="deleteProduct(${item.id})">Delete</button>
            </td>
          </tr>
          `;

      });
    });
}

function openEditModal(id) {
  fetch(`${API_BASE}/products/index.php?id=${id}`)
    .then(res => res.json())
    .then(data => {
      const item = data[0];

      const editId = document.getElementById('edit_id');
      if (!editId) {
        console.warn('Edit modal not found');
        return;
      }

      document.getElementById('edit_id').value = item.id;
      document.getElementById('edit_name').value = item.name;
      document.getElementById('edit_category').value = item.category;
      document.getElementById('edit_unit').value = item.unit;
      document.getElementById('edit_min_stock').value = item.min_stock;
      document.getElementById('edit_price').value = item.price;

      editModal.show();
    });
}



function updateProduct() {
  const data = {
  id: document.getElementById('edit_id').value,
  name: document.getElementById('edit_name').value,
  category: document.getElementById('edit_category').value,
  unit: document.getElementById('edit_unit').value,
  min_stock: document.getElementById('edit_min_stock').value,
  price: document.getElementById('edit_price').value
};


  fetch(`${API_BASE}/products/update.php`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(() => {
    document.activeElement.blur();
    editModal.hide();
    loadProducts();
  });
}

function deleteProduct(id) {
  if (!confirm('Yakin ingin menghapus produk ini?')) return;

  fetch(`${API_BASE}/products/delete.php`, {
    method: 'DELETE',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id })
  })
  .then(res => res.json())
  .then(() => loadProducts());
}


// ================================
// ADD PRODUCT (FINAL FIX)
// ================================
function openAddModal() {
  if (!addModal) {
    alert('Add modal belum siap');
    return;
  }
  addModal.show();
}

function addProduct() {
  const data = {
    name: add_name.value,
    category: add_category.value,
    unit: add_unit.value,
    stock: add_stock.value,
    min_stock: add_min_stock.value,
    price: add_price.value
  };

  if (!data.name || !data.category || !data.unit) {
    alert('Lengkapi data');
    return;
  }

  fetch(`${API_BASE}/products/store.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(resp => {
    if (resp.success) {
      addModal.hide();
      loadProducts();
    } else {
      alert(resp.message || 'Gagal tambah produk');
    }
  });
}


// ================================
// REUSABLE PRODUCT SELECT
// ================================
function loadProductsForSelect(selectId) {
  fetch(`${API_BASE}/products/index.php`)
    .then(res => res.json())
    .then(data => {
      const select = document.getElementById(selectId);
      if (!select) return;

      select.innerHTML = '<option value="">Select product</option>';
      data.forEach(p => {
        select.innerHTML += `<option value="${p.id}">${p.name}</option>`;
      });
    });
}


// ================================
// STOCK IN
// ================================
function submitStockIn() {
  const product_id = stockin_product.value;
  const qty = stockin_qty.value;

  if (!product_id || qty <= 0) {
    alert('Data tidak valid');
    return;
  }

  fetch(`${API_BASE}/stock/in.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_id, qty })
  })
  .then(res => res.json())
  .then(resp => {
    alert(resp.success ? 'Stock berhasil ditambahkan' : resp.message);
  });
}


// ================================
// STOCK OUT
// ================================
function submitStockOut() {
  const product_id = stockout_product.value;
  const qty = stockout_qty.value;

  if (!product_id || qty <= 0) {
    alert('Data tidak valid');
    return;
  }

  fetch(`${API_BASE}/stock/out.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_id, qty })
  })
  .then(res => res.json())
  .then(resp => {
    alert(resp.success ? 'Stock berhasil dikurangi' : resp.message);
  });
}


// ================================
// DASHBOARD
// ================================
function loadDashboardSummary() {
  fetch(`${API_BASE}/dashboard/summary.php`)
    .then(res => res.json())
    .then(data => {
      total_products.innerText  = data.total_products;
      low_stock.innerText       = data.low_stock;
      stock_in_today.innerText  = data.stock_in_today;
      stock_out_today.innerText = data.stock_out_today;
    });
}

function loadLowStock() {
  fetch(`${API_BASE}/dashboard/low-stock.php`)
    .then(res => res.json())
    .then(data => {
      const table = document.getElementById('lowStockTable');
      table.innerHTML = '';
      data.forEach(item => {
        table.innerHTML += `
          <tr>
            <td>${item.name}</td>
            <td>${item.stock}</td>
            <td>${item.min_stock}</td>
          </tr>
        `;
      });
    });
}

function loadRecentTransactions() {
  fetch(`${API_BASE}/dashboard/recent.php`)
    .then(res => res.json())
    .then(data => {
      const table = document.getElementById('recentTable');
      table.innerHTML = '';
      data.forEach(item => {
        table.innerHTML += `
          <tr>
            <td>${item.product_name}</td>
            <td><span class="badge ${item.type === 'IN' ? 'bg-success' : 'bg-secondary'}">
                  ${item.type}
                </span>
            </td>
            <td>${item.qty}</td>
            <td>${item.created_at}</td>
          </tr>
        `;
      });
    });
}

// ================================
// LOGIN
// ================================
const loginForm = document.getElementById('loginForm');

if (loginForm) {
  loginForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('http://localhost/cafeinv-api/api/auth/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username, password })
    })
      .then(res => res.json())
      .then(resp => {
        if (resp.success) {
          window.location.href = 'pages/dashboard.php';
        } else {
          alert(resp.message || 'Login gagal');
        }
      });
  });
}
