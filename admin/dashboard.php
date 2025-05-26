s<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}
include '../includes/db.php';
$result = $conn->query("SELECT * FROM pets");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Shean's Pet Adoption</title>
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
      <div class="ms-auto">
        <a href="../logout.php" class="btn btn-outline-danger">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row mb-4 align-items-center">
      <div class="col-md-6">
        <h2 class="page-header mb-0">Admin Dashboard</h2>
      </div>
      <div class="col-md-6 text-md-end">
        <a href="add_pet.php" class="btn btn-primary me-2">
          <i class="bi bi-plus-circle"></i> Add New Pet
        </a>
        <a href="request.php" class="btn btn-info text-white">
          <i class="bi bi-envelope"></i> View Requests
        </a>
      </div>
    </div>

    <div class="card fade-in">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Pet Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="../assets/images/<?= $row['image'] ?>" class="rounded-circle me-2" 
                         style="width: 40px; height: 40px; object-fit: cover;">
                    <?= $row['name'] ?>
                  </div>
                </td>
                <td><?= $row['breed'] ?></td>
                <td><?= $row['age'] ?> years</td>
                <td>
                  <span class="badge bg-<?= $row['status'] === 'Available' ? 'success' : 'secondary' ?>">
                    <?= $row['status'] ?>
                  </span>
                </td>
                <td>
                  <a href="edit_pet.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">
                    <i class="bi bi-pencil"></i> Edit
                  </a>
                  <a href="delete_pet.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                     onclick="return confirm('Are you sure you want to delete this pet?')">
                    <i class="bi bi-trash"></i> Delete
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
