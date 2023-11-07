<?php 
  include('config.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_username = $conn->real_escape_string($_POST['user_username']);
    $user_password = $conn->real_escape_string($_POST['user_password']);
    $sql = "SELECT * FROM user WHERE user_username = '$user_username' AND user_password = MD5('$user_password') AND user_status = 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $row = $result->fetch_assoc();
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_username'] = $row['user_username'];
      $_SESSION['user_fullname'] = $row['user_fullname'];
      $_SESSION['user_email'] = $row['user_email'];
      $_SESSION['user_address'] = $row['user_address'];
      $_SESSION['user_tel'] = $row['user_tel'];
      $_SESSION['user_pet'] = $row['user_pet'];
      echo "<script>
        alert('เข้าสู่ระบบสำเร็จ');
        window.location.href = 'index.php';
      </script>";
    }else{
      echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
        window.history.back();
      </script>";
    }
    exit();
  }
?>