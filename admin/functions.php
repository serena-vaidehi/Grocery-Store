 <?php
require_once "../dbcon.php";
//helper functions
function last_id() {
    global $conn;
    return mysqli_insert_id($conn);
}

function set_message($msg) {
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message() {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


function redirect($location){
	// header("location: $location");
    echo "<script>window.location.href='{$location}';</script>";
} 

function query($sql) {
	global $conn;
	return mysqli_query($conn, $sql);
}

function confirm($result){
	global $conn;
	if (!$result) {
		die("QUERY FAILED". mysqli_error($conn));
	}
}

function escape_string($string) {
	global $conn;
	return mysqli_real_escape_string($conn, $string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}

// ****************************************** Order Update ********************************
if (isset($_POST["order_id"]) && isset($_POST["order_status"])) {
    $order_id = escape_string($_POST["order_id"]);
    $order_status = escape_string($_POST["order_status"]);

    $query = "SELECT o_type FROM orders where o_id = {$order_id}";
    $result = query($query);
    $row = fetch_array($result);
    $order_type = $row['o_type'];
    // Confirmed Order, Processing Order, Packed, Dispatched Item, Product Delivered
    if ($order_type === "Deliver" && $order_status === "Product Delivered") {
        $query1 = "UPDATE orders set o_status = '{$order_status}', deliver_datetime = now() where o_id = {$order_id}";
        $result1 = query($query1);
    } elseif ($order_type === "Pickup" && $order_status === "Picked up") {
        $query1 = "UPDATE orders set o_status = '{$order_status}', deliver_datetime = now() where o_id = {$order_id}";
        $result1 = query($query1);
    } else {
        $query1 = "UPDATE orders set o_status = '{$order_status}' where o_id = {$order_id}";
        $result1 = query($query1);
    }

}

// ****************************************BACK END FUNCTION*********************************

function display_orders() {
    $query = query("SELECT * FROM orders, address where orders.`a_id` = address.`a_id`");
    confirm($query);
    while ($row = fetch_array($query)) {
        $orders = <<<DELIMETER
            <tr>
                <td>{$row['o_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['line_1']}, {$row['line_2']}, {$row['city']}, {$row['zip_code']}, {$row['landmark']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['o_type']}</td>
                <td>&#8377;{$row['total_amt']}</td>
                <td><a class="btn btn-success" href="index.php?order_detail&order_id={$row['o_id']}"><span class="glyphicon glyphicon-th-list"></span></td>
                <td>{$row['o_status']}</td>
                <td>
DELIMETER;
if ($row['o_type'] === "Deliver") {
        $orders .= <<<DELIMETER
                    <select name="order" id="{$row['o_id']}" onchange="update_sta(this.value, this.id)">
                        <option value="">Update Status</option>
                        <option value="Confirmed Order">Confirmed Order</option>
                        <option value="Processing Order">Processing Order</option>
                        <option value="Packed">Packed</option>
                        <option value="Dispatched Item">Dispatched Item</option>
                        <option value="Product Delivered">Product Delivered</option>
                    </select>
                </td>
            </tr>
DELIMETER;
        } elseif ($row['o_type'] === "Pickup") {
$orders .= <<<DELIMETER
                    <select name="order" id="{$row['o_id']}" onchange="update_sta(this.value, this.id)">
                        <option value="">Update Status</option>
                        <option value="Confirmed Order">Confirmed Order</option>
                        <option value="Processing Order">Processing Order</option>
                        <option value="Packed">Packed</option>
                        <option value="Picked Up">Picked Up</option>
                    </select>
                </td>
            </tr>
DELIMETER;
        }
            echo $orders;
    }
}

function show_categories_add_product_page() {
    $query = query("SELECT * FROM `product_cat`");
    confirm($query);
    while($row = fetch_array($query)) {
        
        $category_options = <<<DELIMETER
            <option value="{$row['pc_id']}">{$row['pc_name']}</option>
DELIMETER;

echo $category_options;

    }
}

if (isset($_POST['filter_value'])) {
  $filter_value = escape_string($_POST["filter_value"]);
  if($filter_value == "All") {
    $query2 = "SELECT * FROM `product`";
    $query_output2 = query($query2);
    confirm($query_output2);
  }
  else {
    $query2 = "SELECT * FROM `product` where p_cat = '{$filter_value}'";
    $query_output2 = query($query2);
    confirm($query_output2);
  }
  $i=1;
  if (mysqli_num_rows($query_output2)>0) {
        while($row2 = fetch_array($query_output2)) {
            $category = show_product_category_title($row2['p_cat']);
        $product_image = "../images/product/".$row2['p_image'];
          $prod=<<<DELIMETER
          <tr>
                <td>{$i}</td>
                <td>{$row2['p_name']}<br>
                  <a href="index.php?edit_product&id={$row2['p_id']}"><img width="100" src="{$product_image}" alt=""></a>
                </td>
                <td>{$category}</td>
                <td>{$row2['p_price']}</td>
                <td>{$row2['p_quantity']}</td>
                <td><a class="btn btn-danger" href="delete_product.php?id={$row2['p_id']}"><span class="glyphicon glyphicon-remove"></span></td>
            </tr>
DELIMETER;
          echo $prod;
          $i++;
        }
  }
  elseif(mysqli_num_rows($query_output2)==0) {
    echo "<h3>No Data Found</h3>";
  }          
}

function show_product_category_title($product_category_id) {
    $category_query = query("SELECT * FROM product_cat WHERE pc_id = '{$product_category_id}'");
    confirm($category_query);
    while ($category_row = fetch_array($category_query)) {
        return $category_row['pc_name'];
    }

}


function update_product() {
    if (isset($_POST['update'])) {
        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_image          = escape_string($_FILES['file']['name']);
        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);

        if (empty($product_image)) {
            $get_pic = query("SELECT p_image FROM product where p_id =" .escape_string($_GET['id'])."");
            confirm($get_pic);
            while ($pic = fetch_array($get_pic)) {
                $product_image = $pic['p_image'];
            }
        }

        move_uploaded_file($image_temp_location, "../images/product/".$product_image);
        
        $query = "UPDATE product SET ";
        $query .= "p_name        =   '{$product_title}', ";
        $query .= "p_cat  =   '{$product_category_id}', ";
        $query .= "p_price        =   '{$product_price}', ";
        $query .= "p_description  =   '{$product_description}', ";
        $query .= "p_quantity     =   '{$product_quantity}', ";
        $query .= "p_image        =   '{$product_image}' "; 
        $query .= "where `p_id`   = " .escape_string($_GET['id']);


        $send_update_query = query($query); 
        confirm($send_update_query);
        set_message("Product has been Updated");
        redirect("index.php?products");

    }
}

function add_product() {
    if (isset($_POST['publish'])) {
        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_image          = escape_string($_FILES['file']['name']);
        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
        $product_image_type     = escape_string($_FILES['file']['type']);
        $product_image_size     = escape_string($_FILES['file']['size']);
        $product_image_error    = escape_string($_FILES['file']['error']);
$target_dir = "../images/product/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if file already exists
        if (file_exists($target_file)) {
            $err = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            $err = "Sorry, file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo  "<h2 class='page-header'>{$err}. Your file was not uploaded.</h2>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) { 
                
            } else {
                echo "<h2 class='page-header'>Sorry, there was an error uploading your file.</h2>";
            }
        }        
        $query = query("INSERT INTO product(p_name, p_cat, p_price, p_description, p_quantity, p_image ) VALUES( '{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$product_quantity}', '{$product_image}')" );
        $last_id = last_id();
        confirm($query);
        set_message("New Product with id {$last_id} was Added");
        redirect("index.php?products");
    }
}

function show_categories_in_admin() {
    $query = query("SELECT * FROM product_cat");
    confirm($query);
    while ($row = fetch_array($query)) {
        $cat_id = $row['pc_id'];
        $cat_title = $row['pc_name'];
        $category = <<<DELIMETER
         <tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a class="btn btn-danger" href="delete_category.php?id={$cat_id}"><span class="glyphicon glyphicon-remove"></span>
            </td>
        </tr>
DELIMETER;
        echo $category;
    }
}

function add_category() {
    if (isset($_POST['add_category'])) {
        $cat_title = escape_string($_POST['cat_title']);

        if (empty($cat_title) || $cat_title == " " ) {
            set_message("THIS CANNOT BE EMPTY.");
        } else {
            $query = query("INSERT INTO product_cat(pc_name) VALUES ('{$cat_title}')");
            confirm($query);
            set_message("CATEGORY CREATED.");
        }
    }
}

function display_users() {
    $query = query("SELECT * FROM customer");
    confirm($query);
    $i=1;
    while ($row = fetch_array($query)) {
        // $user_id = $row['c_id'];
        $username = $row['c_name'];
        $phone = $row['c_phone'];
        $email = $row['c_email'];
        $user = <<<DELIMETER
         <tr>
                    <td>{$i}</td>
                    <td>{$username}</td>
                    <td>{$phone}</td>                
                    <td>{$email}</td>
                    </td>
                </tr>
DELIMETER;
        echo $user;
        $i++;
    }
}

function get_reports() {
    if (isset($_GET['order_id'])) {
        $o_id = escape_string($_GET['order_id']);
        $query = query("SELECT * FROM `order_item`, product, orders where order_item.`o_id` = orders.`o_id` and order_item.`p_id` = product.`p_id` and order_item.`o_id` = {$o_id}");
        confirm($query);
        $i=1;
        while($row = fetch_array($query)) {
    #heredoc
            $report = <<<DELIMETER
                <tr>

                    <td>{$i}</td>
                    <td>{$row['o_id']}</td>
                    <td>{$row['p_name']}</td>
                    <td>{$row['p_price']}</td>
                    <td>{$row['quantity']}</td>
                </tr>
DELIMETER;
        echo $report;
        $i++;
        }
    }
}

if(isset($_POST['cat_id_to_show_product_admin']))
{
    $cat_id =  escape_string($_POST['cat_id_to_show_product_admin']); //$_POST['get_option'];
    $query = query("SELECT * FROM `product` where p_cat = {$cat_id}");
    confirm($query);
    while($row=mysqli_fetch_array($query))
    {
        $category = show_product_category_title($row['p_cat']);
        $product_image = "../images/product/".$row['p_image'];
#heredoc
        $product = <<<DELIMETER
            <tr>
                <td>{$row['p_id']}</td>
                <td>{$row['p_name']}<br>
                  <a href="index.php?edit_product&id={$row['p_id']}"><img width="100" src="{$product_image}" alt=""></a>
                </td>
                <td>{$category}</td>
                <td>{$row['p_price']}</td>
                <td>{$row['p_quantity']}</td>
                <td><a class="btn btn-danger" href="delete_product.php?id={$row['p_id']}"><span class="glyphicon glyphicon-remove"></span></td>
            </tr>
DELIMETER;
    echo $product;
    }
    exit;
}









// get products

function get_products() {
	$query = query("SELECT * FROM `products` WHERE product_quantity >= 1");

	confirm($query);

	while($row = fetch_array($query)) {
         $product_image = display_image($row['product_image']);
#heredoc
		 $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
    <a href="item.php?id={$row['product_id']}"><img style=" width:260px; height: 120px;" src="../resources/{$product_image}" alt="">
        <div class="caption">
            <h4 class="pull-right">&#8377;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
         	<a class="btn btn-primary" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>
    </div>
</div>
DELIMETER;

echo $product;	 
	}
}



function get_categories() {
	$query = query("SELECT * FROM `categories`");
	confirm($query);
	while($row = fetch_array($query)) {
    	
    	$category_links = <<<DELIMETER
<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

echo $category_links;

    }
}


function get_products_in_cat_page() {
	$query = query("SELECT * FROM `products` WHERE product_category_id = ".escape_string($_GET['id'])." AND product_quantity >= 1");

	confirm($query);

	while($row = fetch_array($query)) {
        $product_image = display_image($row['product_image']);
#heredoc
		 $product = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
	        <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>
DELIMETER;

echo $product;	 
	}
}




function get_products_in_shop_page() {
	$query = query("SELECT * FROM `products` WHERE product_quantity >= 1");

	confirm($query);

	while($row = fetch_array($query)) {
         $product_image = display_image($row['product_image']);
#heredoc
		 $product = <<<DELIMETER
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;

echo $product;	 
	}
}

function login_user() {
    if(isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);
        $query = query("SELECT * from users WHERE username = '{$username}' AND password = '{$password}' ");
        confirm($query);
    
        if(mysqli_num_rows($query) == 0) {
            redirect("login.php");
            set_message("Your Password or Username are wrong.");
        } else {
            $_SESSION['username'] = $username;
            redirect("admin");
        }
    }

}


function send_message() {
    if (isset($_POST['submit'])) {
        $to        =   "raj.bhardwaj585@gmail.com";
        $from_name =   $_POST['name'];
        $subject   =   $_POST['subject'];
        $email     =   $_POST['email'];
        $message   =   $_POST['message'];

        $headers = "From: {$from_name} {$email}";

        $result = mail($to, $subject, $message, $headers);
        
        if (!$result) {
            set_message("Sorry we could not send your message.");
            redirect("contact.php");
        } else {
            set_message("Your Message has been sent.");
            redirect("contact.php");
        }
    }
}
// ****************************************BACK END FUNCTION*********************************



/*************** ADMIN PRODUCTS*****************/

function display_image($picture) {
    return "uploads" . DS . $picture;
}




/******************** Add Products in Admin***********************


/******************** Updating Products code *************/



/******************* Categories in admin **********************/



/********************* Admin Users *******************/



function add_user() {
    if (isset($_POST['add_user'])) {
        $username   = escape_string($_POST['username']);
        $email      = escape_string($_POST['email']);
        $password   = escape_string($_POST['password']);
        // $user_photo = escape_string($_FILES['file']['name']);
        // $photo_temp = escape_string($_FILES['file']['tmp_name']);
        
        move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);

        $query = query("INSERT INTO users(username, email, password, user_photo) VALUES ('{$username}', '{$email}', '{$password}', '{$user_photo}')");
        confirm($query);
        set_message("USER CREATED");
        redirect("index.php?users");
        }
}



/***************** SLIDES FUNCTION *****************/

function add_slides() {
    if (isset($_POST['add_slide'])) {
        $slide_title = escape_string($_POST['slide_title']);
        $slide_image = escape_string($_FILES['file']['name']);
        $slide_image_loc = escape_string($_FILES['file']['tmp_name']);
        if (empty($slide_title) || empty($slide_image) ) {
            echo "<p class='bg-danger'>This field cannot be empty</p>";
        } else {
            move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);
            $query = query("INSERT INTO slides(slide_title, slide_image) VALUE('{$slide_title}', '{$slide_image}')");
            confirm($query);
            set_message("Slide Added");
            redirect("index.php?slides");
        }

    }
}

function get_current_slide_in_admin() {
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active_admin = <<<DELIMETER
                <img class="img-responsive" src="../../resources/uploads/{$row['slide_image']}" alt="">
DELIMETER;
            echo $slide_active_admin;
    }
}

function get_active_slide() {
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active = <<<DELIMETER
            <div class="item active">
                <img class="slide-image" src="../resources/uploads/{$row['slide_image']}" alt="">
            </div>
DELIMETER;
            echo $slide_active;;
    }
}

function get_slides() {
    $query = query("SELECT * FROM slides");
    confirm($query);
    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slides = <<<DELIMETER
            <div class="item">
                <img class="slide-image" src="../resources/uploads/{$row['slide_image']}" alt="">
            </div>
DELIMETER;
            echo $slides;;
    }
}
function get_slides_thumbnails() {
    $query = query("SELECT * FROM slides ORDER BY slide_id ASC");
    confirm($query);
    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_thumb_admin = <<<DELIMETER

    <div class="col-xs-6 col-md-3">
        <a href="">
            <img width="200" class="img-responsive slide_image" src="../../resources/uploads/{$row['slide_image']}">
        </a>
    </div>
DELIMETER;
            echo $slide_thumb_admin;
    }
}

?>