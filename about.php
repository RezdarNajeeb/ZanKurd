<?php
require_once 'config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

// if the user is admin, redirect to logout page
if ($userType == 'admin') {
  header('location: logout.php');
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
<style>
.team-section {
  text-align: center;
  padding: 2rem;
}

.team-container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 2rem;
}

.team-member {
  max-width: 400px;
  background-color: #f2f2f2;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 2rem;
  text-align: left;
}

.team-member img {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
}

.team-member h2 {
  margin-bottom: 0.5rem;
  font-size: 2rem;
}

.team-member .role {
  margin-bottom: 0.25rem;
  font-size: 1.2rem;
  font-weight: bold;
}

.team-member .skills {
  margin-bottom: 0.25rem;
  font-size: 1.1rem;
}

@media (max-width: 768px) {
  .team-container {
    flex-direction: column;
    align-items: center;
  }
}
</style>

<body>


  <?php
  require_once 'header.php';
  ?>

<section class="team-section">
  <h1>تیمی گەشەپێدەر</h1>
  <div class="team-container">
    <div class="team-member">
      <img src="admin/uploaded_image/227571.jpg" alt="Developer 1">
      <h2>John Doe</h2>
      <p class="role">Front-end Developer</p>
    </div>
    <div class="team-member">
      <img src="admin/uploaded_image/hawkar_shakhawan.jpg" alt="Developer 2">
      <h2>Jane Smith</h2>
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

    if ($_SESSION['user_type'] != null) {

      $name = $_SESSION['user_name'];
      $email = $_SESSION['user_email'];
      $message = mysqli_real_escape_string($conn, $_POST['message']);

      mysqli_query($conn, "INSERT INTO `contacts`(user_name, user_email, message)
    VALUES('$name', '$email', '$message')") or die('query failed');
      $message[] = 'پەیامەکەت بە سەرکەوتوویی نێردرا.';
    } else {
      $message[] = 'پێویستە سەرەتا خۆت تۆمار بکەیت.';
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