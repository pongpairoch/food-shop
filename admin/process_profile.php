<?php 
  include('../config.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $admin_id = $_SESSION['admin_id'];
    $admin_fullname =  $conn->real_escape_string($_POST['admin_fullname']);
    $admin_password =  $conn->real_escape_string($_POST['admin_password']);
    $admin_password_confirm =  $conn->real_escape_string($_POST['admin_password_confirm']);
    $admin_tel =  $conn->real_escape_string($_POST['admin_tel']);
    $sql = "UPDATE seller SET admin_fullname = '$admin_fullname', admin_tel = '$admin_tel'";
    if($admin_password != "" && $admin_password_confirm != "" && $admin_password == $admin_password_confirm){
      $sql .= ", admin_password = MD5('$admin_password')";
    }
    $sql .= " WHERE admin_id = $admin_id";
    if($conn->query($sql)){
      $_SESSION['admin_fullname'] = $_POST['admin_fullname'];
      $_SESSION['admin_tel'] = $_POST['admin_tel'];
      echo "<script>
        alert('บันทึกข้อมูลผู้ขายสำเร็จ');
        window.location.href = 'profile.php';
      </script>";
    }else{
      echo "<script>
        alert('บันทึกข้อมูลขายไม่สำเร็จ');
        window.history.back();
      </script>";
    }
    exit();
  }
?>
