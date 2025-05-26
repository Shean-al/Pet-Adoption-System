<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}

include '../includes/db.php';

// Handle approve/reject actions
if (isset($_GET['action']) && isset($_GET['id'])) {
  $action = $_GET['action'];
  $id = $_GET['id'];
  $new_status = ($action === 'approve') ? 'Approved' : 'Rejected';
  $conn->query("UPDATE requests SET status='$new_status' WHERE id=$id");
  header("Location: request.php");
  exit();
}

// Fetch all requests
$sql = "SELECT r.*, p.name AS pet_name, p.image AS pet_image 
        FROM requests r 
        JOIN pets p ON r.pet_id = p.id 
        ORDER BY r.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adoption Requests - Shean's Pet Adoption</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="page-header mb-0">Adoption Requests</h2>
      <a href="dashboard.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
      </a>
    </div>

    <div class="card fade-in">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Pet</th>
                <th>Adopter Details</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td style="width: 200px;">
                  <div class="d-flex align-items-center">
                    <img src="../assets/images/<?= $row['pet_image'] ?>" class="rounded-circle me-2" 
                         style="width: 40px; height: 40px; object-fit: cover;">
                    <div>
                      <strong><?= $row['pet_name'] ?></strong>
                      <br>
                      <small class="text-muted">ID: <?= $row['id'] ?></small>
                    </div>
                  </div>
                </td>
                <td>
                  <strong><?= $row['adopter_name'] ?></strong>
                  <br>
                  <small>
                    <i class="bi bi-envelope-fill text-muted"></i> 
                    <?= $row['adopter_email'] ?>
                  </small>
                </td>
                <td>
                  <p class="mb-0 text-muted" style="max-width: 300px;">
                    <?= $row['message'] ?>
                  </p>
                </td>
                <td>
                  <?php
                    $statusClass = 'secondary';
                    if ($row['status'] === 'Approved') $statusClass = 'success';
                    if ($row['status'] === 'Rejected') $statusClass = 'danger';
                    if ($row['status'] === 'Pending') $statusClass = 'warning';
                  ?>
                  <span class="badge bg-<?= $statusClass ?>">
                    <?= $row['status'] ?>
                  </span>
                </td>
                <td>
                  <?php if ($row['status'] === 'Pending'): ?>
                    <div class="btn-group">
                      <a href="?action=approve&id=<?= $row['id'] ?>" 
                         class="btn btn-sm btn-success">
                        <i class="bi bi-check-lg"></i> Approve
                      </a>
                      <a href="?action=reject&id=<?= $row['id'] ?>" 
                         class="btn btn-sm btn-danger">
                        <i class="bi bi-x-lg"></i> Reject
                      </a>
                    </div>
                  <?php else: ?>
                    <span class="text-muted">
                      <i class="bi bi-lock"></i> No action needed
                    </span>
                  <?php endif; ?>
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
