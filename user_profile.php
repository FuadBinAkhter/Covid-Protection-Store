<?php
session_start();
error_reporting(0);
include 'connection_open.php';
$user_ID;

if($_SESSION['login']==true &&  $_SESSION['user_email']!=NULL)
{
    $nav_profile_name = $_SESSION['user_email'];
    $email=$_SESSION['user_email'];
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result=mysqli_query($link, $sql);
         foreach($result as $row)
        {
            if($row['user_email'] == $email)
            {
                $user_ID=$row['user_id'];
            }
        }
}
else
{
     $nav_profile_name = "Login";
     header("location:SignIn.php");
}


if(isset($_POST['submit']))
{

        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];

       $sql1="select user_email from users where user_id<>'$user_ID' and user_email='$email'";
       $res1= mysqli_query($link, $sql1);
       $num1=mysqli_fetch_array($res1);

       $sql2="select user_phone from users where user_id<>'$user_ID' and user_phone='$phone'";
       $res2= mysqli_query($link, $sql2);
       $num2=mysqli_fetch_array($res2);


       if($num1>0 or $num2>0)
        {
            $error="<div class='alert alert-danger' role='alert'>Another account already exists with this Email or Phone number.</div>";
        }
        else
        {
            $sql = "update users set user_email='$email',user_phone='$phone',user_address='$address' WHERE user_id='$user_ID'";
            mysqli_query($link, $sql);

            $userImgName = 'user_profile_pic'.$user_ID;
            
            $imageType = strtolower(pathinfo($_FILES['file_upload']['name'],PATHINFO_EXTENSION));
            
            $target_dir = "userImages/".$userImgName.".".$imageType;

            $target_file = $target_dir;
            
            $temp_file = $_FILES['file_upload']['tmp_name'];
            
            move_uploaded_file($temp_file, $target_file); 
            
            if(file_exists($target_file))
            {
                
                $sqlUpdate = 'UPDATE users SET user_img = "'.$target_dir.'" WHERE user_id = '.$user_ID;
                
                $resultUpdate = mysqli_query($link, $sqlUpdate) or die(mysqli_error($link));
            }
            
            header("location:view_userprofile.php");

        }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!--
    <link rel="stylesheet" href="css/user_profile.css">
    -->
    <title>Covid Protection Store</title>
</head>
<body style="font-family: 'Ubuntu', sans-serif;">

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="images/onlinelogomaker-031821-2357-6488-2000-transparent.png" style="height: 70px;"alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-dark" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="about-us.php">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="Contact Page.php">Contact Us</a>
              </li>
            </ul>
            <span class="navbar-text">
              <a class="nav-link text-dark" href="CartPage.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            </span>
            <span class="navbar-text nav-item dropdown">
              <a class="nav-link text-dark dropdown-toggle" href="view_userprofile.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $nav_profile_name; ?></a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="user_profile.php">Edit Profile</a></li>
                <li><a class="dropdown-item" href="order_records.php">Your Orders</a></li>
                <li><a class="dropdown-item" href="SignOut.php?signout=logout">Sign Out</a></li>
             </ul>
            </span>
          </div>
        </div>
      </nav>

    <div class="container mt-5">
    <form action="" method="POST" enctype = "multipart/form-data">
    <div class="form-group"><?php echo $error; ?></div>
    <div class="row">
    <?php
        foreach($result as $row)
        {
        if($row['user_id'] == $user_ID)
        {?>
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" src="<?php echo $row['user_img'];?>" width="200">
            <span class="text-black-50"><?php echo $row['user_email']; ?></span>
            <span><?php echo $row['user_address']; ?></span>
        </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
			<!--
                <div class="row mt-3">
                    <div class="col-md-1 mt-2"><h5>Id:</h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_id']; ?></p></div>
                </div>
			-->
                <div class="row mt-3">
                    <div class="col-md-1 mt-2">Email: </div>
                    <div class="col-md-10"><input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $row['user_email']; ?>" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-1 mt-2">Phone: </div>
                    <div class="col-md-10"><input type="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo $row['user_phone']; ?>" required></div>
                </div>
                <div class="row mt-3">
                     <div class="col-md-1 mt-2">Address: </div>
                    <div class="col-md-10"><input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $row['user_address']; ?>" required></div>
                </div>
                <?php
                }
                }
            ?>
                <div class="row mt-3">
                     <div class="col-md-1">Upload Picture: </div>
                    <div class="col-md-10"><input type="file"  name="file_upload" class="form-control"></div>
                </div>
                <input type="submit" class="btn btn-dark mt-5" value="Save" name="submit">
            </div>
        </div>
        </form>

    </div>
</div>

<footer class="mt-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <h5>Products</h5>
              <hr style="width: 120px; height: 5px;">
              <p><a href="https://www.google.com/">Outdoors</a></p>
              <p><a href="https://www.google.com/">Home Disinfecting</a></p>
              <p><a href="https://www.google.com/">Daily Essentials</a></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <h5>Useful Links</h5>
              <hr style="width: 120px; height: 5px;">
              <p><a href="view_userprofile.php"><i class="fas fa-user"></i> Your Account</a></p>
              <p><a href="https://www.google.com/"><i class="fas fa-concierge-bell"></i> Services</a></p>
              <p><a href="https://www.google.com/"><i class="fas fa-question-circle"></i> Help</a></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <h5>Contact Us</h5>
              <hr style="width: 120px; height: 5px;">
              <p><a href="https://www.google.com/"><i class="fas fa-phone-alt"></i> +01700000000</a></p>
              <p><a href="https://www.google.com/"><i class="far fa-envelope"></i> fightcovid@yahoo.com</a></p>
              <p><a href="https://www.google.com/"><i class="fas fa-map-marker-alt"></i> 273/3, West Virgina, USA</a></p>
            </div>
          </div>

          <hr class="mb-4">

          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <p>&copy; Copyrights 2021 - All Rights Reserved By <strong><a href="Team Page.php">Team</a></strong></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="text-center">
                <ul class="list-unstyled list-inline">
                  <li class="list-inline-item">
                    <a href="https://www.google.com/"><i class="fab fa-facebook-square"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.google.com/"><i class="fab fa-instagram"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.google.com/"><i class="fab fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>

<?php
include 'connection_close.php';
?>