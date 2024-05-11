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
  <title>زانیارییەکانی نووسەر</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <link rel="stylesheet" href="css/footer_styles.css">
</head>

<body>

  <?php
  require_once 'header.php';
  $selected_id = $_GET['id'];

  $select_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = $selected_id") or die("Failed to select author");

  $author_details = mysqli_fetch_assoc($select_author);
  ?>

  <section class="book-details">
    <div class="book_details-container">
      <h1 class="title"><?php echo $author_details['name']; ?></h1>

      <div class="image">
        <?php echo '<img src="admin/uploaded_image/' . $author_details['image'] . '" alt="">' ?>
      </div>

      <div class="details">
        <p><b>دەربارە:</b> <?php echo $author_details['description'] ?></p>
      </div>
    </div>
  </section>

 

  <?php require_once 'footer.php'; ?>

  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="js/scripts.js"></script>
  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>

</body>

</html>