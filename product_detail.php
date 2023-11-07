		<?php 
			include('config.php'); 
			include('includes/header.php'); 

			$sql = "SELECT * FROM product LEFT JOIN brands ON product.brand_id = brands.brand_id LEFT JOIN categories ON product.category_id = categories.category_id LEFT JOIN seller ON product.seller_id = seller.seller_id WHERE product_id = ".$conn->real_escape_string($_GET['id'])." AND product_status = 1";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			$sql = "SELECT * FROM product WHERE category_id = ".$row['category_id']." AND product_status = 1 LIMIT 6";
			$result = $conn->query($sql);

			$sql = "SELECT * FROM product_review LEFT JOIN user ON product_review.user_id = user.user_id WHERE product_id = ".$row['product_id'];
			$resultReview = $conn->query($sql);
		?>
		
		<!-- BEGIN #product -->
		<div id="product" class="section-container p-t-20">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN breadcrumb -->
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="./">หน้าหลัก</a></li>
					<li class="breadcrumb-item"><a href="product.php?category=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></li>
					<li class="breadcrumb-item"><a href="product.php?brand=<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></a></li>
					<li class="breadcrumb-item active"><?php echo $row['product_name']; ?></li>
				</ul>
				<!-- END breadcrumb -->
				<!-- BEGIN product -->
				<div class="product">
					<!-- BEGIN product-detail -->
					<div class="product-detail">
						<!-- BEGIN product-image -->
						<div class="product-image">
							<!-- BEGIN product-main-image -->
							<div class="product-main-image" data-id="main-image">
								<img src="<?php echo $row['product_image']; ?>" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'"/>
							</div>
							<!-- END product-main-image -->
						</div>
						<!-- END product-image -->
						<!-- BEGIN product-info -->
						<div class="product-info">
							<!-- BEGIN product-info-header -->
							<div class="product-info-header">
								<h1 class="product-title">
									<!-- <span class="badge bg-primary">41% OFF</span>  -->
									<?php echo $row['product_name']; ?> 
								</h1>
								<ul class="product-category">
									<li>ร้าน: <a href="product.php?shop=<?php echo $row['seller_id']; ?>"><?php echo $row['seller_shop']; ?></a></li>
									<li>/</li>
									<li>ประเภท: <a href="product.php?category=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></li>
									<li>/</li>
									<li>แบรนด์: <a href="product.php?brand=<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></a></li>
								</ul>
							</div>
							<!-- END product-info-header -->
							<!-- BEGIN product-warranty -->
							<!-- <div class="product-warranty">
								<div class="pull-right">Availability: In stock</div>
								<div><b>1 Year</b> Local Manufacturer Warranty</div>
							</div> -->
							<!-- END product-warranty -->
							<!-- BEGIN product-info-list -->
							<ul class="product-info-list">
								<li><i class="fa fa-circle"></i> <?php echo $row['product_detail']; ?></li>
							</ul>
							<!-- END product-info-list -->
							<!-- BEGIN product-purchase-container -->
							<div class="product-purchase-container">
								<div class="product-discount">
									<!-- <span class="discount"><?php echo $row['product_price']+($row['product_price']*25)/100; ?> ฿</span> -->
								</div>
								<div class="product-price">
									<div class="price"><?php echo $row['product_price']; ?> ฿</div>
								</div>
								<?php if($row['product_qty'] <= 0){ ?>
									<button class="btn btn-inverse btn-theme btn-lg width-200" disabled>สินค้าหมด</button>
								<?php } else { ?>
								<button class="btn btn-inverse btn-theme btn-lg width-200" <?php echo (!isset($_SESSION['user_id']))?"disabled" :""; ?> onclick="addCart(<?php echo $row['seller_id']; ?>,'<?php echo $row['seller_shop']; ?>',<?php echo $row['product_id']; ?>, '<?php echo $row['product_name']; ?>', <?php echo $row['product_price']; ?>, '<?php echo $row['product_image']; ?>')">เพิ่มลงในตะกร้า</button>
								<?php } ?>
							</div>
							<!-- END product-purchase-container -->
						</div>
						<!-- END product-info -->
					</div>
					<!-- END product-detail -->
					<!-- BEGIN product-tab -->
					<div class="product-tab">
						<!-- BEGIN #product-tab -->
						<ul id="product-tab" class="nav nav-tabs">
							<!-- <li class="nav-item"><a class="nav-link active" href="#product-desc" data-toggle="tab">Product Description</a></li>
							<li class="nav-item"><a class="nav-link" href="#product-info" data-toggle="tab">Additional Information</a></li> -->
							<li class="nav-item"><a class="nav-link active" href="#product-reviews" data-toggle="tab">รีวิวสินค้า (<?php echo $resultReview->num_rows; ?>)</a></li>
						</ul>
						<!-- END #product-tab -->
						<!-- BEGIN #product-tab-content -->
						<div id="product-tab-content" class="tab-content">
							<!-- BEGIN #product-desc -->
							<div class="tab-pane fade" id="product-desc">
								<!-- BEGIN product-desc -->
								<div class="product-desc">
									<div class="image">
										<img src="dist/img/product/product-main.jpg" alt="" />
									</div>
									<div class="desc">
										<h4>iPhone 6s</h4>
										<p>
											The moment you use iPhone 6s, you know you’ve never felt anything like it. With a single press, 3D Touch lets you do more than ever before. Live Photos bring your memories to life in a powerfully vivid way. And that’s just the beginning. Take a deeper look at iPhone 6s, and you’ll find innovation on every level.
										</p>
									</div>
								</div>
								<!-- END product-desc -->
								<!-- BEGIN product-desc -->
								<div class="product-desc right">
									<div class="image">
										<img src="dist/img/product/product-3dtouch.jpg" alt="" />
									</div>
									<div class="desc">
										<h4>3D Touch</h4>
										<p>
											The original iPhone introduced the world to Multi-Touch, forever changing the way people experience technology. With 3D Touch, you can do things that were never possible before. It senses how deeply you press the display, letting you do all kinds of essential things more quickly and simply. And it gives you real-time feedback in the form of subtle taps from the all-new Taptic Engine.
										</p>
									</div>
								</div>
								<!-- END product-desc -->
								<!-- BEGIN product-desc -->
								<div class="product-desc">
									<div class="image">
										<img src="dist/img/product/product-cameras.jpg" alt="" />
									</div>
									<div class="desc">
										<h4>Cameras</h4>
										<p>
											The 12-megapixel iSight camera captures sharp, detailed photos. It takes brilliant 4K video, up to four times the resolution of 1080p HD video. iPhone 6s also takes selfies worthy of a self-portrait with the new 5-megapixel FaceTime HD camera. And it introduces Live Photos, a new way to relive your favorite memories. It captures the moments just before and after your picture and sets it in motion with just the press of a finger.
										</p>
									</div>
								</div>
								<!-- END product-desc -->
								<!-- BEGIN product-desc -->
								<div class="product-desc right">
									<div class="image">
										<img src="dist/img/product/product-technology.jpg" alt="" />
									</div>
									<div class="desc">
										<h4>Technology</h4>
										<p>
											iPhone 6s is powered by the custom-designed 64-bit A9 chip. It delivers performance once found only in desktop computers. You’ll experience up to 70 percent faster CPU performance, and up to 90 percent faster GPU performance for all your favorite graphics-intensive games and apps.
										</p>
									</div>
								</div>
								<!-- END product-desc -->
								<!-- BEGIN product-desc -->
								<div class="product-desc">
									<div class="image">
										<img src="dist/img/product/product-design.jpg" alt="" />
									</div>
									<div class="desc">
										<h4>Design</h4>
										<p>
											Innovation isn’t always obvious to the eye, but look a little closer at iPhone 6s and you’ll find it’s been fundamentally improved. The enclosure is made from a new alloy of 7000 Series aluminum — the same grade used in the aerospace industry. The cover glass is the strongest, most durable glass used in any smartphone. And a new rose gold finish joins space gray, silver, and gold.
										</p>
									</div>
								</div>
								<!-- END product-desc -->
							</div>
							<!-- END #product-desc -->
							<!-- BEGIN #product-info -->
							<div class="tab-pane fade" id="product-info">
								<!-- BEGIN table-responsive -->
								<div class="table-responsive">
									<!-- BEGIN table-product -->
									<table class="table table-product table-striped">
										<thead>
											<tr>
												<th></th>
												<th>iPhone 6s</th>
												<th>iPhone 6s Plus</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="field">Capacity</td>
												<td>
													16GB<br />
													64GB<br />
													128GB
												</td>
												<td>
													16GB<br />
													64GB<br />
													128GB
												</td>
											</tr>
											<tr>
												<td class="field">Weight and Dimensions</td>
												<td>
													5.44 inches (138.3 mm) x 2.64 inches (67.1 mm) x 0.28 inch (7.1 mm)<br />
													Weight: 5.04 ounces (143 grams)
												</td>
												<td>
													6.23 inches (158.2 mm) x 3.07 inches (77.9 mm) x 0.29 inch (7.3 mm)<br />
													Weight: 6.77 ounces (192 grams)
												</td>
											</tr>
											<tr>
												<td class="field">Display</td>
												<td>
													Retina HD display with 3D Touch<br />
													4.7-inch (diagonal) LED-backlit widescreen<br />
													1334-by-750-pixel resolution at 326 ppi<br />
													1400:1 contrast ratio (typical)<br />
													<br />
													<b>Both models:</b><br />
													500 cd/m2 max brightness (typical)<br />
													Full sRGB standard<br />
													Dual-domain pixels for wide viewing angles<br />
													Fingerprint-resistant oleophobic coating on front<br />
													Support for display of multiple languages and characters simultaneously<br />
													Display Zoom<br />
													Reachability
												</td>
												<td>
													Retina HD display with 3D Touch<br />
													5.5-inch (diagonal) LED-backlit widescreen<br />
													1920-by-1080-pixel resolution at 401 ppi<br />
													1300:1 contrast ratio (typical)
												</td>
											</tr>
											<tr>
												<td class="field">Chip</td>
												<td colspan="2">
													A9 chip with 64-bit architecture Embedded M9 motion coprocessor
												</td>
											</tr>
											<tr>
												<td class="field">iSight Camera</td>
												<td colspan="2">
													New 12-megapixel iSight camera with 1.22µ pixels<br />
													Live Photos<br />
													Autofocus with Focus Pixels<br />
													Optical image stabilization (iPhone 6s Plus only)<br />
													True Tone flash<br />
													Panorama (up to 63 megapixels)<br />
													Auto HDR for photos<br />
													Exposure control<br />
													Burst mode<br />
													Timer mode<br />
													ƒ/2.2 aperture<br />
													Five-element lens<br />
													Hybrid IR filter<br />
													Backside illumination sensor<br />
													Sapphire crystal lens cover<br />
													Auto image stabilization<br />
													Improved local tone mapping<br />
													Improved noise reduction<br />
													Face detection<br />
													Photo geotagging
												</td>
											</tr>
											<tr>
												<td class="field">Video Recording</td>
												<td colspan="2">
													4K video recording (3840 by 2160) at 30 fps<br />
													1080p HD video recording at 30 fps or 60 fps<br />
													720p HD video recording at 30 fps<br />
													Optical image stabilization for video (iPhone 6s Plus only)<br />
													True Tone flash<br />
													Slo-mo video support for 1080p at 120 fps and 720p at 240 fps<br />
													Time-lapse video with stabilization<br />
													Cinematic video stabilization (1080p and 720p)<br />
													Continuous autofocus video<br />
													Improved noise reduction<br />
													Take 8MP still photos while recording 4K video<br />
													Playback zoom<br />
													3x zoom<br />
													Face detection<br />
													Video geotagging
												</td>
											</tr>
										</tbody>
									</table>
									<!-- END table-product -->
								</div>
								<!-- END table-responsive -->
							</div>
							<!-- END #product-info -->
							<!-- BEGIN #product-reviews -->
							<div class="tab-pane active show fade" id="product-reviews">
								<!-- BEGIN row -->
								<div class="row row-space-30">
									<?php foreach ($resultReview as $key => $review){ ?>
									<!-- BEGIN col-7 -->
									<div class="col-md-7 mb-4 mb-lg-0">
										<!-- BEGIN review -->
										<div class="review" style=" padding: 1rem; border-bottom: <?php echo ($key+1==$resultReview->num_rows)?"0": "1"; ?>px solid #dee2e6;">
											<div class="review-info">
												<div class="review-icon"><img src="dist/img/logo/icon.png" alt="" /></div>
												<div class="review-rate">
													<!-- <ul class="review-star">
														<li class="active"><i class="fa fa-star"></i></li>
														<li class="active"><i class="fa fa-star"></i></li>
														<li class="active"><i class="fa fa-star"></i></li>
														<li class="active"><i class="fa fa-star"></i></li>
														<li class=""><i class="far fa-star"></i></li>
													</ul>
													(4/5) -->
												</div>
												<div class="review-name"><?php echo $review['user_fullname']; ?></div>
												<div class="review-date"><?php echo $review['createdAt']; ?></div>
											</div>
											<div class="review-title">
												<?php echo $review['review_title']; ?>
											</div>
											<div class="review-message">
												<?php echo $review['review_message']; ?>
											</div>
										</div>
										<!-- END review -->
									</div>
									<!-- END col-7 -->
									<?php } ?>
									<!-- BEGIN col-5 -->
									<div class="col-md-5">
										<!-- BEGIN review-form -->
										<?php if(isset($_POST['order_id'])){ ?>
										<div class="review-form">
											<form action="process_review.php" name="review_form" method="POST" data-parsley-validate="true">
												<h2>เขียนรีวิวสินค้า</h2>
												<div class="form-group">
													<label for="name">ชื่อ <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="name" data-parsley-required="true" value="<?php echo $_SESSION['user_fullname']; ?>" readonly/>
												</div>
												<div class="form-group">
													<label for="review_title">หัวข้อ <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="review_title" name="review_title" data-parsley-required="true"/>
												</div>
												<div class="form-group">
													<label for="review_message">เขียนรีวิว <span class="text-danger">*</span></label>
													<textarea class="form-control" rows="8" id="review_message" name="review_message" data-parsley-required="true"></textarea>
												</div>
												<input type="hidden" name="order_id" value="<?php echo $_POST['order_id']; ?>">
												<input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
												<button type="submit" class="btn btn-inverse btn-theme btn-lg">เขียนรีวิวสินค้าเลย</button>
											</form>
										</div>
										<?php } ?>
										<!-- END review-form --> 
									</div>
									<!-- END col-5 -->
								</div>
								<!-- END row -->
							</div>
							<!-- END #product-reviews -->
						</div>
						<!-- END #product-tab-content -->
					</div>
					<!-- END product-tab -->
				</div>
				<!-- END product -->
				<?php if($result->num_rows > 0){ ?>
				<!-- BEGIN similar-product -->
				<h4 class="m-b-15 m-t-30">สินค้าที่คุณอาจจะสนใจ</h4>
				<div class="row row-space-10">
					<?php foreach ($result as $item){ ?>
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
					<?php } } ?>
				</div>
				<!-- END similar-product -->

			</div>
			<!-- END container -->
		</div>
		<!-- END #product -->

		<?php include('includes/footer.php'); ?>
