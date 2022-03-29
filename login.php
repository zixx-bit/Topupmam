<?php
 require_once $_SERVER['DOCUMENT_ROOT']. '/TopUPmama/core/init.php';
 include '../includes/head.php';

 $email = ((isset($_POST['email']))? sanitize($_POST['email']):'');
 $email = trim($email);
 $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
 $password = trim($password);
 $errors = array();
 // $password ='password';
 // $hashed = password_hash($password, PASSWORD_DEFAULT);
 // echo $hashed;
?>
<style media="screen">
  /* body{

    background-image:linear-gradient(rgba(0,0,0,0.9),rgba(0,0,0,0.8)), url("/online store/images/headerlogo/background.jpg");
    background-size: 100vw 100vh;
    background-attachment: fixed;

  } */
</style>

<div id="login-form" >

  <div >
    <?php
     if ($_POST) {
        // form validation
      if (empty($_POST['email']) || empty($_POST['password'])) {
        $errors[] = 'You must provide email and password!';
      }

      // validate Email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'You must enter a valid email!';
      }

      if(strlen($password) < 8){
        $errors[] = 'Password must be atleast 8 characters!';
      }
      // check if email exisist in Database
      $query= $db->query("SELECT * FROM users WHERE email = '$email'");
      $user = mysqli_fetch_assoc($query);
      $userCount = mysqli_num_rows($query);
      if ($userCount < 1) {
        $errors [] = 'Wrong email entered!';
      }

      // password verify
      if (!password_verify($password, $user['password'])){
        $errors[] = 'The password does not match our records. Please try again!';
      }

      if (!empty($errors)) {
        echo display_errors($errors);
      }
      else {
        // login user
        $user_id = $user['id'];
        login($user_id);

      }
    }
    ?>
  </div>

 <div class="container">


  <h2 class="text-center">Login</h2><hr>
  <form class="" action="login.php" method="post">

    <div class="form-group col-md-6 ">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
      </div>

      <div class="form-group col-md-6 ">
        <label for="password">Password:</label>
        <input type="password" name="password" id ="password" class="form-control" value="<?=$password;?>">
      </div> <br>

    <div class="form-group">
      <input type="submit" name="" value="Login" class="btn btn-primary">
           <a href="register.php<?=((isset($_GET['edit']))?'?Edit':'?Register');?>"
              class="btn btn-success" id="add-product-btn"><?=((isset($_GET['edit']))?'Edit':'Register')?> </a>



    </div>
  </form>
  <p class="text-right"> <a href="/TopUPmama/users/index.php" alt="home"> Visit site</a> </p>

</div>
</div>
