<?php
  session_start();
  unset($_SESSION['admin_id']);
  unset($_SESSION['admin_username']);
  unset($_SESSION['admin_fullname']);
  unset($_SESSION['admin_email']);
  unset($_SESSION['admin_address']);
  unset($_SESSION['admin_tel']);
  header('Location: login.php');
  exit();
?>