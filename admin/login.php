<?php
require_once("functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon-->
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
     if(isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);
        $enc_pass = md5($password);
        "SELECT * from admin_login WHERE username = '{$username}' AND password = '{$enc_pass}'";
        $query = query("SELECT * from admin_login WHERE username = '{$username}' AND password = '{$enc_pass}' ");
        confirm($query);
        if(mysqli_num_rows($query) == 0) {
            echo "<h2>Your Password or Username are wrong.</h2>";
        } else {
            echo $_SESSION['username'] = $username;
            redirect("index.php");
        }
    }
?>    

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Admin Login</h1>
            <h2 class="text-center bg-warning"></h2>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post">
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  


    </header>


        </div>

    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
