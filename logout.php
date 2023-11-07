<?php
  session_start();
  unset($_SESSION['user_id']);
  unset($_SESSION['user_username']);
  unset($_SESSION['user_fullname']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_address']);
  unset($_SESSION['user_tel']);
  unset($_SESSION['user_pet']);
  header('Location: index.php');
  exit();
?>