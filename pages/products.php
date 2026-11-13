<?php
require '../config/auth.php';
$title = 'Products';
ob_start();
?>

<!-- PAGE HEADER -->
<div class="page-header mb-3">
  <h5 class="mb-0">Product List</h5>
  <small class="text-muted">Manage inventory items</small>
</div>

<!-- ACTION BAR -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <div class="d-flex gap-2" style="width:60%">
    <input class="form-control" placeholder="Search products..." disabled>
    <select class="form-select" disabled>
      <option>All Categories</option>
    </select>
  </div>

  <button class="btn btn-dark" onclick="openAddModal()">+ Add Product</button>
</div>

<!-- TABLE -->
<div class="card p-3">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Current Stock</th>
        <th>Min Stock</th>
        <th>Unit Price</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="productTable"></tbody>
  </table>
</div>

<!-- ===== EDIT MODAL ===== -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h6 class="modal-title">Edit Product</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="edit_id">
        <input class="form-control mb-2" id="edit_name" placeholder="Product Name">
        <input class="form-control mb-2" id="edit_category" placeholder="Category">
        <input class="form-control mb-2" id="edit_unit" placeholder="Unit">
        <input class="form-control mb-2" id="edit_min_stock" type="number" placeholder="Min Stock">
        <input class="form-control mb-2" id="edit_price" type="number" placeholder="Unit Price">
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-dark" onclick="updateProduct()">Save</button>
      </div>

    </div>
  </div>
</div>

<!-- ===== ADD MODAL (WAJIB LENGKAP) ===== -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h6 class="modal-title">Add Product</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input class="form-control mb-2" id="add_name" placeholder="Product Name">
        <input class="form-control mb-2" id="add_category" placeholder="Category">
        <input class="form-control mb-2" id="add_unit" placeholder="Unit">
        <input class="form-control mb-2" id="add_stock" type="number" placeholder="Initial Stock">
        <input class="form-control mb-2" id="add_min_stock" type="number" placeholder="Min Stock">
        <input class="form-control mb-2" id="add_price" type="number" placeholder="Unit Price">
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-dark" onclick="addProduct()">Save</button>
      </div>

    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
