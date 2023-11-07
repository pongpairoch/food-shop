<?php
  session_start();
  unset($_SESSION['seller_id']);
  unset($_SESSION['seller_shop']);
  unset($_SESSION['seller_detail']);
  unset($_SESSION['seller_username']);
  unset($_SESSION['seller_fullname']);
  unset($_SESSION['seller_email']);
  unset($_SESSION['seller_payment_name']);
  unset($_SESSION['seller_address']);
  unset($_SESSION['seller_tel']);
  unset($_SESSION['seller_payment']);
  header('Location: login.php');
  exit();
?>