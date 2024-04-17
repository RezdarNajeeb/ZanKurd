<?php
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:../login.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>زانیاریەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <?php
  include 'admin_header.php';
  ?>

  <section class="dashboard">
    <h1 class="title">زانیاریەکان</h1>
    <div class="box-container">
      <div class="box">
        <?php $numberOfBooks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books")) or die('query failed'); ?>
        <h3><?php echo $numberOfBooks; ?></h3>
        <p>کتێب</p>
      </div>

      <div class="box">
        <?php $numberOfAuthors = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM authors")) or die('query failed'); ?>
        <h3><?php echo $numberOfAuthors; ?></h3>
        <p>نووسەر</p>
      </div>

      <div class="box">
        <?php $numberOfUsers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'user'")) or die('query failed'); ?>
        <h3><?php echo $numberOfUsers; ?></h3>
        <p>بەکارهێنەر</p>
      </div>

      <div class="box">
        <?php $numberOfAdmins = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'admin'")) or die('query failed'); ?>
        <h3><?php echo $numberOfAdmins; ?></h3>
        <p>بەڕێوبەر</p>
      </div>


    </div>

  </section>

  <!-- custom js link-->
  <script src="../js/scripts.js"></script>
</body>

</html>