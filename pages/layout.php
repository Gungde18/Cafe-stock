<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Cafe Stock' ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<div class="d-flex">

  <!-- SIDEBAR -->
  <aside class="sidebar p-3">
    <h5 class="text-white mb-4">Cafe Stock</h5>

    <a href="dashboard.php" class="nav-link">Dashboard</a>
    <a href="products.php" class="nav-link">Products</a>
    <a href="stock-in.php" class="nav-link">Stock In</a>
    <a href="stock-out.php" class="nav-link">Stock Out</a>
  </aside>

  <!-- MAIN AREA -->
  <div class="flex-grow-1">

    <!-- TOPBAR -->
    <nav class="navbar navbar-light bg-white border-bottom px-4">
      <span class="fw-semibold">Cafe Stock Inventory</span>

      <a href="logout.php" class="btn btn-outline-danger btn-sm">
        Logout
      </a>
    </nav>

    <!-- CONTENT -->
    <main class="main-content p-4">
      <?= $content ?>
    </main>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>
