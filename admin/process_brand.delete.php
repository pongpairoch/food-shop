<?php 
  include('../config.php');

  if(!empty($_GET) && isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === "delete"){
    try {
      $brand_id = $conn->real_escape_string($_GET['id']);
      $sql = "SELECT * FROM brands WHERE brand_id = ".$brand_id;
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if ($row['brand_image'] != "" && !unlink("../".$row['brand_image'])) { 
        echo "<script>
          alert('ลบรูปแบรนด์ไม่สำเร็จ');
          window.location.href = 'brands.php';
        </script>";
        exit();
      }
      $sql = "DELETE FROM brands WHERE brand_id = ".$brand_id;
      if($conn->query($sql)){
        echo "<script>
          alert('ลบข้อมูลแบรนด์สำเร็จ');
          window.location.href = 'brands.php';
        </script>";
      }
      exit();
    } catch (\Throwable $th) {
      echo "<script>
        alert('ลบข้อมูลแบรนด์ไม่สำเร็จ');
        window.location.href = 'brands.php';
      </script>";
    }
  }
?>