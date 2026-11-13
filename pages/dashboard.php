<?php
require '../config/auth.php';
$title = 'Dashboard';
ob_start();
?>

<div class="dashboard-header mb-3">
  <h5 class="mb-0">Dashboard</h5>
  <small class="text-muted">Stock summary and overview</small><br>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card summary-card">
      <div class="summary-icon">📦</div>
      <h4 id="total_products">0</h4>
      <small>Total Products</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card summary-card">
      <div class="summary-icon">⚠️</div>
      <h4 id="low_stock">0</h4>
      <small>Low Stock Items</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card summary-card">
      <div class="summary-icon">📥</div>
      <h4 id="stock_in_today">0</h4>
      <small>Stock In (Today)</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card summary-card">
      <div class="summary-icon">📤</div>
      <h4 id="stock_out_today">0</h4>
      <small>Stock Out (Today)</small>
    </div>
  </div>
</div>

<!-- BOTTOM SECTION -->
<div class="row g-3">
  <div class="col-md-6">
    <div class="card p-3">
      <h6 class="mb-1">Low Stock Alert</h6>

      <table class="table table-sm mt-2">
        <thead>
          <tr>
            <th>Product</th>
            <th>Current</th>
            <th>Min</th>
          </tr>
        </thead>
        <tbody id="lowStockTable"></tbody>
      </table>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card p-3">
      <h6 class="mb-1">Recent Transactions</h6>

      <table class="table table-sm mt-2">
        <thead>
          <tr>
            <th>Type</th>
            <th>Product</th>
            <th>Qty</th>
          </tr>
        </thead>
        <tbody id="recentTable"></tbody>
      </table>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
