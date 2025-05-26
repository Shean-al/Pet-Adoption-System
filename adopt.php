<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pet_id = $_POST['pet_id'];
  $name = $_POST['name'];
  $contact = $_POST['contact'];
  $message = $_POST['message'];

  $sql = "INSERT INTO requests (pet_id, adopter_name, adopter_email, message)
          VALUES ('$pet_id', '$name', '$contact', '$message')";

  if ($conn->query($sql)) {
    $success = "Your adoption request has been submitted successfully!";
  } else {
    $error = "Error: " . $conn->error;
  }
}
if (isset($_GET['pet_id'])) {
    $pet_id = $_GET['pet_id'];
} else {
    echo "No pet selected.";
    exit;
}


// Fetch pet details
$pet_sql = "SELECT * FROM pets WHERE id = '$pet_id'";
$pet_result = $conn->query($pet_sql);
$pet = $pet_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopt <?= $pet['name'] ?> - Shean's Pet Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <i class="bi bi-heart-fill text-primary me-2"></i>
        Shean's Pet Adoption
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="pets/list.php"><i class="bi bi-heart"></i> Adopt</a></li>
          <li class="nav-item"><a class="nav-link" href="admin/dashboard.php"><i class="bi bi-shield"></i> Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card fade-in">
          <div class="card-body p-4">
            <h2 class="page-header">Adoption Application</h2>
            
            <?php if (isset($success)): ?>
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo $success; ?>
              </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <?php if ($pet): ?>
            <div class="mb-4 text-center">
              <img src="assets/images/<?= $pet['image'] ?>" alt="<?= $pet['name'] ?>" 
                   class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
              <h3 class="mb-2">Adopting <?= $pet['name'] ?></h3>
              <p class="text-muted">Please fill out the form below to submit your adoption request</p>
            </div>
            <?php endif; ?>

            <form method="POST" action="" class="needs-validation" novalidate>
              <input type="hidden" name="pet_id" value="<?= $pet_id ?>">
              
              <div class="mb-3">
                <label class="form-label">
                  <i class="bi bi-person"></i> Your Name
                </label>
                <input type="text" name="name" class="form-control" required
                       placeholder="Enter your full name">
                <div class="invalid-feedback">Please provide your name.</div>
              </div>

              <div class="mb-3">
                <label class="form-label">
                  <i class="bi bi-envelope"></i> Contact Information
                </label>
                <input type="email" name="contact" class="form-control" required
                       placeholder="Enter your email address">
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>

              <div class="mb-3">
                <label class="form-label">
                  <i class="bi bi-chat-text"></i> Your Message
                </label>
                <textarea name="message" class="form-control" rows="4" 
                          placeholder="Tell us why you'd be a great pet parent..."></textarea>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-heart-fill"></i> Submit Adoption Request
                </button>
                <a href="pets/list.php" class="btn btn-outline-secondary">
                  <i class="bi bi-arrow-left"></i> Back to Available Pets
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5><i class="bi bi-heart-fill text-primary"></i> Shean's Pet Adoption Center</h5>
          <p class="mb-0">Making tails wag and hearts purr since 2025</p>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="social-links">
            <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
          </div>
          <p class="mt-2 mb-0">&copy; 2025 All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

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