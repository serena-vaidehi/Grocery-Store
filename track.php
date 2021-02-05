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
	<link href="css/shipment-style.css" rel="stylesheet" type="text/css" media="all" />
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
				<li>Checkout</li>
			</ul>
		</div>
	</div>
	<div class="content">
<?php
	if (isset($_GET['order_id'])) {
		$o_id = escape_string($_GET['order_id']);
		$query = "SELECT * FROM orders, address where  orders.`c_id` = {$_SESSION['c_id']} and orders.`a_id` = address.`a_id` and o_id = {$o_id}";
		$query_result = query($query);
		$row = fetch_array($query_result);

		$address = $row['line_1'].", ".$row['line_2'].", ".$row['city'].", ".$row['zip_code'].", ".$row['landmark'];

		$query2 = "SELECT * from order_item where o_id = {$row['o_id']}";
		$query_result2 = query($query2);
			
		$query3 = "SELECT sum(quantity) as total_item from order_item where o_id = {$row['o_id']}";
		$query_result3 = query($query3);
		$row5 = fetch_array($query_result3);
		$track_order =<<<DELIMETER
			<div class="content1">
				<h2>Order Tracking: ORD00{$o_id}</h2>
			</div>
			<div class="content2">
				<div class="content2-header1">
					<p>Order Date & Time : <span>{$row['o_datetime']}</span></p>
				</div>
				<div class="content2-header1">
					<p>Status : <span>{$row['o_status']}</span></p>
				</div>
DELIMETER;
				if (!is_null($row['deliver_datetime'])) {
					$track_order .= '<div class="content2-header1">';
						$track_order .= "<p>Delivered Date & Time : <span>{$row['deliver_datetime']}</span></p>";
					$track_order .= '</div>';
				}
		$track_order .=<<<DELIMETER
				<div class="clear"></div>
			</div>
DELIMETER;
// Confirmed Order, Processing Order, Packed, Dispatched Item, Product Delivered
// Packed, Picked up
			if ($row['o_status'] === "Confirmed Order") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="dispatch">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line"></span>
								<p>Packed</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle">
				                	<img src="shipment-images/dispatch.png">
				            	</div>
								<span class="line"></span>
								<p>Dispatched Item</p>
							</div>
							<div class="delivery">
								<div class="imgcircle">
				                	<img src="shipment-images/delivery.png">
								</div>
								<p>Product Delivered</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;
			} elseif ($row['o_status'] === "Processing Order") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="process">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line"></span>
								<p>Packed</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle">
				                	<img src="shipment-images/dispatch.png">
				            	</div>
								<span class="line"></span>
								<p>Dispatched Item</p>
							</div>
							<div class="delivery">
								<div class="imgcircle">
				                	<img src="shipment-images/delivery.png">
								</div>
								<p>Product Delivered</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;
			} elseif ($row['o_status'] === "Packed") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="process">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="quality">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line"></span>
								<p>Packed</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle">
				                	<img src="shipment-images/dispatch.png">
				            	</div>
								<span class="line"></span>
								<p>Dispatched Item</p>
							</div>
							<div class="delivery">
								<div class="imgcircle">
				                	<img src="shipment-images/delivery.png">
								</div>
								<p>Product Delivered</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;		
			} elseif ($row['o_status'] === "Dispatched Item") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="process">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="quality">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line" style="background-color:#98D091;"></span>
								<p>Packed</p>
							</div>
							<div class="quality">
								<div class="imgcircle">
				                	<img src="shipment-images/dispatch.png">
				            	</div>
								<span class="line" style="background-color:#98D091;"></span>
								<p>Dispatched Item</p>
							</div>
							<div class="delivery">
								<div class="imgcircle">
				                	<img src="shipment-images/delivery.png">
								</div>
								<p>Product Delivered</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;		
			} elseif ($row['o_status'] === "Product Delivered") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="process">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="quality">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line" style="background-color:#98D091;"></span>
								<p>Packed</p>
							</div>
							<div class="process">
								<div class="imgcircle">
				                	<img src="shipment-images/dispatch.png">
				            	</div>
								<span class="line"></span>
								<p>Dispatched Item</p>
							</div>
							<div class="delivery">
								<div class="imgcircle" style="background-color:#98D091;">
				                	<img src="shipment-images/delivery.png">
								</div>
								<p>Product Delivered</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;
			} elseif ($row['o_status'] === "Picked Up") {
				$track_order .=<<<DELIMETER
					<div class="content3">
				        <div class="shipment">
							<div class="confirm">
				                <div class="imgcircle">
				                    <img src="shipment-images/confirm.png">
				            	</div>
								<span class="line"></span>
								<p>Confirmed Order</p>
							</div>
							<div class="process">
				           	 	<div class="imgcircle">
				                	<img src="shipment-images/process.png">
				            	</div>
								<span class="line"></span>
								<p>Processing Order</p>
							</div>
							<div class="quality">
								<div class="imgcircle">
				                	<img src="shipment-images/quality.png">
				            	</div>
								<span class="line" style="background-color:#98D091;"></span>
								<p>Packed</p>
							</div>
							<div class="dispatch">
								<div class="imgcircle" style="background-color:#98D091;">
				                	<img src="shipment-images/delivery.png">
				            	</div>
								<p>Picked Up</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
DELIMETER;
			}
echo $track_order;
	}
?>
</div>
<br>
	<h3 class="text-center" style="margin-bottom: 20px; margin-top: 10px;">Order Details</h3>
	<?php
		while($row2 = fetch_array($query_result2)){
			$query3 = "SELECT * from product where p_id = {$row2['p_id']}";
			$query_result3 = query($query3);
			$row3 = fetch_array($query_result3);
			$ordered_prod =<<<DELIMETER
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-2"><img src="images/product/{$row3['p_image']}"></div>
					<div class="col-md-2">
						<div class="row">{$row3['p_name']}</div>
						<div class="row">Price - ₹{$row3['p_price']}</div>
						<div class="row">Quantity - {$row2['quantity']}</div>
					</div>
				</div>
				<hr>
DELIMETER;
			echo $ordered_prod;
		}
	?>

<br><br>
<div class="footer">
	<p>Copyright © 2019 Grocery Store. All rights reserved</p>
</div>
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