<?php
session_start();
error_reporting(0);
include 'connection_open.php';
$sql = 'SELECT * FROM all_products WHERE status="public" ORDER BY price ASC';
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

if(isset($_GET['product_id'])){
	session_start();
	
	$product_id = $_GET['product_id'];
	
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
	
	
	header("location:products.php");
	/*
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	*/
}
/*
echo "<pre>";
print_r($_GET);
echo "</pre>";
*/
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

      <h1 class="text-center mt-5">Products</h1>
    <section style="margin-top: 100px;">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-12">
          <div class="list-group">
            <a href="#antiseptic" class="list-group-item list-group-item-action">Antiseptic Liquid</a>
            <a href="#sanitizer" class="list-group-item list-group-item-action">Sanitizer</a>
            <a href="#disinfectant" class="list-group-item list-group-item-action">Disinfectant Spray</a>
            <a href="#cleaner" class="list-group-item list-group-item-action">Floor Cleaner</a>
            <a href="#handwash" class="list-group-item list-group-item-action">Liquid Handwash</a>
            <a href="#detergent" class="list-group-item list-group-item-action">Detergent</a>
            <a href="#soap" class="list-group-item list-group-item-action">Soap</a>
            <a href="#mask" class="list-group-item list-group-item-action">Mask</a>
            <a href="#shield" class="list-group-item list-group-item-action">Face Shield</a>
            <a href="#ppe" class="list-group-item list-group-item-action">PPE</a>
            
           <label class="list-group-item mt-5" style="color:white; background-color: #212529;">Sort by: </label>

            <select class="list-group-item list-group-item-action" name="forma" onchange="location = this.value;">
                <option value="sortedAscending.php">Price (Low > High)</option>
                <option value="products.php">Default</option>
                <option value="sortedDescending.php">Price (High > Low)</option>
            </select>
          </div>
        </div>
        <div class="col-md-9 col-12">
        
        
        <div class="antiseptic-section" id="antiseptic">
      <h2>Antiseptic Liquid</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
        <div class="row">
        <?php
        foreach($result as $row)
        {
        if($row['product_category'] == 'Antiseptic Liquid')
        {
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card product-card-view" style="border: none;">
              <div class="our-products-view">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                <h4><?php echo $row['name']; ?></h4>
                <h5>Price: <?php echo $row['price']; ?> TK</h5>
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
              </div>
            </div>
          </div>
        <?php
        }
        }
       ?>
      </div>
      </div>
    </div>

    <div class="sanitizer-section mt-5" id="sanitizer">
      <h2>Sanitizer</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
      <div class="row">
          <?php
          foreach($result as $row)
          {
            if($row['product_category'] == 'Sanitizer')
            {
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card product-card-view" style="border: none;">
              <div class="our-products-view">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                <h4><?php echo $row['name']; ?></h4>
                <h5>Price: <?php echo $row['price']; ?> TK</h5>
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
    </div>

    <div class="disinfectant-section mt-5" id="disinfectant">
      <h2>Disinfectant Spray</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
      <div class="row">
          <?php
          foreach($result as $row)
          {
            if($row['product_category'] == 'Disinfectant Spray')
            {
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card product-card-view" style="border: none;">
              <div class="our-products-view">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                <h4><?php echo $row['name']; ?></h4>
                <h5>Price: <?php echo $row['price']; ?> TK</h5>
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
    </div>

    <div class="floor-cleaner-section mt-5" id="cleaner">
      <h2>Floor Cleaner</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
      <div class="row">
          <?php
          foreach($result as $row)
          {
            if($row['product_category'] == 'Floor Cleaner')
            {
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card product-card-view" style="border: none;">
              <div class="our-products-view">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                <h4><?php echo $row['name']; ?></h4>
                <h5>Price: <?php echo $row['price']; ?> TK</h5>
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
    </div>

      <div class="handwash-section mt-5" id="handwash">
      <h2>Liquid Handwash</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Liquid Handwash')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="detergent-section mt-5" id="detergent">
        <h2>Detergent</h2>
        <hr style="height: 2px;">
        <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Detergent')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="soap-section mt-5" id="soap">
        <h2>Soap</h2>
        <hr style="height: 2px;">
        <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Soap')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="mask-section mt-5" id="mask">
        <h2>Mask</h2>
        <hr style="height: 2px;">
        <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Mask')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="shield-section mt-5" id="shield">
      <h2>Face Shield</h2>
      <hr style="height: 2px;">
      <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Face Shield')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="ppe-section mt-5" id="ppe">
        <h2>PPE</h2>
        <hr style="height: 2px;">
        <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'PPE')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="glove-section mt-5" id="glove">
        <h2>Glove</h2>
        <hr style="height: 2px;">
        <div class="container mt-5">
        <div class="row">
            <?php
            foreach($result as $row)
            {
              if($row['product_category'] == 'Glove')
              {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <div class="card product-card-view" style="border: none;">
                <div class="our-products-view">
                  <img src="images/<?php echo $row['product_image']; ?>" alt="" class="img-fluid">
                  <h4><?php echo $row['name']; ?></h4>
                  <h5>Price: <?php echo $row['price']; ?> TK</h5>
                  <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">View details <i class="fas fa-file-alt"></i></i></a>
                  <a href="?product_id=<?php echo $row['product_id']; ?>" class="btn btn-dark text-center mb-3">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
      </div>

      <div class="filter_asc-section mt-5" id="ascending">
        <h2>Filtered</h2>
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