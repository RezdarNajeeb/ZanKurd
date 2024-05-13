<?php
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
$adminEmail = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : null;
$isOwner = ($adminEmail == 'owner@gmail.com');


if ($userType == 'user' || $userType == null) {
  header('location: ../logout.php');
  exit;
}
?>
<script>
  alert('<?php echo $user_email; ?>');
</script>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>بەکارهێنەران</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <?php require_once 'admin_header.php'; ?>


  <h1 id="messages_heading">بەکارهێنەران</h1>

  <?php if ($isOwner) { ?>
    <!-- add admin form -->
    <section class="add-books">
      <h1>زیادکردنی بەڕێوبەر</h1>
      <div class="form-container">
        <form action="users.php" method="POST" enctype="multipart/form-data">

          <input type="text" name="admin_name" class="field" placeholder="ناو بنووسە" required>

          <input type="text" name="admin_email" class="field" placeholder="ئیمەیڵ بنووسە" required>

          <input type="password" name="admin_password" class="field" placeholder=" وشەی نهێنی بنووسە" required>

          <input type="password" name="admin_cpassword" class="field" placeholder="دووبارە وشەی نهێنی بنووسە بۆ دڵنیایی" required>

          <button type="submit" name="add_admin">زیادکردن</button>
        </form>
      </div>
    </section>

  <?php
    // add admin functionallity



    if (isset($_POST['add_admin'])) {

      $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
      $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
      $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_password']);
      $admin_cpass = mysqli_real_escape_string($conn, $_POST['admin_cpassword']);

      $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$admin_email'") or die('query failed');

      if (mysqli_num_rows($select_admins) > 0) {
        $messages[] = 'ئەو بەڕێوبەرە دووبارەیە!';
      } else {
        $add_admin_query = mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$admin_name', '$admin_email', '$admin_cpass', 'admin')") or die('query failed');
        if ($add_admin_query) {
          $message[] = 'بەڕێوبەرەکە بە سەرکەوتوویی زیادکرا.';
        } else {
          $message[] = '.ناتوانیت بەڕێوبەرەکە زیاد بکەیت.';
        }
      }
    }
  }
  ?>

  <div class="user_container">

    <?php
    //deleting a user or an admin
    if (isset($_POST['delete'])) {
      $id = $_POST['id'];
      $delete_query = mysqli_query($conn, "DELETE FROM users WHERE id=$id");
      if ($delete_query) {
        $message[] = 'بەکارهێنەرەکە سڕایەوە.';
      } else {
        $message[] = 'ناتوانیت بەکار‌هێنەرەکە بسڕیتەوە.';
      }
    }

    //promoting a user to an admin
    if (isset($_POST['promote'])) {
      $id = $_POST['id'];
      $promote_update_query = mysqli_query($conn, "UPDATE users SET user_type='admin' WHERE id=$id");
      if ($promote_update_query) {
        $message[] = 'پلەی بەکارهێنەرەکە بەرزکرایەوە بۆ بەڕێوبەر.';
      } else {
        $message[] = 'ناتوانیت پلەی بەکار‌هێنەرەکە بەرزبکەیتەوە.';
      }
    }

    //demoting an admin to a user
    if (isset($_POST['demote'])) {
      $id = $_POST['id'];
      $demote_update_query = mysqli_query($conn, "UPDATE users SET user_type='user' WHERE id=$id");
      if ($demote_update_query) {
        $message[] = 'پلەی بەڕێوبەرەکە نزمکرایەوە بۆ بەکارهێنەر.';
      } else {
        $message[] = 'ناتوانیت پلەی بەڕێوبەرەکە داببەزێنیت.';
      }
    }

    $select_all_rows = mysqli_query($conn, "SELECT * FROM users");
    $totalUsers = mysqli_num_rows($select_all_rows);
    if ($totalUsers > 0) {
      while ($currentUsers = mysqli_fetch_assoc($select_all_rows)) {
    ?>
        <div class="user_box">
          <h2><?php echo $currentUsers['name'] ?></h2>
          <h3><?php echo $currentUsers['email'] ?></h3>

          <?php if ($currentUsers['email'] == 'owner@gmail.com') { ?>
            <h1>Owner</h1>
          <?php } else { ?>
            <h1><?php echo $currentUsers['user_type'] ?></h1>
          <?php } ?>

          <form action="users.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $currentUsers['id'] ?>">

            <?php

            //user = the user which logged in
            //current user = the user which is in the loop

            // if the user is the owner or the user is an admin and the current user is a user
            if ($adminEmail == 'owner@gmail.com' || ($userType == 'admin' && $currentUsers['user_type'] == 'user')) {

              if ($currentUsers['email'] != 'owner@gmail.com') { ?>

                <input type="submit" name="delete" class="delete-button" onclick="return confirm('Are You Sure?')" value="سڕینەوە">

              <?php }

              // if the user is the owner and the current user is a user
              if ($isOwner && $currentUsers['user_type'] == 'user') { ?>
                <input type="submit" name="promote" class="promote-button" value="بەرزکردنەوە">

              <?php }
              if ($isOwner && ($currentUsers['email'] != 'owner@gmail.com' && $currentUsers['user_type'] == 'admin')) { ?>
                <input type="submit" name="demote" class="demote-button" value="نزمکردنەوە">

            <?php }
            }
            ?>
          </form>

        </div>
    <?php
      }
    } else {
      $message[] = 'هیچ بەکارهێنەرێک نییە.';
    };
    ?>

  </div>



  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>

</body>

</html>