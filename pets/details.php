<?php
include '../includes/db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM pets WHERE id=$id";
$result = $conn->query($sql);
$pet = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pet['name'] ?>'s Profile - Pet Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .pet-details {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(0,0,0,0.1);
      padding: 2rem;
      margin-top: 2rem;
      margin-bottom: 2rem;
    }
    .pet-image {
      width: 100%;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .pet-image:hover {
      transform: scale(1.02);
    }
    .pet-name {
      color: #2c3e50;
      font-weight: 600;
      margin-bottom: 1.5rem;
      font-size: 2.5rem;
    }
    .info-card {
      background: #f8f9fa;
      border-radius: 15px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      transition: transform 0.3s ease;
    }
    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .info-label {
      color: #6c757d;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }
    .info-value {
      color: #2c3e50;
      font-size: 1.1rem;
      font-weight: 500;
    }
    .adopt-btn {
      padding: 1rem 2rem;
      font-size: 1.1rem;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    .adopt-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
    }
    .navigation-btn {
      padding: 0.8rem 1.5rem;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    .navigation-btn:hover {
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="mt-4">
      <a href="../index.php" class="btn btn-secondary navigation-btn">
        <i class="bi bi-arrow-left me-2"></i>
        Back to Home
      </a>
    </div>

    <div class="pet-details">
      <div class="row g-4">
        <!-- Pet Image Column -->
        <div class="col-lg-6">
          <img src="../assets/images/<?= $pet['image'] ?>" 
               class="pet-image" 
               alt="<?= $pet['name'] ?>">
        </div>

        <!-- Pet Info Column -->
        <div class="col-lg-6">
          <h1 class="pet-name">
            <i class="bi bi-heart-fill text-danger me-2"></i>
            <?= $pet['name'] ?>
          </h1>

          <!-- Breed Info -->
          <div class="info-card">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper me-3">
                <i class="bi bi-tag-fill text-primary" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <div class="info-label">Breed</div>
                <div class="info-value"><?= $pet['breed'] ?></div>
              </div>
            </div>
          </div>

          <!-- Age Info -->
          <div class="info-card">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper me-3">
                <i class="bi bi-calendar-event text-primary" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <div class="info-label">Age</div>
                <div class="info-value"><?= $pet['age'] ?> years old</div>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="info-card">
            <div class="d-flex">
              <div class="icon-wrapper me-3">
                <i class="bi bi-card-text text-primary" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <div class="info-label">About</div>
                <div class="info-value lh-lg"><?= $pet['description'] ?></div>
              </div>
            </div>
          </div>

          <!-- Adoption Button -->
          <div class="mt-4 text-center">
            <a href="../adopt.php?pet_id=<?= $pet['id'] ?>" 
               class="btn btn-success btn-lg adopt-btn">
              <i class="bi bi-heart-fill me-2"></i>
              Adopt <?= $pet['name'] ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>