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
  <title>نامەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <?php require_once 'admin_header.php'; ?>

  <section class="all_messages">
    
 
    <?php


  $select_all_rows = mysqli_query($conn, "SELECT * FROM contacts");
  $totalMessages = mysqli_num_rows($select_all_rows);
  if($totalMessages > 0){
    while($currentMessages = mysqli_fetch_assoc($select_all_rows)){
  ?>
  <div class="message_box">
    <p><?php echo $currentMessages['name'] ?></p>
    <p><?php echo $currentMessages['email'] ?></p>
    <p><?php echo $currentMessages['message'] ?></p>

  </div>

  <?php
    }};
  ?>

</section>

<div class="container">
<div class="status">
      helo
      <i class="fa fa-circle"></i>
    </div>
    <div class="status">
      helo
      <i class="fa fa-circle"></i>
    </div>
    <div class="status">
      helo
      <i class="fa fa-circle"></i>
    </div>
    <div class="status">
      helo
      <i class="fa fa-circle"></i>
    </div>
</div>



  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>
</html>