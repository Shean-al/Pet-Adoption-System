<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}
include '../includes/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM pets WHERE id = $id";
$result = $conn->query($sql);
$pet = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $breed = $_POST['breed'];
  $age = $_POST['age'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  // Handle image update if a new one is uploaded
  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image);
    $sql = "UPDATE pets SET name='$name', breed='$breed', age='$age', description='$description', status='$status', image='$image' WHERE id=$id";
  } else {
    $sql = "UPDATE pets SET name='$name', breed='$breed', age='$age', description='$description', status='$status' WHERE id=$id";
  }

  if ($conn->query($sql)) {
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Error updating pet: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Pet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Edit Pet</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= $pet['name'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Breed</label>
        <input type="text" name="breed" class="form-control" value="<?= $pet['breed'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="<?= $pet['age'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required><?= $pet['description'] ?></textarea>
      </div>
      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
          <option value="Available" <?= $pet['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
          <option value="Adopted" <?= $pet['status'] == 'Adopted' ? 'selected' : '' ?>>Adopted</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control">
        <small>Current Image: <?= $pet['image'] ?></small>
      </div>
      <button type="submit" class="btn btn-success">Update Pet</button>
    </form>
  </div>
</body>
</html>
