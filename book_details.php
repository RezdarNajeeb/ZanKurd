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
  <title>وردەکاری کتێب</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <link rel="stylesheet" href="css/footer_styles.css">
</head>

<body>

  <?php
  require_once 'header.php';
  $selected_id = $_GET['id'];

  $select_book = mysqli_query($conn, "SELECT * FROM books WHERE id = $selected_id") or die("Failed to select book");



  $book_details = mysqli_fetch_assoc($select_book);
  ?>

  <section class="book-details">
    <div class="book-details-container">
      <h1 class="title"><?php echo $book_details['name'] ?></h1>

      <div class="image">
        <?php echo '<img src="admin/uploaded_image/' . $book_details['image'] . '" alt="">' ?>
      </div>

      <div class="details">
        <p><b>نووسەر:</b> <?php echo $book_details['author'] ?></p>
        <p><b>بەش:</b> <?php echo $book_details['category'] ?></p>
        <p><b>پێناسە:</b> <?php echo $book_details['description'] ?></p>
      </div>

      <div class="buttons">
        <a href="<?php echo "admin/uploaded_files/" . $book_details['file']; ?>" class="primary-button" target="_blank">خوێندنەوە</a>
        <a href="<?php echo $book_details['file']; ?>" download class="download-button">دابەزاندن</a>
      </div>
    </div>
  </section>

  <?php require_once 'footer.php'; ?>

  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>

</html>