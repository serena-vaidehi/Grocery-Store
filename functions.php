<?php
require_once "dbcon.php";
//helper functions
date_default_timezone_set('Asia/Kolkata');
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
	    echo "<script>window.location.href='{$location}';</script>";
} 

function query($sql) {
	global $conn;
	return mysqli_query($conn, $sql);
}

function confirm($result){
	global $conn;
	if (!$result) {
		//die("QUERY FAILED". mysqli_error($conn));
	}
}

function escape_string($string) {
	global $conn;
	return mysqli_real_escape_string($conn, $string);
}

function fetch_array($result) {
	return mysqli_fetch_assoc($result);
}

function fetch_cat(){
	$query = "SELECT * FROM product_cat order by pc_name";
	$result = query($query);
	while($row = fetch_array($result)) {
		$cat =<<<DELIMETER
		<li><a href="products.php?cat_id={$row['pc_id']}">{$row['pc_name']}</a></li>
DELIMETER;
echo $cat;
	}
}

if(isset($_POST["search_prod"]))
{
    $search_prod = strtolower(escape_string($_POST["search_prod"]));
    $query = "SELECT p_id, p_name, p_image FROM product WHERE LOWER(`p_name`) LIKE '%{$search_prod}%'";
    $query_output = query($query);
    confirm($query_output);
    $result='';
    if(mysqli_num_rows($query_output)>0) {
      $result .= "<div style='text-align:center;background-color:white;'>";
    while($row = fetch_array($query_output)) {
      $result .="<a href='single.php?id={$row['p_id']}'><div style='color: black'>";
      $result .="{$row['p_name']}";
      $result .="</div></a><br>";
    }
    $result .="</div>";
    echo $result;
    }
    else{
      $result .= "<div style='text-align:center;background-color:white;'>";
      $result .="<div style='color: black; font-size: 150%;'>No data Found</div>";
      $result .="</div>";
      echo $result;
    }
}

?>