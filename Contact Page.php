<?php
	session_start();
	error_reporting(0);
	include 'connection_open.php';
	date_default_timezone_set("Asia/Dhaka");
	$currentTime = date('Y:m:d H:i:s');
	
	if(isset($_POST['sender_name']) && isset($_POST['sender_email']) && isset($_POST['sender_phone'])
		&& isset($_POST['message'])){

		$sqlInsert = 'INSERT INTO messages (sender_name, sender_email, sender_phone, message,
		created_date, updated_date, status) VALUES ("'.$_POST['sender_name'].'", "'.$_POST['sender_email'].'", "'.$_POST['sender_phone'].'",
		"'.$_POST['message'].'", "'.$currentTime.'", "'.$currentTime.'", 1)';
	
		$resultInsert = mysqli_query($link, $sqlInsert) or die(mysqli_error($link));

		$to_email = "insta.aid.team@gmail.com";
		$subject_email = "Message from ".$_POST['sender_name'];
		$body_email = "Name: ".$_POST['sender_name']."\n\nEmail: ".$_POST['sender_email']."\n\nPhone: ".$_POST['sender_phone']."\n\nMessage: ".$_POST['message'];
		$headers = "From: protectionstorecovid@gmail.com";

		if(mail($to_email,$subject_email,$body_email,$headers)){
			$message = "<div class='alert alert-success' role='alert'>Message Sent Successfully!</div>";
		}
		else{
			$message = "<div class='alert alert-warning' role='alert'>Message not sent!</div>";
		}

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
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<!--
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<!--
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/contactpagecss.css">
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

	<div class = "message_status"><?php echo $message; ?></div>

	<div class="container-wrapper1">
		<div class = "container" >
			<div class = "row">
				<div class="col-md-6"> 
					<div class="wrapper1">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.538758124295!2d90.40448511481556!3d23.763821984582805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c77decb5f845%3A0xc2eadd2f3b867792!2sAhsanullah%20University%20of%20Science%20and%20Technology!5e0!3m2!1sen!2sbd!4v1616757133025!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
				<div class = "col-md-6">
					<div class="wrapper2">
						<div class="header">
							<h1 style="text-align: center;">Get in touch!</h1>
						</div>
						<form action="" method="POST" >
							<div class = "form-group mb-3">
								<label>Name</label>
								<input type="text" name="sender_name" value="" placeholder="Enter your name" class="form-control" required />
							</div>
							<div class = "form-group mb-3">
								<label>Email</label>
								<input type="email" name="sender_email" value="" placeholder="Enter your email" class="form-control" required />
							</div>
							<div class = "form-group mb-3">
								<label>Phone Number</label>
								<input type="text" name="sender_phone" value="" placeholder="Enter your phone number" class="form-control" />
							</div>
							<div class = "form-group mb-3">
								<label>Message</label>
								<textarea name="message" placeholder="Enter your message" class="form-control" required></textarea>
							</div>
							<div class = "form-group mb-3" style="text-align: center; margin-top: 50px;">
								<input type="submit" value="Send" class="btn btn-light"  style="font-size: 17px; font-family: 'Ubuntu', sans-serif; padding-left: 25px; padding-right: 25px;"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<!--
	<div class="container-wrapper2">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="images/phone.png" />
					<h2>CALL US 24/7</h2>
					<h3>+123-456-7890</h3>
				</div>
				<div class="col-md-4">
					<img src="images/email.png" />
					<h2>EMAIL US</h2>
					<h3>example@example.com</h3>
				</div>
				<div class="col-md-4">
					<img src="images/office.png" />
					<h2>VISIT US</h2>
					<h3>Daily 9:00-20:00</h3>
				</div>
			</div>
		</div>
	</div>
	-->

	<!--
		<div class="social-icon">
			<h2>FOLLOW US</h2>
			<ul>
			<li><img src="images/facebook.png" /></li>
			<li><img src="images/linkedin.png" /></li>
			<li><img src="images/twitter.png" /></li>
			</ul>
		</div>
	-->
			
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

		<!--Option 1: Bootstrap Bundle with Popper
		<script src="js/bootstrap.bundle.min.js">
		-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>

<?php include 'connection_close.php';?>