<?php 
  include('config.php');

	$sql = "SELECT * FROM user WHERE token = '".$conn->real_escape_string($_GET['token'])."'";
	$result = $conn->query($sql);
	if($result->num_rows <= 0){
		header('Location: login.php');
		exit();
	}
  $row = $result->fetch_assoc();
	$sql = "SELECT * FROM categories";
	$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="dist/img/logo/icon.png" type="image/icon type">
	<title>ระบบตลาดกลางอาหารสัตว์เลี้ยง | ตั้งค่าบัญชี</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=K2D:wght@200&display=swap" rel="stylesheet">
	<link href="dist/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
  
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="dist/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

	<link href="dist/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<style>
		.login.login-v2 label {
			color: rgba(0,0,0,.6);
		}
		textarea {
			resize: none;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			background: #348fe2!important;
			color: #f2f3f4!important;
		}
		.select2.select2-container .selection .select2-selection.select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
			color: rgba(0,0,0,.6)!important;
		}
	</style>
</head>
<body class="pace-top" style="font-family: 'K2D';">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(dist/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn" style="width: 1200px; margin: 0 0 150px -600px">
			<!-- begin wizard-form -->
			<form action="process_verify.php?token=<?php echo $_GET['token']; ?>" method="POST" name="form-wizard" class="form-control-with-bg">
				<!-- begin wizard -->
				<div id="wizard">
					<!-- begin wizard-step -->
					<ul>
						<li>
							<a href="#step-1">
								<span class="number">1</span> 
								<span class="info">
									ตั้งค่าบัญชีทั่วไป
									<small>ชื่อผู้ใช้, รหัสผ่าน</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-2">
								<span class="number">2</span> 
								<span class="info">
									ตั้งค่าข้อมูลส่วนตัว
									<small>ชื่อ, อีเมล, ที่อยู่, เบอร์ติดต่อ</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-3">
								<span class="number">3</span> 
								<span class="info">
									ข้อมูลเบื้องต้นของสัตว์เลี้ยง
									<small>ประเภทสัตว์เลี้ยง</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-4">
								<span class="number">4</span> 
								<span class="info">
									เสร็จสิ้นการลงทะเบียน
									<small>กรุณากดยืนยันข้อมูล</small>
								</span>
							</a>
						</li>
					</ul>
					<!-- end wizard-step -->
					<!-- begin wizard-content -->
					<div>
						<!-- begin step-1 -->
						<div id="step-1">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ตั้งค่าบัญชีทั่วไป</legend>
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">ชื่อผู้ใช้ (Username) <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="user_username" placeholder="ชื่อผู้ใช้ (Username)" class="form-control" data-parsley-group="step-1" data-parsley-required="true" />
											</div>
										</div>
										<!-- end form-group -->
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">รหัสผ่าน <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" id="user_password" name="user_password" placeholder="รหัสผ่าน" class="form-control" data-parsley-group="step-1" data-parsley-required="true" data-parsley-equalto="#user_password_confirm"/>
											</div>
										</div>
										<!-- end form-group -->
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" id="user_password_confirm" name="user_password_confirm" placeholder="ยืนยันรหัสผ่าน" class="form-control" data-parsley-group="step-1" data-parsley-required="true" data-parsley-equalto="#user_password" />
											</div>
										</div>
										<!-- end form-group -->
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-1 -->
						<!-- begin step-2 -->
						<div id="step-2">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ตั้งค่าข้อมูลส่วนตัว</legend>
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">ชื่อ-สกุลผู้ขาย <span class="text-danger">&nbsp;</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" placeholder="ชื่อสกุลผู้ขาย" data-parsley-group="step-1" class="form-control" value="<?php echo $row['user_fullname']; ?>" readonly/>
											</div>
										</div>
										<!-- end form-group -->
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">อีเมล <span class="text-danger">&nbsp;</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" placeholder="อีเมล" data-parsley-group="step-1" class="form-control" value="<?php echo $row['user_email']; ?>" readonly />
											</div>
										</div>
										<!-- end form-group -->
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">ที่อยู่ <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
											<textarea name="user_address" placeholder="ที่อยู่" class="form-control" data-parsley-group="step-2" data-parsley-required="true" rows="3"></textarea>
											</div>
										</div>
										<!-- end form-group -->
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">เบอร์ติดต่อ <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="user_tel" placeholder="เบอร์ติดต่อ" class="form-control" data-parsley-group="step-2" data-parsley-required="true" />
											</div>
										</div>
										<!-- end form-group -->
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-2 -->
						<!-- begin step-3 -->
						<div id="step-3">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">ข้อมูลเบื้องต้นของสัตว์เลี้ยง</legend>
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">ประเภทสัตว์เลี้ยง <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<select class="multiple-select2 form-control" id="user_pet" name="user_pet[]" multiple data-parsley-group="step-3" data-parsley-required="true">
													<?php foreach ($result as $list){ ?>
													<option value="<?php echo $list['category_name']; ?>"><?php echo $list['category_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<!-- end form-group -->
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-3 -->
						<!-- begin step-4 -->
						<div id="step-4">
							<div class="jumbotron m-b-0 text-center">
								<h2 class="display-4">เสร็จสิ้นการลงทะเบียน</h2>
								<p class="lead mb-4">กรุณากดยืนยันข้อมูลเพื่อบันทึกข้อมูล.</p>
							</div>
						</div>
						<!-- end step-4 -->
					</div>
					<!-- end wizard-content -->
				</div>
				<!-- end wizard -->
			</form>
			<!-- end wizard-form -->
		</div>
		<!-- end login -->
		
		<!-- begin login-bg -->
		<ul class="login-bg-list clearfix">
			<li class="active"><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-17.jpg" style="background-image: url(dist/img/login-bg/login-bg-17.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-16.jpg" style="background-image: url(dist/img/login-bg/login-bg-16.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-15.jpg" style="background-image: url(dist/img/login-bg/login-bg-15.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-14.jpg" style="background-image: url(dist/img/login-bg/login-bg-14.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-13.jpg" style="background-image: url(dist/img/login-bg/login-bg-13.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="dist/img/login-bg/login-bg-12.jpg" style="background-image: url(dist/img/login-bg/login-bg-12.jpg)"></a></li>
		</ul>
		<!-- end login-bg -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="dist/js/app.min.js"></script>
	<script src="dist/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="dist/plugins/select2/dist/js/select2.min.js"></script>
	<script src="dist/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
	<script src="dist/plugins/parsleyjs/dist/parsley.min.js"></script>
	<script src="dist/js/demo/form-wizards-validation.demo.js"></script>
	<script>
		$(".multiple-select2").select2({ placeholder: "กรุณาเลือกสัตว์เลี้ยงของคุณ (สามารถเลือกได้หลายประเภท)" });
	</script>
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>