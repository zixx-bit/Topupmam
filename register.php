<?php

require_once '../core/init.php';
// if (!is_logged_in()) {
//   login_error_redirect();
// }
// if (!has_permission()) {
//   permission_error_redirect('index.php');
// }
include "../includes/head.php";
// if (isset($_GET['delete'])) {
//   $delete_id = sanitize($_GET['delete']);
//   $db->query("DELETE FROM users WHERE id='$delete_id'");
//   $_SESSION['success_flash'] = 'User has been deleted';
//   header('Location: users.php');
// }
if (isset($_GET['Register'])) {
  $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
  $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
  $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
  $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
  $errors = array();
  if ($_POST) {
    $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
    $emailCount = mysqli_num_rows($emailQuery);
    if ($emailCount !=0) {
       $errors[] = 'Email already exists! Use a different email';
    }

    $required = array('name', 'email', 'password', 'confirm');
    foreach ($required as $f ) {
      if (empty($_POST[$f])) {
        $errors[] = 'You must fill out all fields';
        break;
      }
    }

    if (strlen($password) < 8) {
      $errors [] = 'Password must be atleast 8 characters';
    }

    if ($password != $confirm) {
      $errors [] = 'Passwords do not match';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'You must enter a valid email address';
    }


    if (!empty($errors)) {
      echo display_errors($errors);
    }
    else {
      // add user to databse
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $db->query("INSERT INTO users (full_name,email,password) Values ('$name','$email','$hashed')");
      $_SESSION['success_flash'] = ' New user added :)';
      header('Location: users.php');
    }
  }

// include '../includes/navigation.php';
  ?>
  <div class="container">


<h3 class="text-center">Register</h3>

<h2 class="text-center"> <?=((isset($_GET['edit']))?'Edit':'');?></h2><hr>
<form class="" action="index.php<?=((isset($_GET['edit']))?'?edit':'?add=1');?>" method="post" >
  <div class="form-group col-md-6">
    <label for="name">Full Name:</label>
    <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
      </div>

  <div class="form-group col-md-6">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
      </div>

  <div class="form-group col-md-6">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
      </div>

  <div class="form-group col-md-6">
    <label for="confirm">Confirm Password:</label>
    <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
  </div> <br>



  <div class="form-group col-md-6 text-right " style="margin-top:25px;">
    <a href="register.php" class="btn btn-default">Cancel</a>
    <input type="submit"  value="Register" class="btn btn-primary">
  </div>
</form>

  <?php
}else{
// $userQuery = $db->query("SELECT * FROM users ORDER BY full_name");

 ?>

 <h2>User</h2>
 <div class="pull-right">
   <a href="login.php" class="btn btn-default " id="add-product-btn">Cancel</a>

   <a href="register.php<?=((isset($_GET['edit']))?'?Edit':'?Register');?>"
     class="btn btn-success" id="add-product-btn"><?=((isset($_GET['edit']))?'Edit':'Register')?> </a>
 </div>

<?php }

  // "includes/footer.php";
  ?>
