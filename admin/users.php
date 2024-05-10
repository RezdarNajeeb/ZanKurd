<?php 
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'user' || $userType == null) {
  header('location: logout.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="dir">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>بەکارهێنەرەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  





  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>
</html>