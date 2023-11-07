<?php 
  include('../config.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $admin_username = $conn->real_escape_string($_POST['admin_username']);
    $admin_password = $conn->real_escape_string($_POST['admin_password']);
    $sql = "SELECT * FROM admin WHERE admin_username = '$admin_username' AND admin_password = MD5('$admin_password') AND admin_status = 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $row = $result->fetch_assoc();
      $_SESSION['admin_id'] = $row['admin_id'];
      $_SESSION['admin_username'] = $row['admin_username'];
      $_SESSION['admin_fullname'] = $row['admin_fullname'];
      $_SESSION['admin_email'] = $row['admin_email'];
      $_SESSION['admin_address'] = $row['admin_address'];
      $_SESSION['admin_tel'] = $row['admin_tel'];
      echo "<script>
        alert('เข้าสู่ระบบสำเร็จ');
        window.location.href = 'index.php';
      </script>";
    }else{
      echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านผู้ดูแลระบบไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
        window.history.back();
      </script>";
    }
    exit();
  }
?>