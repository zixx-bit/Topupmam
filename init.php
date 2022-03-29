<?php
$db=mysqli_connect('localhost', 'root', '', 'topupmama');
if (mysqli_connect_errno()) {
  echo 'Database connection failed with error: '. mysqli_connect_error();
  die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/TopUpmama/config.php';
require_once BASEURL.'helpers/helpers.php';




if (isset($_SESSION['SBUser'])) {
    $user_id = $_SESSION['SBUser'];
    $query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $full_name = explode(' ', $user_data['full_name']);
    $user_data['first'] = $full_name[0];
    $user_data['last']  = $full_name[1];
}

if (isset($_SESSION['success_flash'])) {
    echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
    unset($_SESSION['success_flash']);
}
if (isset($_SESSION['error_flash'])) {
    echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}
// session_destroy();
