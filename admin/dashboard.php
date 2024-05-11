<?php
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'user' || $userType == null) {
  header('location: ../logout.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>زانیاریەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>

</html>