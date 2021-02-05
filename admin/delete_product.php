<?php
  require_once("functions.php");
  session_start();
  if (isset($_GET['id'])) {
    $query = query("DELETE FROM product WHERE p_id = ". escape_string($_GET['id'])." ");
    confirm($query);
    set_message("Product Deleted");
    redirect("index.php?products");
  } else {
    redirect("index.php?products");
  }
?>