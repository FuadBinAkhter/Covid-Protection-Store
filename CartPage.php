<?php
	include 'connection_open.php';
	session_start();
	//echo $_SESSION['user_email'];
		
	if(isset($_GET['product_id'])){
		
		$pid = $_GET['product_id'];
		
		if($_SESSION['quantitycart'][$pid] <= 1){			
			unset($_SESSION['productcart'][$pid]);
			unset($_SESSION['quantitycart'][$pid]);
		}
		else{
			$quantity = $_SESSION['quantitycart'][$pid];
			$_SESSION['quantitycart'][$pid]= $quantity - 1;
		}
		
		header("location:CartPage.php");
		
	}
	
	date_default_timezone_set("Asia/Dhaka");
	$currentTime = date('Y:m:d H:i:s');
	
	if(isset($_POST['product_names']) && isset($_POST['product_quantities']) && isset($_POST['product_total_prices'])
		&& isset($_POST['order_subtotal']) && isset($_POST['order_total_item'])){
			
		if($_SESSION['login']==true &&  $_SESSION['user_email']!=NULL){
			
		$query = 'SELECT * FROM users WHERE user_email="'.$_SESSION['user_email'].'"';
		$result = mysqli_query($link, $query);
		foreach($result as $row){
			$user_id = $row['user_id'];
		}

		$sqlInsert = 'INSERT INTO orders (user_id, product_names, product_quantities, product_total_prices, order_subtotal, order_total_item, created_date, updated_date) 
		VALUES ("'.$user_id.'", "'.$_POST['product_names'].'", "'.$_POST['product_quantities'].'", "'.$_POST['product_total_prices'].'",
		"'.$_POST['order_subtotal'].'", "'.$_POST['order_total_item'].'", "'.$currentTime.'", "'.$currentTime.'")';
	
		$resultInsert = mysqli_query($link, $sqlInsert) or die(mysqli_error($link));
		
		//session_destroy();
		header("location:CartPage.php");
		
	}	
	else{
		echo "Please login first!";
	}
	}
	
	//$q = 'SELECT product_names FROM orders';
	
	//echo mysqli_query($link, json_decode($q));
	//include 'connection_close.php';
		
/*	
	if(isset($_GET['product_id'])){
	//session_start();
	
	$product_id = $_GET['product_id'];
	
	if(isset($_SESSION['productcart'])){
		
		//$quantity = $_SESSION['quantitycart'][$_SESSION['counter']];
		$sessionNo = $_SESSION['counter'] + 1;
		
		if($_SESSION['quantitycart'][$product_id] > 1){
			
			//$_SESSION['productcart'][$sessionNo] = $product_id;
			$quantity = $_SESSION['quantitycart'][$product_id];
			$_SESSION['quantitycart'][$product_id]= $quantity - 1;
		}
		else{
			$_SESSION['productcart'][$sessionNo] = $product_id;
			$_SESSION['quantitycart'][$product_id] = 0;
			//session_destroy();
		}
		
		$_SESSION['counter'] = $sessionNo;
	}
	/*
	else{
		 $productcart = array();
		 $quantitycart = array();
		 
		 $_SESSION['productcart'][0] = $product_id;
		 $_SESSION['quantitycart'][$product_id] = 1;
		 $_SESSION['counter'] = 1;
	}
	
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	
}*/
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
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/cartpagecss.css">
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
            <span class="navbar-text">
              <a class="nav-link text-dark" href="view_userprofile.php"><i class="fas fa-user"></i> Login</a>
            </span>
          </div>
        </div>
      </nav>

	<?php
	if(isset($_SESSION['productcart']) && !empty($_SESSION['productcart'])){
		
	//$total_price = array();
	$product_names = array();
	$subtotal_price = array();
	$total_item = array();
	
	foreach ($_SESSION['productcart'] as $key => $value){
	//	if($_SESSION['quantitycart'][$product_id]){
			
			$query = 'SELECT * FROM all_products WHERE product_id='.$value;
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$product_details = mysqli_fetch_assoc($result);
			
			$quantity = $_SESSION['quantitycart'][$value];
			$total_price = $product_details['price'] * $quantity;

		?>	
		<div class = "cart_items">
			<table>
			<tr>
				<!--<td><?php echo $key;?></td>-->
				<td><img src="images/<?php echo $product_details['product_image']; ?>" ></td>
				<td>Name:</br><?php echo $product_details['name']; ?></td>
				<td>Category:</br><?php echo $product_details['product_category']; ?></td>
				<td>Price:</br><?php echo $product_details['price']; ?></td>
				<td>Quantity:</br><?php echo $quantity; ?></td>
				<td>Available Quantity:</br><?php echo $product_details['quantity']; ?></td>
				
				<td>Total Price:</br><?php echo $total_price; ?></td>
				
				<td><a href = "?product_id=<?php echo $value; ?>"><img src="images/itemdelete.jpg" ></a></td>
				
			</tr>
			</table>
		</div>
		<?php	
		
			$product_names[] = $product_details['name'];
			$subtotal_price[] = $total_price;
			$total_item[] = $quantity;
		
	//}
	}
	//echo array_sum($subtotal_price);
	?>
	<h6 class="text-center">Subtotal:  <?php echo array_sum($subtotal_price); ?> TK</h6>  
	<h6 class="text-center">Total Items:  <?php echo array_sum($total_item); ?> </h6>  
	
	<div class="text-center">
	<form method="POST" action="">
		<input type="hidden" name="product_names" value="<?php echo implode(",", $product_names); ?>" >
		<input type="hidden" name="product_quantities" value="<?php echo implode(",", $total_item); ?>" >
		<input type="hidden" name="product_total_prices" value="<?php echo implode(",", $subtotal_price); ?>" >
		<input type="hidden" name="order_subtotal" value="<?php echo array_sum($subtotal_price); ?>" >
		<input type="hidden" name="order_total_item" value="<?php echo array_sum($total_item); ?>" >
        <button type="submit" class="btn btn-dark">Confirm Order</button>
	</form>
	</div>
	<?php
	
	}
	else{ ?>
		<h2>No items in the cart</h2>
	<?php
	}
	?>
	
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
