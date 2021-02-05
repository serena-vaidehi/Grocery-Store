<?php
require_once("functions.php");
session_start();
?>
<?php 
    if (!isset($_SESSION['username'])) {
        redirect("login.php"); 
    }
?>
<?php include("header.php"); ?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <?php

                    if ($_SERVER['REQUEST_URI'] == "/grocery/admin/" || $_SERVER['REQUEST_URI'] == "/grocery/admin/index.php") {
                        include("admin_content.php");
                    }

                    if (isset($_GET['orders'])) {
                        include("orders.php");
                    }
                    if (isset($_GET['add_product'])) {
                        include("add_product.php");
                    }
                    if (isset($_GET['categories'])) {
                        include("categories.php");
                    }
                    if (isset($_GET['edit_product'])) {
                        include("edit_product.php");
                    }
                    if (isset($_GET['products'])) {
                        include("products.php");
                    }
                    if (isset($_GET['users'])) {
                        include("users.php");
                    }
                    if (isset($_GET['order_detail'])) {
                        include("order_detail.php");
                    }
                ?>
         
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include("footer.php"); ?>