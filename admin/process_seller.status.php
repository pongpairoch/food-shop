<?php 
  include('../config.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])){
    $change_status = $conn->real_escape_string($_POST['change_status']);
    $sql = "UPDATE seller SET seller_status = IF(seller_status = 1, 0, 1) WHERE seller_id = ".$change_status;
    if($conn->query($sql)){
      echo "<script>
        alert('ปรับสถานะร้านค้าสำเร็จ');
        window.location.href = 'seller.php';
      </script>";
    }else{
      echo "<script>
        alert('ปรับสถานะร้านค้าไม่สำเร็จ');
        window.location.href = 'seller.php';
      </script>";
    }
    exit();
  }
?>