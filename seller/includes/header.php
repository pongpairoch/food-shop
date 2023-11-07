<?php 
	if(!isset($_SESSION)){
		session_start();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="../dist/img/logo/icon.png" type="image/icon type">
	<title>ระบบตลาดกลางอาหารสัตว์เลี้ยง | ผู้ขาย</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=K2D:wght@200&display=swap" rel="stylesheet">
	<link href="../dist/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="../dist/plugins/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" />

	<link href="../dist/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

	<link href="../dist/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="../dist/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />

	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<style>
		/* table tbody tr td {
			padding: 5px!important;
		} */
		textarea {
			resize: none;
		}
		.ellipsis-1, 
		.ellipsis-1 * {
			overflow: hidden;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 1;
		}
		.ellipsis-3,
		.ellipsis-3 * {
			overflow: hidden;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 3;
		}
		.ellipsis-4, 
		.ellipsis-4 * {
			overflow: hidden;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 4;
		}
	</style>
</head>
<body style="font-family: 'K2D';">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed page-with-light-sidebar page-with-wide-sidebar">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand"><img src="../dist/img/logo/icon.png" class="ml-2 mr-3" style="width: 50px; height: 50px;"> <span class="text-primary">P</span>et <span class="text-primary">F</span>ood <span class="text-primary">S</span>tore</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="../dist/img/logo/icon.png" alt="" /> 
						<span class="d-none d-md-inline"><?php echo $_SESSION['seller_fullname']; ?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="profile.php" class="dropdown-item">แก้ไขข้อมูลส่วนตัว</a>
						<!-- <a href="shop.php" class="dropdown-item">แก้ไขข้อมูลร้าน</a> -->
						<a href="withdraw.php" class="dropdown-item">จัดการถอนเงิน</a>
						<div class="dropdown-divider"></div>
						<a href="logout.php" class="dropdown-item">ออกจากระบบ</a>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image mx-auto">
								<img src="../dist/img/logo/icon.png" alt="" />
							</div>
							<div class="info text-center">
								<!-- <b class="caret pull-right"></b> -->
								<?php echo $_SESSION['seller_fullname']; ?>
								<small>ผู้ขาย<br/>ระบบตลาดกลางอาหารสัตว์เลี้ยง</small>
							</div>
						</a>
					</li>
					<!-- <li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="icon-settings"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="icon-pencil"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="icon-question"></i> Helps</a></li>
						</ul>
					</li> -->
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">ตัวเลือก</li>
					<li class="<?php echo (in_array(explode(".php", basename($_SERVER['REQUEST_URI']))[0], ["index", "seller"]))? "active": ""; ?>">
						<a href="index.php">
							<i class="icon-screen-desktop"></i> 
							<span>รายงานยอดขาย</span>
						</a>
					</li>
					<li class="<?php echo (in_array(explode(".php", basename($_SERVER['REQUEST_URI']))[0], ["product", "product.add", "product.edit"]))? "active": ""; ?>">
						<a href="product.php">
							<i class="icon-bag"></i> 
							<span>จัดการสินค้า</span>
						</a>
					</li>
					<li class="<?php echo (in_array(explode(".php", basename($_SERVER['REQUEST_URI']))[0], ["order", "order.detail"]))? "active": ""; ?>">
						<a href="order.php">
							<i class="icon-social-dropbox"></i> 
							<span>จัดการออเดอร์</span>
						</a>
					</li>
					<li class="<?php echo (in_array(explode(".php", basename($_SERVER['REQUEST_URI']))[0], ["withdraw", "withdraw.detail"]))? "active": ""; ?>">
						<a href="withdraw.php">
							<i class="icon-wallet"></i> 
							<span>จัดการถอนเงิน</span>
						</a>
					</li>
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		