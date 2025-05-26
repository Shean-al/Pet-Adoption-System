<?php
session_start();
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
  $result = $conn->query($sql);
  if ($result->num_rows === 1) {
    $_SESSION['admin'] = $user;
    header("Location: index.php");
    exit();
  } else {
    $error = "Invalid credentials!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Pet Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="mb-4">
      <a href="index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Home
      </a>
    </div>
    
    <div class="login-container fade-in">
      <div class="text-center mb-4">
        <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
        <h2 class="mt-3">Admin Login</h2>
        <p class="text-muted">Please enter your credentials to continue</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
          <label class="form-label">
            <i class="bi bi-person"></i> Username
          </label>
          <input type="text" name="username" class="form-control" required 
                 placeholder="Enter your username">
        </div>
        <div class="mb-3">
          <label class="form-label">
            <i class="bi bi-key"></i> Password
          </label>
          <input type="password" name="password" class="form-control" required
                 placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Form validation
    (function () {
      'use strict'
      var forms = document.querySelectorAll('.needs-validation')
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
</body>
</html>