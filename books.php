<?php
include 'config.php';
session_start();
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
  include 'header.php';
  include 'template.php';

  showAllBoxes($conn, 'books');
  ?>

  <!-- custom js file -->
  <script src="js/scripts.js" defer></script>
</body>

</html>