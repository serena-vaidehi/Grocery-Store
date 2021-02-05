<?php
  require_once("functions.php");
  session_start();
  if (isset($_GET['id'])) {
    $query = query("DELETE FROM product_cat WHERE pc_id = ". escape_string($_GET['id'])." ");
    confirm($query);
    set_message("Category Deleted");
    redirect("index.php?categories");
  } else {
    redirect("index.php?categories");
  }
?>