<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "grocery";
	$conn = mysqli_connect($host, $user, $password,$dbname);
	if (!$conn) {
	 	die("Connection failed due to some technical issue. Please Contact the admin.");
	}
?>