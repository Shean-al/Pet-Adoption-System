<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Available Pets - Shean's Pet Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="../index.php">
        <i class="bi bi-heart-fill text-primary me-2"></i>
        Shean's Pet Adoption
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="../index.php"><i class="bi bi-house"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="list.php"><i class="bi bi-heart"></i> Adopt</a></li>
          <li class="nav-item"><a class="nav-link" href="../admin/dashboard.php"><i class="bi bi-shield"></i> Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-md-6">
        <h2 class="page-header mb-0">Available Pets</h2>
      </div>
      <div class="col-md-6">
        <form class="d-flex">
          <input type="search" class="form-control me-2" placeholder="Search pets..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
    </div>

    <div class="pet-grid">
      <?php
      $sql = "SELECT * FROM pets WHERE status='Available'";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()):
      ?>
      <div class="fade-in">
        <div class="card h-100">
          <div class="position-relative">
            <img src="../assets/images/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
            <span class="position-absolute top-0 end-0 badge bg-primary m-3">Available</span>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text text-muted"><?= substr($row['description'], 0, 80) ?>...</p>
            <div class="d-flex justify-content-between align-items-center">
              <a href="details.php?id=<?= $row['id'] ?>" class="btn btn-primary">
                <i class="bi bi-heart"></i> Adopt Me
              </a>
              <a href="details.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary">
                <i class="bi bi-info-circle"></i> Details
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
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