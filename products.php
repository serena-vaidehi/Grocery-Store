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
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
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
				<?php
					if (isset($_GET['cat_id'])) {
					$cat_id1 = escape_string($_GET['cat_id']);
					$query1 = "SELECT * FROM product_cat where pc_id = {$cat_id1}";
					$result1 = query($query1);
					$row1 = fetch_array($result1);
					echo "<li>{$row1['pc_name']}</li>";
					}
				?>
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
			<div class="w3l_banner_nav_right_banner3">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
			<div class="w3ls_w3l_banner_nav_right_grid">
				<h3>Popular Brands</h3>
				<div class="w3ls_w3l_banner_nav_right_grid1">
			<?php
				if (isset($_GET['cat_id'])) {
					$cat_id = escape_string($_GET['cat_id']);
					$query = "SELECT * FROM product, product_cat where `product`.`p_cat` = `product_cat`.`pc_id` and p_cat = {$cat_id} order by RAND() LIMIT 30";
					$result = query($query);
					while($row = fetch_array($result)) {
						if ($row['p_quantity'] > 0) {
							
						$prod =<<<DELIMETER
							<div class="col-md-3 w3ls_w3l_banner_left">
								<div class="hover14 column">
								<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
									<div class="agile_top_brand_left_grid1">
										<figure>
											<div class="snipcart-item block">
												<div class="snipcart-thumb">
													<a href="single.php?id={$row['p_id']}"><img src="images/product/{$row['p_image']}" alt="{$row['p_name']}" class="img-responsive" /></a>
													<p>{$row['p_name']}</p>
													<h4>₹{$row['p_price']}</h4>
												</div>
												<div class="snipcart-details">
													<form action="#" method="post">
														<fieldset>
															<input type="hidden" name="cmd" value="_cart" />
															<input type="hidden" name="add" value="1" />
															<input type="hidden" name="business" value=" " />
															<input type="hidden" name="item_name" value="{$row['p_name']}" />
															<input type="hidden" name="shipping" value="{$row['p_id']}" />
															<input type="hidden" name="amount" value="{$row['p_price']}" />
															<input type="hidden" name="discount_amount" value="" />
															<input type="hidden" name="currency_code" value="INR" />
															<input type="hidden" name="return" value=" " />
															<input type="hidden" name="cancel_return" value=" " />
															<input type="submit" name="submit" value="Add to cart" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</figure>
									</div>
								</div>
								</div>
							</div>
DELIMETER;
						} else{
							$prod =<<<DELIMETER
							<div class="col-md-3 w3ls_w3l_banner_left">
								<div class="hover14 column">
								<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
									<div class="agile_top_brand_left_grid1">
										<figure>
											<div class="snipcart-item block">
												<div class="snipcart-thumb">
													<a href="single.php?id={$row['p_id']}"><img src="images/product/{$row['p_image']}" alt="{$row['p_name']}" class="img-responsive" /></a>
													<p>{$row['p_name']}</p>
													<h4>₹{$row['p_price']}</h4>
												</div>
												<div class="snipcart-details">
														<fieldset>
															<input type="hidden" name="cmd" value="_cart" />
															<input type="hidden" name="add" value="1" />
															<input type="hidden" name="business" value=" " />
															<input type="hidden" name="item_name" value="{$row['p_name']}" />
															<input type="hidden" name="shipping" value="{$row['p_id']}" />
															<input type="hidden" name="amount" value="{$row['p_price']}" />
															<input type="hidden" name="discount_amount" value="" />
															<input type="hidden" name="currency_code" value="INR" />
															<input type="hidden" name="return" value=" " />
															<input type="hidden" name="cancel_return" value=" " />
															<input type="submit" name="submit" value="Out of stock" class="btn btn-info" style="cursor: default" />
														</fieldset>
												</div>
											</div>
										</figure>
									</div>
								</div>
								</div>
							</div>
DELIMETER;
						}
						echo $prod;
					}
				}
			?>
			<?php
				if (isset($_POST['SearchProduct'])) {
					$search_prod = strtolower(escape_string($_POST['SearchProduct']));
				    $query = "SELECT * FROM product WHERE LOWER(`p_name`) LIKE '%{$search_prod}%'";
					$result = query($query);
				    confirm($result);
					while($row = fetch_array($result)) {
						$prod =<<<DELIMETER
							<div class="col-md-3 w3ls_w3l_banner_left">
								<div class="hover14 column">
								<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
									<div class="agile_top_brand_left_grid1">
										<figure>
											<div class="snipcart-item block">
												<div class="snipcart-thumb">
													<a href="single.php?id={$row['p_id']}"><img src="images/product/{$row['p_image']}" alt="{$row['p_name']}" class="img-responsive" /></a>
													<p>{$row['p_name']}</p>
													<h4>₹{$row['p_price']}</h4>
												</div>
												<div class="snipcart-details">
													<form action="#" method="post">
														<fieldset>
															<input type="hidden" name="cmd" value="_cart" />
															<input type="hidden" name="add" value="1" />
															<input type="hidden" name="business" value=" " />
															<input type="hidden" name="item_name" value="knorr instant soup" />
															<input type="hidden" name="amount" value="100" />
															<input type="hidden" name="discount_amount" value="" />
															<input type="hidden" name="currency_code" value="INR" />
															<input type="hidden" name="return" value=" " />
															<input type="hidden" name="cancel_return" value=" " />
															<input type="submit" name="submit" value="Add to cart" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</figure>
									</div>
								</div>
								</div>
							</div>
DELIMETER;
						echo $prod;
					}
				}
			?>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- footer -->
	<div class="footer">
	<p>Copyright © 2019 Grocery Store. All rights reserved</p>
</div>
<!-- //footer -->
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
			// if (total < 3) {
			// 	alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
			// 	evt.preventDefault();
			// }
		});

	</script>
</body>
</html>