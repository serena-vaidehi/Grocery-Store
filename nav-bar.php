	<div class="agileits_header">
		<div class="w3l_offers">
			<a href="mail.php">Contact Us</a>
		</div>
		<div class="w3l_search">
			<form action="products.php" method="post">
				<input type="text" id="search_text" name="SearchProduct" value="Search a product..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
				<input type="submit" value=" " name="submit_search">
			</form>
		</div>
		<div class="product_list_header">  
			<form action="#" method="post" class="last">
                <fieldset>
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <input type="submit" name="submit" value="View your cart" class="button" />
                </fieldset>
            </form>
		</div>
		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
								<?php
									if (!isset($_SESSION['c_id'])) {
										echo '<li><a href="login.php">Login</a></li>';
									}
									if (isset($_SESSION['c_id'])) {
										echo '<li><a href="logout.php">Logout</a></li>';
									}
								?>
							</ul>
						</div>                  
					</div>
				</li>
			</ul>
		</div>
		<div class="w3l_header_right1">
					<h2><a href="order-details.php">Order Details</a></h2>
		</div>
		<?php
			if (isset($_SESSION['c_id'])) {
				echo '<div class="w3l_header_right" style="color: white; padding-left: 2em; margin-top:-33px;">';
				echo "Welcome<br>{$_SESSION['c_name']}";
				echo "</div>";
			}
		?>
		<div class="clearfix"> </div>
	</div>