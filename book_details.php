<?php 
include 'config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if($userType == 'admin'){
   header('location: logout.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>زانیارییەکانی کتێب</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
</head>

<body>

  <?php
    include 'header.php';
    $selected_id = $_GET['id'];
    
    $select_book = mysqli_query($conn, "SELECT * FROM books WHERE id = $selected_id") or die ("Failed to select book");

    $book_details = mysqli_fetch_assoc($select_book);
  ?>

  <section class="book_details">
    <div class="book_details-container">
      <div class="book_details-image">
        <?php echo '<img src="admin/uploaded_image/' . $book_details['image'] . '" alt="">' ?>
      </div>
      <div class="book_details-text">
        <h1><?php echo $book_details['name'] ?></h1>
        <p><strong>نووسەر:</strong> <?php echo $book_details['author'] ?></p>
        <p><strong>بەش:</strong> <?php echo $book_details['category'] ?></p>
        <p><strong>پێناسە:</strong> <?php echo $book_details['description'] ?></p>
        <a href="text.pdf" class="primary-button">خوێندنەوە</a>
        <a href="#" class="download-button">دابەزاندن</a>
        <a href="javascript:void(0);" onclick="history.back()" class="cancel-button">گەڕانەوە</a>
      </div>
    </div>
  </section>


  <!-- custom js link-->
  <script src="js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>

</html>
