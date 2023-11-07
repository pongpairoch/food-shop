<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	include('config.php'); 
	$sql = "SELECT *,(SELECT count(brand_id) FROM product WHERE brand_id = brands.brand_id)as count FROM brands";
	$resultBrands = $conn->query($sql);

	$sql = "SELECT *,(SELECT count(category_id) FROM product WHERE category_id = categories.category_id)as count FROM categories";
	$resultCategories = $conn->query($sql);

	$sql = "SELECT *,(SELECT count(seller_id) FROM product WHERE seller_id = seller.seller_id)as count FROM seller WHERE seller_status = 1";
	$resultSeller = $conn->query($sql);

	if(isset($_SESSION['user_id'])){
		$sql = "SELECT * FROM notifications WHERE user_id = ".$_SESSION['user_id']. " AND DATE(show_notification) > (NOW() - INTERVAL 7 DAY) AND DATE(show_notification) < (NOW()) ORDER BY noti_id DESC LIMIT 8";
		$resultNotifications = $conn->query($sql);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="dist/img/logo/icon.png" type="image/icon type">
	<title>ระบบตลาดกลางอาหารสัตว์เลี้ยง</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css2?family=K2D:wght@200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	
	<link href="dist/css/default/app.min.css" rel="stylesheet" />
	<link href="dist/css/e-commerce/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="dist/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />

	
	<link href="dist/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	
	<link href="dist/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="dist/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
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
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			background: #348fe2!important;
			color: #f2f3f4!important;
		}
		.select2.select2-container .selection .select2-selection.select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
			color: rgba(0,0,0,.6)!important;
		}
	</style>
</head>
<body style="font-family: 'K2D';">
	<!-- BEGIN #page-container -->
	<div id="page-container" class="fade">
		<!-- BEGIN #top-nav -->
		<div id="top-nav" class="top-nav">
			<!-- BEGIN container -->
			<div class="container">
				<div class="collapse navbar-collapse">
					<?php if(isset($_SESSION['user_id'])){ ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php">ออกจากระบบ</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="order.php">ประวัติการสั่งซื้อ</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php">แก้ไขข้อมูลส่วนตัว</a></li>
					</ul>
					<?php } ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="seller/register.php">สมัครเป็นผู้ขาย</a></li>
					</ul>
				</div>
			</div>
			<!-- END container -->
		</div>
		<!-- END #top-nav -->
		
		<!-- BEGIN #header -->
		<div id="header" class="header" data-fixed-top="true">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN header-container -->
				<div class="header-container">
					<!-- BEGIN navbar-toggle -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- END navbar-toggle -->
					<!-- BEGIN header-logo -->
					<div class="header-logo">
						<a href="./">
							<!-- <span class="brand-logo"></span> -->
							<img src="dist/img/logo/icon.png" class="ml-2 mr-3" style="width: 50px; height: 50px;">
							<span class="brand-text">
								<span class="text-primary">P</span>et <span class="text-primary">F</span>ood <span class="text-primary">S</span>tore
								<small>ระบบตลาดกลางอาหารสัตว์เลี้ยง</small>
							</span>
						</a>
					</div>
					<!-- END header-logo -->
					<!-- BEGIN header-nav -->
					<div class="header-nav">
						<div class=" collapse navbar-collapse" id="navbar-collapse">
							<ul class="nav">
								<li><a href="./">หน้าหลัก</a></li>
								<li class="dropdown dropdown-full-width dropdown-hover">
									<a href="#" data-toggle="dropdown">
										ร้านค้าของเรา
										<b class="caret"></b>
										<span class="arrow top"></span>
									</a>
									<!-- BEGIN dropdown-menu -->
									<div class="dropdown-menu p-0">
										<!-- BEGIN dropdown-menu-container -->
										<div class="dropdown-menu-container">
											<!-- BEGIN dropdown-menu-sidebar -->
											<div class="dropdown-menu-sidebar">
												<h4 class="title">หมวดหมู่</h4>
												<ul class="dropdown-menu-list">
													<?php foreach ($resultCategories as $item){ ?>
													<li><a href="<?php echo ($item['count'] == 0)?"#" :"product.php?category=".$item['category_id']; ?>"><?php echo $item['category_name']; ?> <span class="pull-right">(<?php echo $item['count']; ?>)</span></a></li>
													<?php } ?>
												</ul>
											</div>
											<!-- END dropdown-menu-sidebar -->
											<!-- BEGIN dropdown-menu-content -->
											<div class="dropdown-menu-content">
												<h4 class="title">ร้านค้า</h4>
												<div class="row">
													<?php foreach ($resultSeller as $item){ ?>
													<div class="col-lg-3">
														<ul class="dropdown-menu-list">
															<li><a href="<?php echo ($item['count'] == 0)?"#" :"product.php?shop=".$item['seller_id']; ?>"><i class="fa fa-fw fa-angle-right text-muted"></i> <?php echo $item['seller_shop']; ?> <span class="pull-right">(<?php echo $item['count']; ?>)</span></a></li>
														</ul>
													</div>
														<?php } ?>
												</div>
												<h4 class="title">แบรนด์</h4>
												<ul class="dropdown-brand-list m-b-0">
													<?php foreach ($resultBrands as $item){ ?>
													<li><a href="<?php echo ($item['count'] == 0)?"#" :"product.php?brand=".$item['brand_id']; ?>"><img src="<?php echo $item['brand_image']; ?>" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/></a></li>
													<?php } ?>
												</ul>
											</div>
											<!-- END dropdown-menu-content -->
										</div>
										<!-- END dropdown-menu-container -->
									</div>
									<!-- END dropdown-menu -->
								</li>
								<li><a href="product.php">สินค้าทั้งหมด</a></li>
								<li class="dropdown dropdown-hover">
									<a href="#" data-toggle="dropdown">
										<i class="fa fa-search search-btn"></i>
										<span class="arrow top"></span>
									</a>
									<div class="dropdown-menu p-15">
										<form action="product.php" method="GET" name="search_form">
											<div class="input-group">
												<input type="text" placeholder="ค้นหาสินค้า" name="q" class="form-control bg-silver-lighter" value="<?php echo (isset($_GET['q']) && $_GET['q'] !== '')? $_GET['q']: ""; ?>" />
												<div class="input-group-append">
													<button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- END header-nav -->
					<!-- BEGIN header-nav -->
					<div class="header-nav">
						<ul class="nav pull-right">
							<?php if(isset($_SESSION['user_id'])){ ?>
							<li class="dropdown dropdown-hover dropdown-notification">
								<a href="#" class="header-cart" data-toggle="dropdown">
									<i class="fa fa-bell"></i>
									<span class="total"><?php echo $resultNotifications->num_rows; ?></span>
									<span class="arrow top"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-cart p-0">
									<div class="cart-header">
										<h4 class="cart-title">การแจ้งเตือน (<?php echo $resultNotifications->num_rows; ?>) </h4>
									</div>
									<div class="cart-body">
										<ul class="cart-item">
											<?php 
												if($resultNotifications->num_rows > 0){
													foreach ($resultNotifications as $list){ 
											?>
											<li class="d-flex align-items-center">
												<div class="cart-item-image p-0" style="width: 3rem; height: 2.75rem; border: 0px;"><img src="https://cdn-icons-png.flaticon.com/512/60/60977.png" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'" /></div>
												<div class="cart-item-info">
													<a href="product_detail.php?id=<?php echo $list['product_id']; ?>" style="text-decoration: none; color: inherit;">
														<h4><?php echo $list['product_name']; ?> ของคุณใกล้หมดรึยังน๊าาา</h4>
														<p class="price">แสดงถึง: <?php echo $list['show_notification']; ?></p>
													</a>
												</div>
											</li>
											<?php } }else { ?>
												<li>
												<div class="cart-item-info p-0">
													<h4 class="text-center">ไม่มีการแจ้งเตือน</h4>
												</div>
												<!-- <div class="cart-item-close">
													<a data-toggle="tooltip">&times;</a>
												</div> -->
											</li>
											<?php } ?>
										</ul>
									</div>
									<!-- <div class="cart-footer">
										<div class="row row-space-10">
											<div class="col-12">
												<a href="#" class="btn btn-default btn-theme btn-block">ดูการแจ้งเตือนทั้งหมด</a>
											</div>
										</div>
									</div> -->
								</div>
							</li>
							<li class="dropdown dropdown-hover dropdown-cart">
								<a href="#" class="header-cart" data-toggle="dropdown">
									<i class="fa fa-shopping-bag"></i>
									<span class="total">2</span>
									<span class="arrow top"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-cart p-0">
									<div class="cart-header">
										<h4 class="cart-title">ตะกร้าสินค้า (x) </h4>
									</div>
									<div class="cart-body">
										<ul class="cart-item">

										</ul>
									</div>
									<div class="cart-footer">
										<div class="row row-space-10">
											<div class="col-12">
												<a href="checkout_cart.php" class="btn btn-default btn-theme btn-block">ดูสินค้าในตะกร้าทั้งหมด</a>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php } ?>
							<li class="divider"></li>
							<li>
								<a href="<?php echo (isset($_SESSION['user_id']))?"profile.php" :"login.php" ?>">
									<img src="dist/img/logo/icon.png" class="user-img" alt="" /> 
									<span class="d-none d-xl-inline"><?php echo (isset($_SESSION['user_id']))?$_SESSION['user_fullname'] :"เข้าสู่ระบบ/สมัครสมาชิก"; ?></span>
								</a>
							</li>
						</ul>
					</div>
					<!-- END header-nav -->
				</div>
				<!-- END header-container -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #header -->
		