<?php
require '../config/auth.php';
$title = 'Stock In';
ob_start();
?>

<div class="page-header mb-3">
  <h5 class="mb-0">Stock In</h5>
  <small class="text-muted">Record incoming stock</small>
</div>

<div class="card p-4" style="max-width:600px">
  <h6 class="fw-bold mb-3">Stock In Form</h6>

  <div class="mb-3">
    <label class="form-label">Product</label>
    <select id="stockin_product" class="form-select">
      <option value="">Select product</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Quantity</label>
    <input type="number" id="stockin_qty" class="form-control" placeholder="Enter quantity">
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-dark" onclick="submitStockIn()">
      Save Stock In
    </button>
    <button class="btn btn-outline-secondary" onclick="location.reload()">
      Reset
    </button>
  </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
