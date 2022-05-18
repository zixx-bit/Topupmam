 <?php
function display_errors($errors){
  $display ='<ul class="" style="z-index: 2;width:75%; margin-top:2%; border:1px solid #d13f48; border-radius:12px;">';
  // $display = '<ul class="popup1" style="z-index: 2;">';
  foreach ($errors as $error) {
    $display.='<li class="text-danger" style="z-index: 2;  ">'.$error. '</li>';
  }
  $display .= '</ul>' ;
  return $display;
}

function sanitize($dirty){
  return  htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function successMessage($messages){
  $display2 = '<ul class="" style="z-index: 2; width:75%; border:1px solid #83bd77; border-radius:12px;">';
  foreach ($messages as $message ) {
  $display2 .='<li class="text-success">'.$message. '</li>';
  }
  $display2 .='</ul>';
  return $display2;
}

function money($number){
  return 'Ksh '.number_format($number,2);
}

function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_flash'] = 'You are now logged in!';
  header('Location:index.php');
}

function is_logged_in(){
  if (isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
     return true;
  }
  return false;
}

function login_error_redirect($url = 'login.php'){

  $_SESSION  ['error_flash'] = 'You must be logged in to access this page';
  header('Location: '.$url);
}

//this is the permission function to block anyone from accessing the admin page if they dont have the logins
function permission_error_redirect($url = 'login.php'){
  $_SESSION ['error_flash'] = 'You do not have permission  to access this page';
  header('Location: '.$url);
}

function has_permission($permission = 'admin'){
  global $user_data;
  $permissions = explode(',', $user_data['permissions']);
  if (in_array($permission, $permissions, true)) {
    return true;
  }
  return false;
}

function pretty_date($date){
  return date("M d, Y h:i:A",strtotime($date));
}



//
// if(!isset($_COOKIE['name'])) {
//        echo "Cookies are not enabled on your browser, please turn them on!";
//    }
