<?php
include 'connection_open.php';
error_reporting(0);

$error=NULL;

if(isset($_POST['submit']))
{
	$email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
	$password=md5($_POST['password']);
	$cpassword=md5($_POST['confirm-password']);

    $ret1=mysqli_query($link,"SELECT * FROM users WHERE user_email='".$_POST['email']."'");
    $num1=mysqli_fetch_array($ret1);

    $ret2=mysqli_query($link,"SELECT * FROM users WHERE user_phone='".$_POST['phone']."'");
    $num2=mysqli_fetch_array($ret2);

    if($num1>0 or $num2>0)
    {
        $error="<div class='alert alert-danger' role='alert'>An account already exists with this Email or Phone number.</div>";
    }
    else{

        if($password!=$cpassword)
        {
          $error="<div class='alert alert-danger' role='alert'>Passwords don't match.</div>";
        }
        else
        {
          $query=mysqli_query($link,"insert into users(user_email,user_phone,user_address,user_password) values('$email','$phone','$address','$password')");
          $message = "Registration successful.You may now login.";
          echo "<script type='text/javascript'>alert('$message');</script>";
          header('Location:SignIn.php');
        }

    }

    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/SignIn_styles.css"> 
  <link rel="stylesheet" href="css/styles.css">

</head>
<body>
  <div class="container">
    <div class="row content">
      <div class="col-md-6 pt-5">
        <img src="images/onlinelogomaker-031821-2357-6488-2000-transparent.png" class="img-fluid" alt="image">
      </div>
      <div class="col-md-6">
        <h3 class="signin-text mb-3">Sign Up</h3>
        <form method="POST">

          <div class="form-group"><?php echo $error; ?></div>

          <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="phone">Phone</label>
            <input type="phone" name="phone" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group mt-3">
            <label for="password">Confirm Password</label>
            <input type="password" name="confirm-password" class="form-control" required>
          </div>
          <!--
          <div class="form-group form-check mt-3">
              <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
              <label class="form-check-label" for="checkbox">Remember Me</label>
          </div>
          -->
          <button class="btn btn-dark mt-5" name="submit" style="font-size: 1.2rem;">Register</button>
        </form>

         <div class="mt-4">
          <a class="ald" href="SignIn.php">Already have an account?</a>
        </div>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>

<?php include 'connection_close.php'; ?>