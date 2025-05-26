<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $breed = $conn->real_escape_string($_POST['breed']);
    $age = (int)$_POST['age'];
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);
    
    $image = $_FILES['image']['name'];
    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($image);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO pets (name, breed, age, description, status, image) 
                VALUES ('$name', '$breed', $age, '$description', '$status', '$image')";
        
        if ($conn->query($sql)) { 
            $success = "Pet added successfully!";
        } else {
            $error = "Error: " . $conn->error . "<br>SQL: " . htmlspecialchars($sql);
        }
    } else {
        $error = "Error uploading image. Please ensure the 'assets/images/' directory exists and is writable.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Pet - Shean's Pet Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="page-header mb-0">Add New Pet</h2>
                            <div>
                                <a href="dashboard.php" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <a href="request.php" class="btn btn-info text-white">
                                    <i class="bi bi-envelope"></i> Requests
                                </a>
                            </div>
                        </div>

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

                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-tag"></i> Pet Name
                                    </label>
                                    <input type="text" name="name" class="form-control" required
                                            placeholder="Enter pet name">
                                    <div class="invalid-feedback">Please provide a pet name.</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-bookmark"></i> Breed
                                    </label>
                                    <input type="text" name="breed" class="form-control" required
                                            placeholder="Enter breed">
                                    <div class="invalid-feedback">Please provide the breed.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-calendar"></i> Age (years)
                                    </label>
                                    <input type="number" name="age" class="form-control" required min="0"
                                            placeholder="Enter age">
                                    <div class="invalid-feedback">Please provide the age.</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-check-circle"></i> Status
                                    </label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select status...</option>
                                        <option value="Available">Available</option>
                                        <option value="Adopted">Adopted</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a status.</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-file-text"></i> Description
                                </label>
                                <textarea name="description" class="form-control" rows="4" required
                                            placeholder="Enter pet description..."></textarea>
                                <div class="invalid-feedback">Please provide a description.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="bi bi-image"></i> Pet Image
                                </label>
                                <input type="file" name="image" class="form-control" required
                                        accept="image/*">
                                <div class="invalid-feedback">Please select an image.</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-plus-circle"></i> Add Pet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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