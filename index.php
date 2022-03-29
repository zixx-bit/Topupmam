
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/TopUpmama/core/init.php';
if (!is_logged_in()) {
  login_error_redirect();
}

include "../includes/head.php";
 ?>
 <?php include '../includes/navigation.php';
 ?>
<!--Top Navbar-->
