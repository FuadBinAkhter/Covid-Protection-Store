<?php
session_start();
error_reporting(0);
include 'connection_open.php';
if(isset($_GET["product_id"]))
{
    $product_details_query = 'SELECT * FROM all_products WHERE product_id="'.$_GET["product_id"].'"';
    $display_details = mysqli_query($link, $product_details_query) or die(mysqli_error($link));
    $product_info_array = mysqli_fetch_assoc($display_details);
    /*
    echo "<pre>";
    print_r($product_info_array);
    echo "</pre>";
    */
}
if(isset($_POST['product_id'])){
	session_start();
	
	$product_id = $_POST['product_id'];
	
	if(isset($_SESSION['productcart'])){
		
		//$quantity = $_SESSION['quantitycart'][$_SESSION['counter']];
		$sessionNo = $_SESSION['counter'] + 1;
		
		if(in_array($product_id, $_SESSION['productcart'])){
			
			//$_SESSION['productcart'][$sessionNo] = $product_id;
			$quantity = $_SESSION['quantitycart'][$product_id];
			$_SESSION['quantitycart'][$product_id]= $quantity + 1;
		}
		else{
			$_SESSION['productcart'][$product_id] = $product_id;
			$_SESSION['quantitycart'][$product_id] = 1;
			//session_destroy();
		}
		
		$_SESSION['counter'] = $sessionNo;
	}
	else{
		 $productcart = array();
		 $quantitycart = array();
		 
		 $_SESSION['productcart'][$product_id] = $product_id;
		 $_SESSION['quantitycart'][$product_id] = 1;
		 $_SESSION['counter'] = 1;
	}
	/*
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	*/
}
if($_SESSION['login']==true &&  $_SESSION['user_email']!=NULL)
{
  $nav_profile_name = $_SESSION['user_email'];
}
else
{
  $nav_profile_name = "Login";
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
    <link rel="stylesheet" href="css/products-style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Covid Protection Store</title>
</head>
<body>

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
              <a class="nav-link text-dark" href="view_userprofile.php"><i class="fas fa-user"></i> <?php echo $nav_profile_name; ?></a>
            </span>
          </div>
        </div>
      </nav>

    <section style="margin-top: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-12">
          <div class="list-group">
            <a href="products.php#antiseptic" class="list-group-item list-group-item-action">Antiseptic Liquid</a>
            <a href="products.php#sanitizer" class="list-group-item list-group-item-action">Sanitizer</a>
            <a href="products.php#disinfectant" class="list-group-item list-group-item-action">Disinfectant Spray</a>
            <a href="products.php#cleaner" class="list-group-item list-group-item-action">Floor Cleaner</a>
            <a href="products.php#handwash" class="list-group-item list-group-item-action">Liquid Handwash</a>
            <a href="products.php#detergent" class="list-group-item list-group-item-action">Detergent</a>
            <a href="products.php#soap" class="list-group-item list-group-item-action">Soap</a>
            <a href="products.php#mask" class="list-group-item list-group-item-action">Mask</a>
            <a href="products.php#shield" class="list-group-item list-group-item-action">Face Shield</a>
            <a href="products.php#ppe" class="list-group-item list-group-item-action">PPE</a>
            <a href="products.php#glove" class="list-group-item list-group-item-action">Glove</a>
          </div>
        </div>
        <div class="col-md-9 col-12">  
            <div class="product-details-section">
                <h1 class="text-center"><?php echo $product_info_array['name']; ?></h1>  
                <div class="card" style="width: 75%; height: auto; margin-left: auto; margin-right: auto;">
                    <img src="images/<?php echo $product_info_array['product_image']; ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Price: <?php echo $product_info_array['price']; ?> TK</h4>
                        <h5 class="card-title">Available Quantity: <?php echo $product_info_array['quantity']; ?></h5>
                        <h6 class="card-title">Category: <?php echo $product_info_array['product_category']; ?></h6>
                        <p class="card-text"><?php echo $product_info_array['description']; ?></p>
                        <form method="POST" action="">
							            <input type="hidden" name="product_id" value="<?php echo $product_info_array['product_id']; ?>" >
                          <button type="submit" class="btn btn-dark">Add to Cart <i class="fas fa-shopping-cart"></i></button>
						            </form>
                     </div>
                </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    </section>

      <footer>
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
              <p><a href="https://www.google.com/"><i class="fas fa-question-circle"></i> Help</a></p></div>
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