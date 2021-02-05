<?php
	require_once("functions.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Grocery Store</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->

<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<style type="text/css">
	.footer a, a:active {
		color:grey;
		text-decoration:none;
		font-family: 'Tahoma', sans-serif;
	}
	.footer a:hover {
		color:#00c4ff;
		text-decoration:none;
		transition:all 0.5s ease-in-out;
	}
	.footer {
		margin-top:3%;
		text-align:center;
		font-weight:100;
	}
	.footer p {
		color:grey;
		font-size:15px;
		font-family: 'Tahoma', sans-serif;
		line-height:25px;
	}
	@media (max-width: 414px){
		.footer {
			padding:1%;
		}
		.footer p {
			font-size:16px;
		}
	}
	@media (max-width: 384px){
		.footer {
	    	padding: 3%;
		}
		.footer p {
	    	font-size: 15px;
		}
	}
	@media (max-width: 320px){
		.footer {
			margin-top: 1%;
		}
		.footer p {
	    	font-size: 14px;
		}
	}
</style>
</head>
<script type="text/javascript">
	$(document).ready(function(){
 function load_data(search_prod)
 {
  $.ajax({
   url:"functions.php",
   method:"POST",
   data:{search_prod:search_prod},
   beforeSend: function(){
      // Show image container
      $("#loader").show();
    },
   success:function(data)
   {
    $("#result").show();
    $('#result').html(data);
   },
   complete:function(data){
      // Hide image container
      $("#loader").hide();
    }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != ''){
   load_data(search);
  }
  else if(search == ''){
    $("#result").hide();
  }
 });
});
</script>
<body>
	<?php require_once("nav-bar.php"); ?>

	<div class="logo_products">
		<div class="container">
			<div class="col-md-4" style="margin: -10px">
				<img src="images/img_groc_store.png" width="150px" height="150px">
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+91) 9999999999 </li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
				</ul>
			</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Checkout</li>
			</ul>
		</div>
	</div>
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">
						<?php
							fetch_cat();
						?>
					</ul>
				 </div>
			</nav>
		</div>
		<div class="w3l_banner_nav_right">
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3>
			
	      <div class="checkout-right">
					<h4>Your shopping cart</h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>Sr. No.</th>	
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price per item</th>
							<th>Item Total</th>
						</tr>
					</thead>
					<tbody>
							<?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST' and !isset($_POST['deliver']) and !isset($_POST['pickup']) and !isset($_POST['deliver_to_saved'])) {
   		$_SESSION['product'] = $_POST;
       $item = (count($_POST)-7)/5;
       $total=0;
       for($i=1; $i<=$item; $i++){
       				$product_id = $_POST['shipping_'.$i];
       				$query7 = "SELECT p_quantity FROM product where p_id = {$product_id}";
					$result7 = query($query7);
					$product_quantity = fetch_array($result7);
					if ($_POST['quantity_'.$i] > $product_quantity['p_quantity']) {
						echo "<script>alert('Quantity of some products are decreased due to their limited stock and high demand. Sorry for inconvenience. Please check the final amount and quanity before checkout.')</script>";
						$_POST['quantity_'.$i] = $product_quantity['p_quantity'];
					}
       	$prod_total = $_POST['quantity_'.$i]*$_POST['amount_'.$i];
	$prod =<<<DELIMETER
						<tr class="rem1">
							<td class="invert">{$i}</td>
							<td class="invert">{$_POST['item_name_'.$i]}</td>
							<td class="invert">{$_POST['quantity_'.$i]}</td>
							<td class="invert">{$_POST['amount_'.$i]}</td>
							<td class="invert">{$prod_total}</td>
						</tr>
DELIMETER;
$total = $total + $_POST['quantity_'.$i]*$_POST['amount_'.$i];
echo $prod;
}
       }
?>
				</tbody></table>
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						<li>Total Product Amount <i>-</i> <span>₹<?php echo $total; ?> </span></li>
						<?php
							if($total>500){
								echo "<li>Total Service Charges <i>-</i> <span>₹0</span></li>
									<li>Total <i>-</i> <span>₹{$total}</span></li>";
							}else{
								$total+=40;
								echo "<li>Total Service Charges <i>-</i> <span>₹40</span></li>
									<li>Total <i>-</i> <span>₹{$total}</span></li>";
							}
						?>
					</ul>
					<br>
					<?php
						if (isset($_SESSION['c_id'])) {
					?>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<section class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<button class="submit check_out" name="pickup" type="submit">Self Pickup</button>
								<br>
								<div class="first-row form-group">
									<div class="controls">
										<label class="control-label">Pickup Address : Shop No. 10, Mumbai, 500050</label>
									</div>
								</div>
							</div>
						</section>
					</form>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<section class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<button style="pointer-events: none;cursor: text;" class="submit check_out">Select from Saved</button>
								<br>
								<div class="first-row form-group">
									<div class="controls">
										<label class="control-label">
											<select style="max-width: 100%" name="address" required="">
												<option value="">Select an Address</option>
												<?php
													$query = "select * from address where c_id = {$_SESSION['c_id']} and delivery_type=1";
													$result = query($query);
													while($row = fetch_array($result)){
														$value=<<<DEL
															<option value="{$row['a_id']}">{$row['name']}, {$row['line_1']}, {$row['line_2']}, {$row['city']}, {$row['zip_code']}, {$row['phone']}</option>
DEL;
														echo $value;
													}
												?>
											</select>
										</label>
									</div>
								</div>
								<button class="submit check_out" name="deliver_to_saved" type="submit">Deliver to this Address</button>
							</div>
						</section>
					</form>
					<?php
						}
					?>
					<?php
						if (isset($_POST['deliver_to_saved'])) {
							$c_id = $_SESSION['c_id'];
							$a_id = escape_string($_POST['address']);

							$product = $_SESSION['product'];

							$query4 = "INSERT INTO `orders`(`c_id`, `a_id`, `o_datetime`, `o_type`, `o_status`) VALUES ({$c_id}, {$a_id}, now(), 'Deliver', 'Confirmed Order')";
							$query_result4 = query($query4);

							$query5 = "SELECT o_id from `orders` ORDER BY o_id DESC LIMIT 1";
							$query_result5 = query($query5);
							$row5 = fetch_array($query_result5);
							$o_id = $row5['o_id'];

							$item = (count($product)-7)/5;
					       	$total=0;
					       	for($i=1; $i<=$item; $i++){
								$prod_id = $product['shipping_'.$i];

			       				$query8 = "SELECT p_quantity FROM product where p_id = {$prod_id}";
								$result8 = query($query8);
								$product_quantity = fetch_array($result8);
								if ($product['quantity_'.$i] > $product_quantity['p_quantity']) {
									$product['quantity_'.$i] = $product_quantity['p_quantity'];
								}

								$quantity = $product['quantity_'.$i];
								$query5 = "INSERT INTO `order_item`(`o_id`, `p_id`, `quantity`) VALUES ({$o_id}, {$prod_id}, {$quantity})";
								$query_result5 = query($query5);
								$total = $total + $quantity*$product['amount_'.$i];

								$query10 = "UPDATE `product` SET `p_quantity`= p_quantity - {$quantity} WHERE `p_id` = {$prod_id}";
								$query_result10 = query($query10);
							}
							if($total<500){
								$total+=40;
							}
							$query5 = "UPDATE `orders` SET `total_amt`= {$total} WHERE `o_id` = {$o_id}";
							$query_result5 = query($query5);
							redirect("thank-you.php");
						}
					?>
								<?php
						if (isset($_POST['pickup'])) {
							$c_id = $_SESSION['c_id'];
							$query = "SELECT c_name, c_phone from `customer` where c_id = '{$c_id}'";
							$query_result = query($query);
							$row = fetch_array($query_result);
							$name = $row['c_name'];
							$phone = $row['c_phone'];
							$query = "INSERT INTO `address`(`c_id`, `name`, `phone`, `line_1`, `line_2`, `city`, `zip_code`, `landmark`, `delivery_type`) VALUES ({$c_id}, '{$name}', '{$phone}', 'Shop No. 10', null, 'Mumbai', '500050', null, 2)";
							$query_result = query($query);
							
							// print_r($_SESSION['product']);
							$product = $_SESSION['product'];

							$query3 = "SELECT a_id from `address` ORDER BY a_id DESC LIMIT 1";
							$query_result3 = query($query3);
							$row3 = fetch_array($query_result3);
							$a_id = $row3['a_id'];

							$query4 = "INSERT INTO `orders`(`c_id`, `a_id`, `o_datetime`, `o_type`, `o_status`) VALUES ({$c_id}, {$a_id}, now(), 'Pickup', 'Confirmed Order')";
							$query_result4 = query($query4);

							$query5 = "SELECT o_id from `orders` ORDER BY o_id DESC LIMIT 1";
							$query_result5 = query($query5);
							$row5 = fetch_array($query_result5);
							$o_id = $row5['o_id'];


							$item = (count($product)-7)/5;
					       	$total=0;
					       	for($i=1; $i<=$item; $i++){
								$prod_id = $product['shipping_'.$i];

								$query9 = "SELECT p_quantity FROM product where p_id = {$prod_id}";
								$result9 = query($query9);
								$product_quantity = fetch_array($result9);
								if ($product['quantity_'.$i] > $product_quantity['p_quantity']) {
									$product['quantity_'.$i] = $product_quantity['p_quantity'];
								}


								$quantity = $product['quantity_'.$i];
								$query5 = "INSERT INTO `order_item`(`o_id`, `p_id`, `quantity`) VALUES ({$o_id}, {$prod_id}, {$quantity})";
								$query_result5 = query($query5);

								$total = $total + $quantity*$product['amount_'.$i];

								$query10 = "UPDATE `product` SET `p_quantity`= p_quantity - {$quantity} WHERE `p_id` = {$prod_id}";
								$query_result10 = query($query10);
							}
							if($total<500){
								$total+=40;
							}

							$query5 = "UPDATE `orders` SET `total_amt`= {$total} WHERE `o_id` = {$o_id}";
							$query_result5 = query($query5);
							redirect("thank-you.php");
						}
					?>
				</div>
					<?php
						if (isset($_SESSION['c_id'])) {
					?>
				<div class="col-md-8 address_form_agile">
					  <h4>Add a new Details</h4>
				<form action="" method="post" class="creditly-card-form agileinfo_form">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
												<div class="controls">
													<label class="control-label">Full name: </label>
													<input class="billing-address-name form-control" type="text" name="name" placeholder="Full name" required="">
												</div>
												<div class="w3_agileits_card_number_grids">
													<div class="w3_agileits_card_number_grid_left">
														<div class="controls">
															<label class="control-label">Mobile number:</label>
														    <input class="form-control" type="text" name="phone" placeholder="Mobile number" required="">
														</div>
													</div>
													<div class="w3_agileits_card_number_grid_right">
														<div class="controls">
															<label class="control-label">Line 1</label>
														 <input class="form-control" type="text" name="line1" placeholder="Line 1" required="">
														</div>
													</div>
													<div class="clear"> </div>
												</div>
												<div class="controls">
													<label class="control-label">Line 2</label>
												 <input class="form-control" type="text" name="line2" placeholder="Line 2" required="">
												</div>
												<div class="controls">
													<label class="control-label">City</label>
												 <input class="form-control" type="text" name="city" placeholder="City" required="">
												</div>
												<div class="controls">
													<label class="control-label">Zipcode</label>
												 <input class="form-control" type="text" name="zipcode" placeholder="Zipcode" required="">
												</div>
												<div class="controls">
													<label class="control-label">Landmark</label>
												 <input class="form-control" type="text" name="landmark" placeholder="Landmark (Optional)">
												</div>
											</div>
											<button class="submit check_out" name="deliver" type="submit">Deliver to this Address</button>
										</div>
									</section>
								</form>
								</div>
								<?php
									}
									else{
								?>
								<div class="col-md-8 address_form_agile">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<button class="submit check_out" name="login-from-checkout" onclick="window.location.href='login.php';" type="submit">Login/Signup for checkout</button>
								<br>
							</div>
						</section>
						</div>
								<?php
									}
								?>
					<?php
						if (isset($_POST['deliver'])) {
							$name = escape_string($_POST['name']);
							$phone = escape_string($_POST['phone']);
							$line1 = escape_string($_POST['line1']);
							$line2 = escape_string($_POST['line2']);
							$city = escape_string($_POST['city']);
							$zipcode = escape_string($_POST['zipcode']);
							$landmark = escape_string($_POST['landmark']);
							if (empty($line2)) {
								$line2 = null;
							}if (empty($landmark)) {
								$landmark = null;
							}
							$c_id = $_SESSION['c_id'];
							$query = "INSERT INTO `address`(`c_id`, `name`, `phone`, `line_1`, `line_2`, `city`, `zip_code`, `landmark`, `delivery_type`) VALUES ('{$c_id}', '{$name}', '{$phone}', '{$line1}', '{$line2}', '{$city}', '{$zipcode}', '{$landmark}', 1)";
							$query_result = query($query);

							$product = $_SESSION['product'];

							$query3 = "SELECT a_id from `address` ORDER BY a_id DESC LIMIT 1";
							$query_result3 = query($query3);
							$row3 = fetch_array($query_result3);
							$a_id = $row3['a_id'];

							$query4 = "INSERT INTO `orders`(`c_id`, `a_id`, `o_datetime`, `o_type`, `o_status`) VALUES ({$c_id}, {$a_id}, now(), 'Deliver', 'Confirmed Order')";
							$query_result4 = query($query4);

							$query5 = "SELECT o_id from `orders` ORDER BY o_id DESC LIMIT 1";
							$query_result5 = query($query5);
							$row5 = fetch_array($query_result5);
							$o_id = $row5['o_id'];


							$item = (count($product)-7)/5;
					       	$total=0;
					       	for($i=1; $i<=$item; $i++){
								$prod_id = $product['shipping_'.$i];

								$query9 = "SELECT p_quantity FROM product where p_id = {$prod_id}";
								$result9 = query($query9);
								$product_quantity = fetch_array($result9);
								if ($product['quantity_'.$i] > $product_quantity['p_quantity']) {
									$product['quantity_'.$i] = $product_quantity['p_quantity'];
								}


								$quantity = $product['quantity_'.$i];

								$query5 = "INSERT INTO `order_item`(`o_id`, `p_id`, `quantity`) VALUES ({$o_id}, {$prod_id}, {$quantity})";
								$query_result5 = query($query5);

								$total = $total + $quantity*$product['amount_'.$i];

								$query10 = "UPDATE `product` SET `p_quantity`= p_quantity - {$quantity} WHERE `p_id` = {$prod_id}";
								$query_result10 = query($query10);
							}
							if($total<500){
								$total+=40;
							}

							$query5 = "UPDATE `orders` SET `total_amt`= {$total} WHERE `o_id` = {$o_id}";
							$query_result5 = query($query5);
							redirect("thank-you.php");
						}

					?>
				<div class="clearfix"> </div>
			</div>
		</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="footer">
	<p>Copyright © 2019 Grocery Store. All rights reserved</p>
</div>
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
							 <!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
							<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.rem1').fadeOut('slow', function(c){
										$('.rem1').remove();
									});
									});	  
								});
						   </script>
							<script>$(document).ready(function(c) {
								$('.close2').on('click', function(c){
									$('.rem2').fadeOut('slow', function(c){
										$('.rem2').remove();
									});
									});	  
								});
						   </script>
						  	<script>$(document).ready(function(c) {
								$('.close3').on('click', function(c){
									$('.rem3').fadeOut('slow', function(c){
										$('.rem3').remove();
									});
									});	  
								});
						   </script>

<!-- //js -->
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.js"></script>
<script>
		paypal.minicart.render();

		paypal.minicart.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}
		});

	</script>
</body>
</html>