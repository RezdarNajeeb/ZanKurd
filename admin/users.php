<?php 
include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="dir">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>بەکارهێنەرەکان</title>
</head>
<body>
  
</body>
</html>