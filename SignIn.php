<?php
session_start();
error_reporting(0);
include 'connection_open.php';
if(isset($_POST['submit']))
{
    $ret=mysqli_query($link,"SELECT * FROM users WHERE user_email='".$_POST['email']."' and user_password='".md5($_POST['password'])."'");
    $num=mysqli_fetch_array($ret);
    if($num>0)
    {
        $_SESSION['user_email']=$_POST['email'];
        $_SESSION['login']=true;
        header("location:view_userprofile.php");
    }
    else
    {
        $error="<div class='alert alert-danger' role='alert'>Wrong Email or Password.</div>";
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
  <title>Covid Protection Store</title>

</head>
<body>

  <div class="container">
    <div class="row content">
      <div class="col-md-6 pt-3">
        <img src="images/onlinelogomaker-031821-2357-6488-2000-transparent.png" class="img-fluid" alt="image">
      </div>
      <div class="col-md-6">
        <h3 class="signin-text mb-3">Sign In <a class="ald btn btn-dark text-light" style="float: right;" href="adminLogin.php">Admin</a></h3>
        <form method="POST">
           <div class="form-group"><?php echo $error; ?></div>
          <div class="form-group mt-4">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group mt-4">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <!--
          <div class="form-group form-check mt-3">
              <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
              <label class="form-check-label" for="checkbox">Remember Me</label>
          </div>
          -->
          <button class="btn btn-dark mt-5" name="submit" style="font-size: 1.2rem;">Login</button>
        </form>

        <div class="mt-4">
          <a class="ald text-dark" href="SignUp.php">Don't have an account?</a>
        </div>
        <div class="mt-4">
          <a class="ald text-dark" name="reset" href="ResetPassword.php">Forgot Password?</a>
        </div>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>

<?php include 'connection_close.php'; ?>