<?php
require_once 'config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

// if the user is admin, redirect to logout page
if ($userType == 'admin') {
  header('location: admin/dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پەیوەندیکردن</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <link rel="stylesheet" href="css/admin_style.css">
  <link rel="stylesheet" href="css/footer_styles.css">
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>


  <?php
  require_once 'header.php';
  ?>

  <section class="team-section">
    <h1>تیمی گەشەپێدەر</h1>
    <div class="team-container">
      <div class="team-member">
        <img src="assets/images/RezdarNajeebObaed.jpg" alt="Developer 1">
        <h2>Rezdar N. Obaid</h2>
        <p class="role">Full-Stack Developer</p>
      </div>
      <div class="team-member">
        <img src="assets/images/hawkar_shakhawan.jpg" alt="Developer 2">
        <h2>Hawkar Shakhawan</h2>
        <p class="role">Back-end Developer</p>
      </div>
    </div>
  </section>

  <section class="add-message">
    <h1>پەیوەندیکردن</h1>
    <div class="form-container">
      <form action="about.php" method="POST" enctype="multipart/form-data">

        <label for="description">نامە</label>
        <input type="text" name="message" class="field" required>

        <button type="submit" name="send">ناردن</button>
      </form>
    </div>
  </section>

  <?php
  if (isset($_POST['send'])) {

    if ($userType != null) {

      $name = $_SESSION['user_name'];
      $email = $_SESSION['user_email'];
      $message = mysqli_real_escape_string($conn, $_POST['message']);

      mysqli_query($conn, "INSERT INTO `contacts`(user_name, user_email, message)
    VALUES('$name', '$email', '$message')") or die('query failed');
      echo "<script>alert('پەیامەکەت بە سەرکەوتوویی نێردرا.');</script>";
    } else {
      echo "<script>alert('پێویستە سەرەتا خۆت تۆمار بکەیت.');</script>";
    }
  }
  ?>

  <!-- footer section -->
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