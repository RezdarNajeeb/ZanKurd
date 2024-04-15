<?php
include 'config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, hash('sha256', $_POST['password']));
   $cpass = mysqli_real_escape_string($conn, hash('sha256', $_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $messages[] = 'ئەو بەکارهێنەرە دووبارەیە!';
   } else {
      mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
      header('location:login.php');
   }
}

?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <!-- custom css style link-->
   <link rel="stylesheet" href="./css/styles.css">
   <link rel="stylesheet" href="./css/auth_styles.css">

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

      <form action="" method="post" name="auth-form" id="register-from">
         <h3>تۆمار کردن</h3>

         <div class="input-control">
            <div class="input">
               <input type="text" name="name" id="name" placeholder="ناو بنووسە" class="field">
               <i class="fa fa-user"></i>
            </div>
            <span id="name-error"></span>
         </div>

         <div class="input-control">
            <div class="input">
               <input type="email" name="email" id="email" placeholder="ئیمەیڵ بنووسە" class="field">
               <i class="fa fa-envelope"></i>
            </div>
            <span id="email-error"></span>
         </div>

         <div class="input-control">
            <div class="input">
               <input type="password" name="password" id="password" placeholder=" وشەی نهێنی بنووسە" class="field">
               <i class="fa fa-lock"></i>
            </div>
            <span id="password-error"></span>
         </div>

         <div class="input-control">
            <div class="input">
               <input type="password" name="cpassword" id="cpassword" placeholder="دووبارە وشەی نهێنی بنووسە بۆ دڵنیایی" class="field">
               <i class="fa fa-lock"></i>
            </div>
            <span id="cpassword-error"></span>
         </div>

         <div class="checkbox-container">
            <div class="show-pass-container">
               <label for="show-pass">پیشاندانی وشەی نهێنی</label>
               <input type="checkbox" name="show-pass" id="show-pass">
            </div>
         </div>


         <input type="submit" name="submit" value="تۆماری بکە" class="primary-button">
         <p>پێشتر خۆتت تۆمارکردووە؟ <a href="login.php"> چوونەژوورەوە</a></p>
      </form>


   </div>

   <!-- custom js script link-->
   <script src="js/scripts.js" defer></script>

</body>

</html>