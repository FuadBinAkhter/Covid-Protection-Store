<?php
session_start();
error_reporting(0);
include 'connection_open.php';
if($_SESSION['login']==true &&  $_SESSION['user_email']!=NULL)
{
   $email=$_SESSION['user_email'];
   $sql = "SELECT * FROM users WHERE user_email='$email'";
   $result=mysqli_query($link, $sql);

   $sql_product = 'SELECT * FROM all_products WHERE status="private"';
   $result_product = mysqli_query($link, $sql_product) or die(mysqli_error($link));
}
else
{
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
    <link rel="stylesheet" href="css/user_profile.css">
    <link rel="stylesheet" href="css/products-style.css">
    <title>Document</title>
</head>
<body>
    <div class="container rounded bg-white mt-5">
    <div class="row">
        <?php
        foreach($result as $row)
        {
        if($row['user_email'] == $email)
        {?>
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-4" src="<?php echo $row['user_img'];?>" width="200">
            <span class="text-black-50"><?php echo $row['user_email']; ?>
            </span><span><?php echo $row['user_address']; ?></span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-2 mt-2"><h5>Id:</h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_id']; ?></p></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2 mt-2"><h5>Email: </h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_email']; ?></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2 mt-2"><h5>Phone: </h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_phone']; ?></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2 mt-2"><h5>Address: </h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_address']; ?></div>
                </div>
            </div>
        </div>

            <div class="col-md-3 align-items-center text-center pb-5">
                <a class="btn btn-dark" href="index.php">Back to homepage</a>
            </div>

            <div class="col-md-3 align-items-center text-center pb-5">
                <a class="btn btn-dark" href="user_profile.php">Edit Profile</a>
            </div>

            <div class="col-md-3 align-items-center text-center pb-5">
                <a class="btn btn-dark" href="order_records.php">Your Orders</a>
            </div>

             <div class="col-md-3 align-items-center text-center pb-5">
                <a class="btn btn-dark" href="SignOut.php?signout=logout">Sign Out</a>
            </div>

        <?php
        }
        }
       ?>
       
    </div>
</div>

<h2 class="text-center text-light mt-5">Special Products</h2>
<div class="container mt-5">
        <div class="row">
        <?php
        foreach($result_product as $row)
        {
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card product-card-view" style="border: none;">
              <div class="our-products-view">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                <h4><?php echo $row['name']; ?></h4>
                <h5>Price: <?php echo $row['price']; ?> TK</h5>
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                <a href="https://www.google.com/" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
              </div>
            </div>
          </div>
        <?php
        }
       ?>
      </div>
      </div>

</body>
</html>

<?php include 'connection_close.php'; ?>