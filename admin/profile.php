<?php 
  include('../config.php');
  include('includes/authentication.php'); 
  include('includes/header.php'); 
?>

<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="./">หน้าหลัก</a></li>
    <li class="breadcrumb-item active"><a href="brands.php">จัดการแบรนด์</a></li>
    <li class="breadcrumb-item active">แก้ไขข้อมูลส่วนตัว</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">
    แก้ไขข้อมูลส่วนตัว 
    <!-- <small>header small text goes here...</small> -->
  </h1>
  <!-- end page-header -->

  <!-- begin panel -->
  <form action="process_profile.php" method="POST" enctype="multipart/form-data" data-parsley-validate="true">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">แก้ไขข้อมูลส่วนตัว</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label>รหัสแอดมิน</label>
              <input type="text" class="form-control" placeholder="รหัสแอดมิน" value="<?php echo $_SESSION['admin_id']; ?>" readonly>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label>ชื่อบัญชีแอดมิน</label>
              <input type="text" class="form-control" value="<?php echo $_SESSION['admin_username']; ?>" readonly>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label>อีเมล</label>
              <input type="text" class="form-control" value="<?php echo $_SESSION['admin_email']; ?>" readonly>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="admin_fullname">ชื่อแอดมิน</label>
              <input type="text" class="form-control" id="admin_fullname" name="admin_fullname" placeholder="ชื่อ-สกุลผู้ขาย" data-parsley-required="true" value="<?php echo $_SESSION['admin_fullname']; ?>">
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="admin_tel">เบอร์ติดต่อ</label>
              <input type="text" class="form-control" id="admin_tel" name="admin_tel" placeholder="เบอร์ติดต่อ" data-parsley-required="true" value="<?php echo $_SESSION['admin_tel']; ?>">
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="admin_password">รหัสผ่าน (หากไม่เปลี่ยน โปรดปล่อยว่าง)</label>
							<input type="password" id="admin_password" name="admin_password" placeholder="รหัสผ่าน" class="form-control" data-parsley-equalto="#admin_password_confirm" />
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="admin_password_confirm">ยืนยันรหัสผ่าน (หากไม่เปลี่ยน โปรดปล่อยว่าง)</label>
              <input type="password" id="admin_password_confirm" name="admin_password_confirm" placeholder="ยืนยันรหัสผ่าน" class="form-control" data-parsley-equalto="#admin_password" />
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer text-right">
        <button type="submit" class="btn btn-warning btn-sm m-l-5">แก้ไขข้อมูลส่วนตัว</button>
      </div>
    </div>
  </form>
  <!-- end panel -->

</div>
<!-- end #content -->

<?php include('includes/footer.php'); ?>

<script>
  $(document).ready(function() {
    $(".default-select2").select2();
  });
</script>
