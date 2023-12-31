
		<!-- BEGIN #footer-copyright -->
		<div id="footer-copyright" class="footer-copyright">
			<!-- BEGIN container -->
			<div class="container">
				<div class="payment-method">
					<!-- <img src="dist/img/payment/payment-method.png" alt="" /> -->
					<!-- Copyright &copy; 2019 SeanTheme. All rights reserved. -->
				</div>
				<div class="copyright">
					<!-- Copyright &copy; 2019 SeanTheme. All rights reserved. -->
				</div>
			</div>
			<!-- END container -->
		</div>
		<!-- END #footer-copyright -->
	</div>
	<!-- END #page-container -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="dist/js/e-commerce/app.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>
	<script src="dist/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
	<script src="dist/plugins/parsleyjs/dist/parsley.min.js"></script>
	<script src="dist/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="dist/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="dist/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="dist/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="dist/js/demo/table-manage-default.demo.js"></script>

	<script>
		Omise.setPublicKey("pkey_test_5r0gn5997jah59d6ns1");
		
		let cartObject = JSON.parse(localStorage.getItem('items')) || [];
		var cartGroupSeller = [];
		const payOmise = () => {
			var form = document.querySelector('form[action="process_checkout.php"]');
			tokenParameters = {
				"expiration_month": parseInt($('input[name="mm"]').val()),
				"expiration_year": parseInt($('input[name="yy"]').val()),
				"name": $('input[name="cardHolder"]').val(),
				"number": $('input[name="cardNumber"]').val(),
				"security_code": parseInt($('input[name="number"]').val()),
			};
			Omise.createToken("card", tokenParameters, function(statusCode, response) {
				if(statusCode === 200){
					const newCartObject = JSON.parse(localStorage.getItem('items')) || [];
					groupSeller(newCartObject)
					console.log(newCartObject.reduce((a, b)=> a + b.price * b.qty, 0))
					form.items.value = JSON.stringify(cartGroupSeller);
					form.amount.value = newCartObject.reduce((a, b)=> a + b.price * b.qty, 0) * 100;
					form.omiseToken.value = response.id;
					form.submit();
				}else{
					alert("Error ", response.message);
				}
			});
		}
		const groupSeller = (newCartObject) => {
			cartGroupSeller = [];
			newCartObject.map((item)=>{
				let checkItem = cartGroupSeller.find((x)=> x.key == item.seller)
				if(checkItem){
					checkItem.order = [...checkItem.order, item]
					cartGroupSeller.map((x)=> x.seller === item.seller?checkItem :x);
				}else{
					const newItem = {key: item.seller, shop: item.shop, order: [item] }
					cartGroupSeller = [...cartGroupSeller, newItem];
				}
			})
		}
		const renderCountCart = () => {
			const cartObject = JSON.parse(localStorage.getItem('items')) || [];
			$(".dropdown-cart .header-cart span.total").html(cartObject.reduce((a, b)=> a + b.qty, 0));
			$(".dropdown-cart .cart-header .cart-title").html(`ตะกร้าสินค้า (${cartObject.reduce((a, b)=> a + b.qty, 0)})`);
			$(".dropdown-cart .cart-body .cart-item").html("");
			if(cartObject.length <= 0) {
				$(".dropdown-cart .cart-body .cart-item").append(`<h5 class="text-center">ตะกร้าสินค้าว่าง</h5>`);
			}else{
				const cartObjectLimit = cartObject.slice(0, 5)
				cartObjectLimit.map((item)=>{
					$(".dropdown-cart .cart-body .cart-item").append(`
						<li>
							<div class="cart-item-image"><img src="${item.img}" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'" /></div>
							<div class="cart-item-info">
								<h4>${item.name}</h4>
								<p class="price">${item.price} ฿ <span class="pull-right">x ${item.qty}</span></p>
								
							</div>
							<div class="cart-item-close">
								<a data-toggle="tooltip" onclick="removeItemMiniCart(${item.id})">&times;</a>
							</div>
						</li>
					`);
				})
			}
		}
		const renderCart = () => {
			const cartObject = JSON.parse(localStorage.getItem('items')) || [];
			groupSeller(cartObject)
			$(".table-cart").html("")
			$(`#cart-item-*`).html("")
			if(cartObject.length <= 0) {
				$(".table-cart").append(`<tr> <th scope="row" colspan="5" class="text-center">ตะกร้าของคุณว่าง กรุณาสั่งซื้อสินค้า</th> </tr>`);
				$("button.sw-btn-next").hide();
			}else{
				$("button.sw-btn-next").show();
				cartGroupSeller.map((seller)=>{
					$(".table-cart").append(`
						<thead id="cart-head">
							<tr>
								<th>ร้าน(#${seller.key}: ${seller.shop}) ชื่อสินค้า</th>
								<th class="text-center">ราคา</th>
								<th class="text-center">จำนวน</th>
								<th class="text-center">รวม</th>
							</tr>
						</thead>
					`);
					$(".table-cart").append(`<tbody id="cart-item-${seller.key}">`)
					seller.order.map((item)=>{
						$(`#cart-item-${seller.key}`).append(`
							<tr>
								<td class="cart-product">
									<div class="product-img" style="width: 5rem;">
										<img src="${item.img}" onError="this.src='https://thaigifts.or.th/wp-content/uploads/2017/03/no-image.jpg'" />
									</div>
									<div class="product-info">
										<div class="title">${item.name}</div>
										<!-- <div class="desc">Delivers Tue 26/04/2016 - Free</div> -->
									</div>
								</td>
								<td class="cart-price text-center">${item.price}</td>
								<td class="cart-qty text-center">
									<div class="cart-qty-input">
										<a href="#" class="qty-control left disabled" data-id="${item.id}" data-click="decrease-qty" data-target="#qty-${item.id}"><i class="fa fa-minus"></i></a>
										<input type="text" name="qty" value="${item.qty}" class="form-control" id="qty-${item.id}" readonly/>
										<a href="#" class="qty-control right disabled" data-id="${item.id}" data-click="increase-qty" data-target="#qty-${item.id}"><i class="fa fa-plus"></i></a>
									</div>
									<div class="qty-desc" style="cursor: pointer;" onclick="removeItemCart(${seller.key}, ${item.id})">ลบสินค้านี้</div>
								</td>
								<td id="cart-total-${item.id}" class="cart-total text-center">
									${item.price * item.qty}฿
								</td>
							</tr>
						`);
					})
					$(".table-cart").append(`</tbody>`)
				})
				$(".table-cart").append(`
					<tbody id="cart-item">
						<tr>
							<td class="cart-summary" colspan="4">
								<div class="summary-container">
									<div class="summary-row total" style="border-top: 0px; margin-top: 0;">
										<div class="field">รวมทั้งหมด</div>
										<div class="value">${cartObject.reduce((a, b)=> a + b.price * b.qty, 0)+"฿"}</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				`)
			}
		}
		const addCart = (seller, shop, id, name, price, img) => {
			const checkItem = cartObject.find((x)=>x.id === id);
			if(checkItem){
				checkItem.qty = parseInt(checkItem.qty) + 1;
				cartObject.map((x)=> x.id === id?checkItem :x);
			}else{
				cartObject = [...cartObject, { seller, shop, id, name, price, qty: 1, img }];
			}
			localStorage.setItem("items", JSON.stringify(cartObject));
			renderCountCart();
		}
		const removeItemMiniCart = (id) => {
			cartObject = cartObject.filter((x)=> x.id !== id)
			localStorage.setItem("items", JSON.stringify(cartObject));
			renderCountCart();
		}
		const removeItemCart = (seller, id) => {
			cartObject = cartObject.filter((x)=> x.id !== id)
			localStorage.setItem("items", JSON.stringify(cartObject));
			const newCartObject = JSON.parse(localStorage.getItem('items')) || [];
			groupSeller(newCartObject)
			renderCart();
			renderCountCart();
		}
		renderCart();
		renderCountCart();
	</script>
	<script src="dist/js/demo/form-wizards-validation.checkout.js"></script>
	<script src="dist/plugins/select2/dist/js/select2.min.js"></script>
	<script>
		$(".multiple-select2").select2({ placeholder: "กรุณาเลือกสัตว์เลี้ยงของคุณ (สามารถเลือกได้หลายประเภท)" });
	</script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	
</body>
</html>