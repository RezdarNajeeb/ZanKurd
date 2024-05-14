<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('تکایە سەرەتا بچۆ ژوورەوە')</script>";
  header('refresh:0;url=index.php');
  exit();
}

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
  <title>دڵخوازەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <link rel="stylesheet" href="css/footer_styles.css">
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <?php
  require_once 'header.php';
  require_once 'template.php';

  $userId = $_SESSION['user_id'];
  ?>


  <div id="favorite-books">
    <?php
    $query = "SELECT books.* FROM favorites JOIN books ON favorites.book_id = books.id WHERE favorites.user_id = '$userId'";
    showAllBoxes('books', $query, "book_details.php");


    ?>
  </div>

  <?php
  require_once 'footer.php';
  ?>

  <!-- font awesome cdn link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="js/scripts.js"></script>
</body>

</html>