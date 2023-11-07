		<?php 
			include('config.php'); 
			include('includes/header.php'); 

			// $sql = "SELECT *,(SELECT SUM(order_qty) FROM order_detail WHERE order_detail.product_id = product.product_id) as topSell FROM product";
			// if(isset($_SESSION['user_pet'])){
			// 	$listPet = explode(",", $_SESSION['user_pet']);
			// 	foreach($listPet as $list){
			// 		if(!str_contains($sql, "WHERE product_name")){
			// 			$sql .= " WHERE product_name LIKE '%$list%'";
			// 			// $sql .= " WHERE product_name LIKE '%$list%' OR product_detail LIKE '%$list%'";
			// 		}else{
			// 			$sql .= " OR product_name LIKE '%$list%'";
			// 			// $sql .= " OR product_name LIKE '%$list%' OR product_detail LIKE '%$list%'";
			// 		}
			// 	}
			// }
			
			// if(!str_contains($sql, "WHERE product_name")){
			// 	$sql .= " WHERE product_qty > 0 ORDER BY topSell DESC LIMIT 12";
			// }else{
			// 	$sql .= " AND product_qty > 0 ORDER BY topSell DESC LIMIT 12";
			// }
			// $resultForUser = $conn->query($sql);

			$sql = "SELECT *,(SELECT SUM(order_qty) FROM order_detail WHERE order_detail.product_id = product.product_id) as topSell FROM product WHERE product_qty > 0 ORDER BY topSell DESC LIMIT 6";
			$resultTrending = $conn->query($sql);

			$sql = "SELECT * FROM brands";
			$resultBrands = $conn->query($sql);
		?>

		<!-- BEGIN #slider -->
		<div id="slider" class="section-container p-0 bg-black-darker">
			<!-- BEGIN carousel -->
			<div id="main-carousel" class="carousel slide" data-ride="carousel">
				<!-- BEGIN carousel-inner -->
				<div class="carousel-inner">
					<!-- BEGIN item -->
					<div class="carousel-item active" data-paroller="true" data-paroller-factor="0.3" data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01" style="background: url(dist/img/slider/slider-1-cover.jpg) center 0 / cover no-repeat;">
						<div class="container">
							<img src="dist/img/slider/slider-1-product.png" class="product-img right bottom fadeInRight animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-left">
							<div class="container">
								<!-- <h3 class="title m-b-5 fadeInLeftBig animated">iMac</h3>
								<p class="m-b-15 fadeInLeftBig animated">The vision is brighter than ever.</p>
								<div class="price m-b-30 fadeInLeftBig animated"><small>from</small> <span>$2299.00</span></div>
								<a href="product_detail.html" class="btn btn-outline btn-lg fadeInLeftBig animated">Buy Now</a> -->
							</div>
						</div>
					</div>
					<!-- END item -->
					<!-- BEGIN item -->
					<div class="carousel-item" data-paroller="true" data-paroller-factor="-0.3" data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01" style="background: url(dist/img/slider/slider-2-cover.jpg) center 0 / cover no-repeat;">
						<div class="container">
							<img src="dist/img/slider/slider-2-product.png" class="product-img left bottom fadeInLeft animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-right">
							<div class="container">
								<!-- <h3 class="title m-b-5 fadeInRightBig animated">iPhone X</h3>
								<p class="m-b-15 fadeInRightBig animated">Say hello to the future.</p>
								<div class="price m-b-30 fadeInRightBig animated"><small>from</small> <span>$1,149.00</span></div>
								<a href="product_detail.html" class="btn btn-outline btn-lg fadeInRightBig animated">Buy Now</a> -->
							</div>
						</div>
					</div>
					<!-- END item -->
					<!-- BEGIN item -->
					<div class="carousel-item" data-paroller="true" data-paroller-factor="-0.3" data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01" style="background: url(dist/img/slider/slider-2-cover.jpg) center 0 / cover no-repeat;">
						<div class="container">
							<img src="dist/img/slider/slider-3-product.png" class="product-img left bottom fadeInLeft animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-right">
							<div class="container">
								<!-- <h3 class="title m-b-5 fadeInRightBig animated">iPhone X</h3>
								<p class="m-b-15 fadeInRightBig animated">Say hello to the future.</p>
								<div class="price m-b-30 fadeInRightBig animated"><small>from</small> <span>$1,149.00</span></div>
								<a href="product_detail.html" class="btn btn-outline btn-lg fadeInRightBig animated">Buy Now</a> -->
							</div>
						</div>
					</div>
					<!-- END item -->
				</div>
				<!-- END carousel-inner -->
				<a class="carousel-control-prev" href="#main-carousel" data-slide="prev"> 
				<i class="fa fa-angle-left"></i> 
				</a>
				<a class="carousel-control-next" href="#main-carousel" data-slide="next"> 
				<i class="fa fa-angle-right"></i> 
				</a>
			</div>
			<!-- END carousel -->
		</div>
		<!-- END #slider -->
	
		<!-- BEGIN #trending-items -->
		<div id="trending-items" class="section-container">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h4 class="section-title clearfix">
					<!-- <a href="product.php" class="pull-right">แสดงสินค้าทั้งหมด</a> -->
					รายการสินค้าที่แนะนำสำหรับคุณ
					<!-- <small>Shop and get your favourite items at amazing prices!</small> -->
				</h4>
				<!-- END section-title -->
				<!-- BEGIN row -->
				<div class="row row-space-10">
					<?php foreach ($resultForUser as $item) { ?>
					<!-- BEGIN col-2 -->
					<div class="col-lg-2 col-md-4 mb-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<a href="product_detail.php?id=<?php echo $item['product_id']; ?>" class="item-image">
								<img src="<?php echo $item['product_image']; ?>" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/>
								<!-- <div class="discount">15% OFF</div> -->
							</a>
							<div class="item-info">
								<h4 class="item-title">
									<a href="product_detail.php?id=<?php echo $item['product_id']; ?>"><?php echo $item['product_name']; ?></a>
								</h4>
								<p class="item-desc"><?php echo $item['product_detail']; ?></p>
								<div class="item-price"><?php echo $item['product_price']; ?> ฿</div>
								<!-- <div class="item-discount-price"><?php echo $item['product_price']+($item['product_price']*25)/100; ?> ฿</div> -->
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<?php } ?>
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #trending-items -->

		<!-- BEGIN #trending-items -->
		<div id="trending-items" class="section-container">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h4 class="section-title clearfix">
					<a href="product.php" class="pull-right">แสดงสินค้าทั้งหมด</a>
					รายการสินค้าที่ได้รับความนิยม 
					<!-- <small>Shop and get your favourite items at amazing prices!</small> -->
				</h4>
				<!-- END section-title -->
				<!-- BEGIN row -->
				<div class="row row-space-10">
					<?php foreach ($resultTrending as $item) { ?>
					<!-- BEGIN col-2 -->
					<div class="col-lg-2 col-md-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<a href="product_detail.php?id=<?php echo $item['product_id']; ?>" class="item-image">
								<img src="<?php echo $item['product_image']; ?>" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/>
								<!-- <div class="discount">15% OFF</div> -->
							</a>
							<div class="item-info">
								<h4 class="item-title">
									<a href="product_detail.php?id=<?php echo $item['product_id']; ?>"><?php echo $item['product_name']; ?></a>
								</h4>
								<p class="item-desc"><?php echo $item['product_detail']; ?></p>
								<div class="item-price"><?php echo $item['product_price']; ?> ฿</div>
								<!-- <div class="item-discount-price"><?php echo $item['product_price']+($item['product_price']*25)/100; ?> ฿</div> -->
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<?php } ?>
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #trending-items -->

		<?php 
			foreach ($resultBrands as $row){ 
				$sql = "SELECT *,(SELECT SUM(order_qty) FROM order_detail WHERE order_detail.product_id = product.product_id) as topSell FROM product WHERE brand_id = ".$row['brand_id']."  ORDER BY topSell DESC LIMIT 6";
				$result = $conn->query($sql);
			if($result->num_rows > 0){
		?>
		<!-- BEGIN #trending-items -->
		<div id="trending-items" class="section-container">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h4 class="section-title clearfix">
					<a href="product.php?brand=<?php echo $row['brand_id']; ?>" class="pull-right">แสดงสินค้าทั้งหมด</a>
					<?php echo $row['brand_name']; ?>
					<!-- <small>Shop and get your favourite items at amazing prices!</small> -->
				</h4>
				<!-- END section-title -->
				<!-- BEGIN row -->
				<div class="row row-space-10">
					<?php foreach ($result as $item) { ?>
					<!-- BEGIN col-2 -->
					<div class="col-lg-2 col-md-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<a href="product_detail.php?id=<?php echo $item['product_id']; ?>" class="item-image">
								<img src="<?php echo $item['product_image']; ?>" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/>
								<!-- <div class="discount">15% OFF</div> -->
							</a>
							<div class="item-info">
								<h4 class="item-title">
									<a href="product_detail.php?id=<?php echo $item['product_id']; ?>"><?php echo $item['product_name']; ?></a>
								</h4>
								<p class="item-desc"><?php echo $item['product_detail']; ?></p>
								<div class="item-price"><?php echo $item['product_price']; ?> ฿</div>
								<!-- <div class="item-discount-price"><?php echo $item['product_price']+($item['product_price']*25)/100; ?> ฿</div> -->
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<?php } } ?>
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #trending-items -->
		<?php } ?>

		<?php include('includes/footer.php'); ?>