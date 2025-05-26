<?php
session_start();
include 'includes/db.php';
$sql = "SELECT * FROM pets WHERE status = 'Available'";
$result = $conn->query($sql);

// Check if admin is logged in
$is_admin = isset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shean's Pet Adoption Center | Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .admin-badge {
      background: #dc3545;
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      margin-left: 0.5rem;
    }
    .admin-controls {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .quick-actions {
      display: flex;
      gap: 0.5rem;
      margin-top: 0.5rem;
    }
  </style>
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
          <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link" href="pets/list.php"><i class="bi bi-heart"></i> Adopt</a></li>
          <?php if ($is_admin): ?>
          <li class="nav-item"><a class="nav-link" href="admin/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i> Admin
              <span class="admin-badge">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="admin/request.php"><i class="bi bi-list-check"></i> Adoption Requests</a></li>
              <li><a class="dropdown-item" href="admin/dashboard.php"><i class="bi bi-pencil-square"></i> Manage Pets</a></li>
              <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
          </li>
          <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-shield"></i> Admin</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php if ($is_admin): ?>
  <!-- Admin Quick Controls -->
  <div class="container mt-3">
    <div class="admin-controls">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-shield-check text-success"></i> Admin Quick Controls</h5>
        <span class="text-muted">Welcome back, <?= $_SESSION['admin'] ?>!</span>
      </div>
      <div class="quick-actions">
        <a href="admin/add_pet.php" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-circle"></i> Add New Pet
        </a>
        <a href="admin/request.php" class="btn btn-info btn-sm text-white">
          <i class="bi bi-list-check"></i> View Adoption Requests
        </a>
        <a href="admin/dashboard.php" class="btn btn-secondary btn-sm">
          <i class="bi bi-pencil-square"></i> Manage Pets
        </a>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Hero Section -->
  <div class="container-fluid py-5 bg-primary text-white" style="margin-top: -1px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 fade-in">
          <h1 class="display-4 fw-bold mb-4">Find Your Perfect Companion</h1>
          <p class="lead mb-4">Give a loving home to our adorable pets and make a lifelong friend. Every pet deserves a caring family!</p>
          <a href="pets/list.php" class="btn btn-light btn-lg">
            <i class="bi bi-search-heart"></i> Find Your Pet
          </a>
        </div>
        <div class="col-lg-6 text-center fade-in">
          <img src="assets/images/askal.jpg" alt="Happy Pets" class="img-fluid rounded-circle" style="max-width: 400px;">
        </div>
      </div>
    </div>
  </div>

  <!-- Featured Pets Section -->
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="page-header">Featured Pets</h2>
      <?php if ($is_admin): ?>
      <a href="admin/manage_pets.php" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-pencil"></i> Manage Featured Pets
      </a>
      <?php endif; ?>
    </div>
    <div class="row">
      <?php
      $sql = "SELECT * FROM pets WHERE status = 'Available' LIMIT 3";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()):
      ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 fade-in">
          <div class="position-relative">
            <img src="assets/images/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
            <span class="position-absolute top-0 end-0 badge bg-primary m-3">Available</span>
            <?php if ($is_admin): ?>
            <div class="position-absolute bottom-0 end-0 m-3">
              <a href="admin/edit_pet.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-light">
                <i class="bi bi-pencil"></i>
              </a>
            </div>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text text-muted"><?= substr($row['description'], 0, 60) ?>...</p>
            <a href="pets/details.php?id=<?= $row['id'] ?>" class="btn btn-primary">
              <i class="bi bi-eye"></i> View Details
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="text-center mt-4">
      <a href="pets/list.php" class="btn btn-outline-primary btn-lg">
        <i class="bi bi-grid"></i> View All Pets
      </a>
    </div>
  </div>

  <!-- Why Choose Us Section -->
  <div class="container-fluid py-5 bg-light">
    <div class="container">
      <h2 class="page-header">Why Choose Us</h2>
      <div class="row g-4">
        <div class="col-md-4 fade-in">
          <div class="card h-100 border-0 bg-transparent">
            <div class="card-body text-center">
              <i class="bi bi-heart-fill text-primary" style="font-size: 3rem;"></i>
              <h4 class="mt-3">Loving Care</h4>
              <p class="text-muted">All our pets receive the best care and attention before adoption.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="card h-100 border-0 bg-transparent">
            <div class="card-body text-center">
              <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
              <h4 class="mt-3">Health Guaranteed</h4>
              <p class="text-muted">Every pet is vaccinated and undergoes regular health checks.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="card h-100 border-0 bg-transparent">
            <div class="card-body text-center">
              <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
              <h4 class="mt-3">Expert Support</h4>
              <p class="text-muted">Our team provides ongoing support after adoption.</p>
            </div>
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
</body>
</html>
