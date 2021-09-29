<?php
    session_start();
    error_reporting(0);
    include 'connection_open.php';
    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $query=mysqli_query($link,"SELECT * FROM users WHERE user_email='$email'");
        $num=mysqli_fetch_array($query);
        if($num>0)
        {
        mysqli_query($link,"update users set user_password='$password' WHERE user_email='$email'");
            echo "Password Changed Successfully";
            header("location:SignIn.php");

        }
        else
        {
            echo "Invalid email id or Contact no";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
      <div class="col-md-12">
        <h3 class="signin-text mb-3">Reset Password</h3>
        <form method="POST">
          <div class="form-group mt-4">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group mt-4">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <!--
          <div class="form-group form-check mt-3">
              <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
              <label class="form-check-label" for="checkbox">Remember Me</label>
          </div>
          -->
          <button class="btn btn-dark mt-5" name="submit" style="font-size: 1.2rem;">Reset</button>
       </form>
    </div>
    </div>
</body>
</html>

<?php include 'connection_close.php'; ?>