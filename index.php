<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Cafe Stock Inventory</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">

<div class="login-wrapper">
  <div class="login-header text-center mb-3">
    <div class="login-logo mb-2"></div>
    <h5 class="fw-semibold">Cafe Stock Inventory System</h5>
    <small class="text-muted">Admin Dashboard</small>
  </div>

  <div class="login-card">
    <form id="loginForm">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Enter username" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Enter password" required>
      </div>

      <button type="submit" class="btn btn-dark w-100">Login</button>
    </form>

  </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
