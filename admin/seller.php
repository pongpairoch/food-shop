<?php 
  include('../config.php');
  include('includes/authentication.php'); 
  include('includes/header.php'); 

  $sql = "SELECT * FROM seller";
  $result = $conn->query($sql);
?>

<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="./">หน้าหลัก</a></li>
    <li class="breadcrumb-item active">จัดการร้านค้า</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">
    จัดการร้านค้า 
    <!-- <small>header small text goes here...</small> -->
  </h1>
  <!-- end page-header -->

  <!-- begin panel -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">จัดการร้านค้า</h4>
    </div>
    <div class="panel-body" style="overflow-y: scroll;">
      <table id="data-table-default" class="table table-bordered">
        <thead>
          <tr>
            <th width="1%"></th>
            <th width="1%" data-orderable="false"></th>
            <th class="text-nowrap">ชื่อร้านค้า</th>
            <th width="15rem" class="text-nowrap">รายละเอียดร้านค้า</th>
            <th class="text-nowrap">บัญชีผู้ขาย</th>
            <th class="text-nowrap">ชื่อ-สกุลผู้ขาย</th>
            <th class="text-nowrap">เบอร์ติดต่อ</th>
            <th class="text-nowrap">อัพเดทล่าสุด</th>
            <th class="text-nowrap text-center">สถานะ</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key => $row){ ?>
          <tr>
            <td width="1%" class="f-s-600 text-inverse"><?php echo $key+1; ?></td>
            <td width="1%" class="with-img"><img src="../<?php echo $row['seller_image']; ?>" class="img-rounded height-30" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/></td>
            <td><?php echo $row['seller_shop']; ?></td>
            <td><div class="ellipsis-3" style="width: 15rem;"><?php echo $row['seller_detail']; ?></div></td>
            <td><?php echo $row['seller_username']; ?></td>
            <td><?php echo $row['seller_fullname']; ?></td>
            <td><?php echo $row['seller_tel']; ?></td>
            <td><?php echo $row['updatedAt']; ?></td>
            <td class="text-center"><form action="process_seller.status.php" method="POST"><button type="submit" class="btn btn-<?php echo ($row['seller_username']===NULL)? "warning": (((bool)$row['seller_status'])?"success": "danger"); ?>" name="change_status" value="<?php echo $row['seller_id']; ?>" <?php echo ($row['seller_username']===NULL)?"disabled": ""; ?> ><?php echo ($row['seller_username']===NULL)? "ยังไม่ยืนยันตัวตน":(((bool)$row['seller_status'])?"เปิดใช้งาน": "ปิดใช้งาน"); ?></button></form></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end panel -->

</div>
<!-- end #content -->

<?php include('includes/footer.php'); ?>
