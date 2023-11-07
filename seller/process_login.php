<?php 
  include('../config.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $seller_username = $conn->real_escape_string($_POST['seller_username']);
    $seller_password = $conn->real_escape_string($_POST['seller_password']);
    $sql = "SELECT * FROM seller WHERE seller_username = '$seller_username' AND seller_password = MD5('$seller_password') AND seller_status = 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $row = $result->fetch_assoc();
      $_SESSION['seller_id'] = $row['seller_id'];
      $_SESSION['seller_shop'] = $row['seller_shop'];
      $_SESSION['seller_detail'] = $row['seller_detail'];
      $_SESSION['seller_username'] = $row['seller_username'];
      $_SESSION['seller_fullname'] = $row['seller_fullname'];
      $_SESSION['seller_email'] = $row['seller_email'];
      $_SESSION['seller_payment_name'] = $row['seller_payment_name'];
      $_SESSION['seller_address'] = $row['seller_address'];
      $_SESSION['seller_tel'] = $row['seller_tel'];
      $_SESSION['seller_payment'] = $row['seller_payment'];
      echo "<script>
        alert('เข้าสู่ระบบสำเร็จ');
        window.location.href = 'index.php';
      </script>";
    }else{
      echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านผู้ขายไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
        window.history.back();
      </script>";
    }
    exit();
  }
?>