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
<!-- start-smoth-scrolling -->
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
<!-- header -->
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
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>
		<div class="w3l_banner_nav_right">
<!-- mail -->
		<div class="mail">
			<h3>Mail Us</h3>
			<div class="agileinfo_mail_grids">
				<div class="col-md-4 agileinfo_mail_grid_left">
					<ul>
						<li><i class="fa fa-home" aria-hidden="true"></i></li>
						<li>Address<span>Dheeraj Kirana Store,<br> Nagpur</span></li>
					</ul>
					<ul>
						<li><i class="fa fa-envelope" aria-hidden="true"></i></li>
						<li>email<span><a href="mailto:info@grocery.com">info@grocery.com</a></span></li>
					</ul>
					<ul>
						<li><i class="fa fa-phone" aria-hidden="true"></i></li>
						<li>call to us<span>(+91) 9999999999</span></li>
					</ul>
				</div>
				<div class="col-md-8 agileinfo_mail_grid_right">
					<form action="" method="post">
						<div class="col-md-6 wthree_contact_left_grid">
							<input type="text" name="Name" value="Name*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name*';}" required="">
							<input type="email" name="Email" value="Email*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email*';}" required="">
						</div>
						<div class="col-md-6 wthree_contact_left_grid">
							<input type="text" name="Telephone" value="Telephone*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone*';}" required="">
							<input type="text" name="Subject" value="Subject*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject*';}" required="">
						</div>
						<div class="clearfix"> </div>
						<textarea  name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
						<input type="submit" value="Submit">
						<input type="reset" value="Clear">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //mail -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
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
		});

	</script>
</body>
</html>