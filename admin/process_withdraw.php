<?php 
  include('../config.php');

  if(!empty($_GET) && isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === "update"){
    $withdraw_id = $conn->real_escape_string($_GET['id']);
    $sql = "UPDATE withdraw SET withdraw_status = 'wait_confirm' WHERE SUBSTRING(MD5(withdraw_id), 1, 8) = '$withdraw_id'";
    if($conn->query($sql)){
      echo "<script>
        alert('ยืนยันการชำระเงินสำเร็จ');
        window.location.href = 'withdraw.php';
      </script>";
    }else{
      echo "<script>
        alert('ยืนยันการชำระเงินไม่สำเร็จ');
        window.location.href = 'withdraw.php';
      </script>";
    }
    exit();
  }
?>