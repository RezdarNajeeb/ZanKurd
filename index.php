<?php
require_once 'config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'admin') {
  header('location: admin/dashboard.php');
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

  ?>
  <!-- home section starts -->
  <section class="home" id="home">
    <div class="row">
      <div class="content">
        <h3>کتێبەکانت بە دەست بێنە</h3>
        <p>
          کتێبەکانت بە دەست بێنە و بەرز بکەوە، بەرزی کردنی کتێبەکانت بەرزترە.
        </p>
      </div>

      <div class="swiper books-slider">
        <div class="swiper-wrapper">
          <?php
          $randomBooks = mysqli_query($conn, "SELECT * FROM `books` ORDER BY RAND() LIMIT 5") or die('query failed');

          if (mysqli_num_rows($randomBooks) > 0) {
            while ($book = mysqli_fetch_assoc($randomBooks)) {
          ?>
              <a href="book_details.php?id=<?php echo $book['id']; ?>" class="swiper-slide">
                <img src="admin/uploaded_image/<?php echo $book['image']; ?>" alt="" />
              </a>
          <?php }
          } ?>
        </div>
        <img src="assets/images/stand1.png" class="stand" alt="" />
      </div>
    </div>
  </section>
  <!--  home section ends -->



  <?php require_once 'footer.php'; ?>

  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- swiper js cdn link-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js file -->
  <script src='js/scripts.js' defer></script>
  <script>
    var userType = <?php echo json_encode($userType); ?>;

    // Swiper slider for books in the home page
    var swiper = new Swiper(".books-slider", {
      loop: true,
      centeredSlides: true,
      spaceBetween: 10,
      autoplay: {
        reverseDirection: true,
        delay: 4500,
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
</body>

</html>