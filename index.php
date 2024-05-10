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
  <title>سەرەتا</title>
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- swiper js cdn link-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <link rel="stylesheet" href="css/footer_styles.css">

</head>

<body>
  <?php
  require_once 'header.php';
  ?><!-- home section starts -->
  <section class="home" id="home">
    <div class="row">
      <div class="content">
        <h3>upto 75% off</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat,
          quia debitis. Animi corrupti odit amet facilis perspiciatis, vero
          nam minus sint vel exercitationem quam consequatur ipsa at incidunt
          consectetur molestias?
        </p>
      </div>

      <div class="swiper books-slider">
        <div class="swiper-wrapper">
          <a href="#" class="swiper-slide"><img src="assets/images/banner-bg.jpg" alt="" /></a>
        </div>
        <img src="assets/images/stand1.png" class="stand" alt="" />
      </div>
    </div>
  </section>
  <!--  home section ends -->

  <?php require_once 'footer.php'; ?>

  <!-- custom js file -->
  <script>
    var userType = <?php echo json_encode($userType); ?>;

    // Swiper slider for books in the home page
    var swiper = new Swiper(".books-slider", {
      loop: true,
      centeredSlides: true,
      autoplay: {
        delay: 9500,
        disableOnInteraction: false,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
  <script src='js/scripts.js' defer></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- swiper js cdn link-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>