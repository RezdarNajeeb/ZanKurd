<?php
session_start();
require_once 'config.php';

if (isset($_POST['book_id']) && isset($_SESSION['user_id'])) {
  $bookId = $_POST['book_id'];
  $userId = $_SESSION['user_id'];

  // Check if the book is already in favorites
  $query = "SELECT * FROM favorites WHERE user_id = '$userId' AND book_id = '$bookId'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Remove from favorites
    $query = "DELETE FROM favorites WHERE user_id = '$userId' AND book_id = '$bookId'";
    mysqli_query($conn, $query);
    echo 'removed';
    exit();
  } else {
    // Add to favorites
    $query = "INSERT INTO favorites (user_id, book_id) VALUES ('$userId', '$bookId')";
    mysqli_query($conn, $query);
    echo 'added';
    exit();
  }
}
