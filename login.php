<?php
require_once 'config.php';
session_start();

if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
   header('location: admin/dashboard.php');
   exit();
} elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'user') {
   header('location: index.php');
   exit();
}

// Check if the "Remember Token" cookie exists and log in the user if valid
// if (isset($_COOKIE['remember-token'])) {
//    $token = $_COOKIE['remember-token'];
//    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE remember_token = '$token'") or die('query failed');

//    if (mysqli_num_rows($select_user) > 0) {
//       $row = mysqli_fetch_assoc($select_user);
//       $_SESSION['user_id'] = $row['id'];
//       $_SESSION['user_name'] = $row['name'];
//       $_SESSION['user_email'] = $row['email'];
//       $_SESSION['user_type'] = $row['user_type'];
//       if ($row['user_type'] == 'admin') {
//          header('location: admin/dashboard.php');
//          exit();
//       } else {
//          header('location: index.php');
//          exit();
//       }
//    }
// }

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, hash('sha256', $_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $row = mysqli_fetch_assoc($select_users);

      if ($row['user_type'] == 'admin') {
         $_SESSION['admin_id'] = $row['id'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['user_type'] = $row['user_type'];
         // Set the "Remember Me" cookie if the checkbox is checked
         // if (isset($_POST['remember-me'])) {
         //    $token = bin2hex(random_bytes(16));
         //    setcookie('remember-token', $token, time() + (86400 * 30));
         //    mysqli_query($conn, "UPDATE `users` SET remember_token = '$token' WHERE id = '{$row['id']}'");
         // }
         header('location: admin/dashboard.php');
         exit(); // ensure that the script stops executing after redirecting
      } elseif ($row['user_type'] == 'user') {
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_type'] = $row['user_type'];
         // Set the "Remember Me" cookie if the checkbox is checked
         // if (isset($_POST['remember-me'])) {
         //    $token = bin2hex(random_bytes(16));
         //    setcookie('remember-token', $token, time() + (86400 * 30), "/");
         //    mysqli_query($conn, "UPDATE `users` SET remember_token = '$token' WHERE id = '{$row['id']}'");
         // }
         header('location: index.php');
         exit(); // ensure that the script stops executing after redirecting
      }
   } else {
      $messages[] = 'ناوی بەکارهێنەر یان وشەی نهێنی هەڵەیە!';
   }
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>چوونەژوورەوە</title>
   <!-- custom css style link-->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/auth_styles.css">

   <!-- font awesome cdn-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
   <?php
   if (isset($messages)) {
      foreach ($messages as $message) {
         echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fa fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

   <div class="form-container">

      <form action="" method="post" name="auth-form" id="login-form">
         <h3>چوونە ژوورەوە</h3>

         <div class="input-control">
            <div class="input">
               <input type="email" name="email" id="email" placeholder="ئیمەیڵەکەت بنووسە" class="field">
               <i class="fa fa-envelope"></i>
            </div>
            <span id="email-error"></span>
         </div>

         <div class="input-control">
            <div class="input">
               <input type="password" name="password" id="password" placeholder="وشە نهێنییەکەت بنووسە" class="field">
               <i class="fa fa-lock"></i>
            </div>
            <span id="password-error"></span>
         </div>

         <div class="checkbox-container">
            <div class="show-pass-container">
               <label for="show-pass">پیشاندانی وشەی نهێنی</label>
               <input type="checkbox" name="show-pass" id="show-pass">
            </div>

            <!-- <div class="remember-me-container">
               <label for="remember-me">منت لەبیر بێت</label>
               <input type="checkbox" name="remember-me" id="remember-me">
            </div> -->
         </div>


         <input type="submit" name="submit" value="بچۆ ژوورەوە" class="primary-button">
         <p>هیچ هەژمارێکت نییە؟<a href="register.php"> خۆتۆمارکردن</a></p>
      </form>

   </div>

   <!-- custom js script link-->
   <script src="js/scripts.js" defer></script>
</body>

</html>