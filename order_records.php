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
    $sql_orders = "SELECT * FROM orders WHERE user_id='$user_ID'";
    $result_product = mysqli_query($link, $sql_orders) or die(mysqli_error($link));
}
else
{
    $nav_profile_name = "Login";
     header("location:SignIn.php");
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
    <link rel="stylesheet" href="css/order_style.css">
    <link rel="stylesheet" href="css/style.css">
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

      <div class="container">
      <h1 class="mt-5 mb-3 text-center">Your Orders</h1>
    <table class="table table-dark table-hover text-center" style="margin-bottom: 300px;">
    <tr>
            <th>Products</th>
            <th>Quantity</th>
            <th>Price of each product</th>
            <th>Total Price</th>
            <th>Total items</th>
            <th>Time</th>
        </tr>
        <?php
            foreach($result_product as $key => $row)
            {
        ?>
        <tr>
            <td><?php echo $row['product_names'];?></td>
            <td><?php echo $row['product_quantities'];?></td>
            <td><?php echo $row['product_total_prices'];?></td>
            <td><?php echo $row['order_subtotal'];?></td>
            <td><?php echo $row['order_total_item'];?></td>
            <td><?php echo $row['created_date'];?></td>
        </tr>
        <?php
            }
        ?>
    </table>
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