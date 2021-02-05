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
				<!-- <h1><a href="index.html"><span>Grocery</span> Store</a></h1> -->
			</div>
			<!-- <div class="w3ls_logo_products_left1">
				<ul class="special_items">
					<li><a href="events.html">Events</a><i>/</i></li>
					<li><a href="about.html">About Us</a><i>/</i></li>
					<li><a href="products.html">Best Deals</a><i>/</i></li>
					<li><a href="services.html">Services</a></li>
				</ul>
			</div> -->
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+91) 9999999999 </li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Sign In & Sign Up</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
<script>
function validateForm() {
  var fname = document.forms["form"]["f_name"].value;
  var lname = document.forms["form"]["l_name"].value;
  var password = document.forms["form"]["password"].value;
  var phone = document.forms["form"]["phone"].value;

  var re = /^[A-Za-z]+$/;
  if (!re.test(fname) || fname == "") {
    alert("First Name should contain characters only");
    return false;
  }
  if (!re.test(lname) || lname == "") {
    alert("Last Name should contain characters only");
    return false;
  }

  var pass_re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
  if (!password.match(pass_re)) {
    alert("Password should be 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter");
    return false;
  }

  var IndNum = /^\d{10}$/;
  if(!IndNum.test(phone) || phone.startsWith("1") || phone.startsWith("2") || phone.startsWith("3") || phone.startsWith("4") || phone.startsWith("5") || phone.startsWith("6") || phone.startsWith("0") ) {
  	alert("Your Mobile Number Is Invalid.");
  	return false;
  }
}
</script>
		<div class="">
<!-- login -->
		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">Register</div>
				  </div>
				  <div class="form">
					<div id="un_reg"></div>
					<h2>Login to your account</h2>
					<form action="" method="post">
					  <input type="text" name="email" placeholder="Email" required=" ">
					  <input type="password" name="password" placeholder="Password" required=" ">
					  <input type="submit" value="Login" name="login">
					</form>
				  </div>
				  <div class="form">
					<h2>Create an account</h2>
					<form action="" method="post" onsubmit="return validateForm()" name="form">
					  <input type="text" name="f_name" placeholder="First Name" required=" ">
					  <input type="text" name="l_name" placeholder="Last Name" required=" ">
					  <input type="password" name="password" placeholder="Password (8 character long)" required="" style="margin-bottom: 0px;" aria-describedby="passwordHelpBlock">
					  <small id="passwordHelpBlock" class="form-text text-muted">Password should be 6 to 20 characters contain at least one numeric digit, one uppercase and one lowercase letter</small>
					  <input type="email" name="email" placeholder="Email Address" required=" " style="margin-top: 20px;">
					  <input type="text" name="phone" placeholder="Phone Number" required=" ">
					  <input type="submit" value="Register" name="register">
					</form>
				  </div>
				  <div class="cta"><a href="#">Forgot your password?</a></div>
				</div>
			</div>
			<?php
				if (isset($_POST['register'])) {
					$f_name = escape_string($_POST['f_name']);
					$l_name = escape_string($_POST['l_name']);
					$password = escape_string($_POST['password']);
					$email = escape_string($_POST['email']);
					$phone = escape_string($_POST['phone']);
					$name = $f_name . " " . $l_name;
					$enc_password = md5($password);

//check user exist
					$query = "SELECT c_name, c_email, c_id from `customer` where c_email = '{$email}'";
					$query_result = query($query);
					$query_value = fetch_array($query_result);
					if(mysqli_num_rows($query_result) == 1){
						$_SESSION['c_id'] = $query_value['c_id'];
						$_SESSION['c_name'] = $query_value['c_name'];
						// echo $_SESSION['c_id'];
						echo "<script>window.location.href='index.php';</script>";
						die();
					}

					$query = "INSERT INTO `customer`(`c_name`, `c_phone`, `c_email`, `password`) VALUES ('{$name}', '{$phone}', '{$email}', '{$enc_password}')";
					$query_result = query($query);

					$query1 = "SELECT c_name, c_email, c_id from `customer` where c_email = '{$email}'";
					$query_result1 = query($query1);
					$query_value1 = fetch_array($query_result1);
					$_SESSION['c_id'] = $query_value1['c_id'];
					$_SESSION['c_name'] = $query_value['c_name'];
					// echo $_SESSION['c_id'];
					echo "<script>window.location.href='index.php';</script>";
				}
				
				if (isset($_POST['login'])) {
					$email = escape_string($_POST['email']);
					$password = escape_string($_POST['password']);
					$enc_password = md5($password);
//check user exist
					$query = "SELECT c_name, c_email, c_id from `customer` where c_email = '{$email}'";
					$query_result = query($query);
					$query_value = fetch_array($query_result);
					if(mysqli_num_rows($query_result) == 1){
						$_SESSION['c_id'] = $query_value['c_id'];
						$_SESSION['c_name'] = $query_value['c_name'];
						// echo $_SESSION['c_id'];
						echo "<script>window.location.href='index.php';</script>";
						die();
					} elseif (mysqli_num_rows($query_result) == 0) {?>
						<script type="text/javascript">
							document.getElementById('un_reg').innerHTML = "You are not a registered user. Register first.";
						</script>
						<?php
					}
				}
			?>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
<!-- //login -->
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
		});

	</script>
</body>
</html>