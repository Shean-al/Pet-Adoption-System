<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}

include '../includes/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Optional: Delete image file from server
  $imageQuery = "SELECT image FROM pets WHERE id = $id";
  $imageResult = $conn->query($imageQuery);
  if ($imageResult && $imageResult->num_rows > 0) {
    $row = $imageResult->fetch_assoc();
    $imagePath = "../assets/images/" . $row['image'];
    if (file_exists($imagePath)) {
      unlink($imagePath); // Deletes the image file
    }
  }

  // Delete pet from database
  $sql = "DELETE FROM pets WHERE id = $id";
  if ($conn->query($sql)) {
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Error deleting pet: " . $conn->error;
  }
} else {
  echo "No pet ID provided.";
}
?>
