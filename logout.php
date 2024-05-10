<?php
require_once 'config.php';

session_start();
session_unset();
session_destroy();

// Delete the remember_token cookie if it exists to log the user out
if (isset($_COOKIE['remember-token'])) {
  setcookie('remember-token', '', time() - 3600, '/', '', true, true); // set the expiration time to a past value and set secure and httponly flags
}

header('location:login.php');
?>
