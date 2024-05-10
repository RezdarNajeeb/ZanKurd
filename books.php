<?php
require_once 'config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'admin') {
  header('location: logout.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>هەموو کتێبەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php
  require_once 'header.php';
  require_once 'template.php';

  $title = isset($_GET['title']) ? $_GET['title'] : 'all';
  $query = "SELECT * FROM `books`";
  if ($title !== 'all') {
    switch ($title) {
      case 'novels':
        $title = 'ڕۆمان';
        break;
      case 'poetries':
        $title = 'شیعر';
        break;
      case 'چیرۆک':
        $title = 'stories';
        break;
      case 'politics':
        $title = 'سیاسی';
        break;
      case 'sciences':
        $title = 'زانست';
        break;
      case 'arts':
        $title = 'هونەر';
        break;
    }

    $query = "SELECT * FROM `books` WHERE `category`='$title'";
  }

  showAllBoxes('books', $query, "book_details.php");
  ?>

  <?php require_once 'footer.php'; ?>

  <!-- custom js file -->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="js/scripts.js" defer></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>

</html>