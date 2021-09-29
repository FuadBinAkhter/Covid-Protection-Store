<?php
	session_start();
	error_reporting(0);
	include 'connection_open.php';
	$sql = 'SELECT * FROM team';
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
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
		<link rel="stylesheet" href="css/teampagecss.css">
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

		<div class="header">
			<h1>MEET THE TEAM</h1>
		</div>

		<div class="container">
			<div class="row">
			
				<?php
				foreach($result as $row){
					if($row['status'] == 1) {
				?>
				<div class="col-md-4 col-sm-6">
					
					<div class="images">
					<img src = "<?php echo $row['member_image']; ?>" alt="image-<?php echo $row['member_id']; ?>"/>
					</div>
					<div class="title-wrapper">
						<div class="image-title">
							<h4><?php echo $row['member_name']; ?></h4>
							<h5><?php echo $row['member_student_id']; ?></h5>
							<h6><?php echo $row['member_email']; ?></h6>
						</div>
						<div class="social-icon">
							<ul>
								<li><a href = <?php echo $row['member_facebook']; ?> > <img src="images/facebook.png" title = "Facebook"/></a></li>
								<li><a href = <?php echo $row['member_linkedin']; ?> > <img src="images/linkedin.png" title = "LinkedIn"/></a></li>
								<li><a href = <?php echo $row['member_twitter']; ?> > <img src="images/twitter.png" title = "Twitter"/></a></li>								
							</ul>
						</div>
					</div>
				</div>	
					
				<?php } } 
				?>
		
			</div>
		</div>



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