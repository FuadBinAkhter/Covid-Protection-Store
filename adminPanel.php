<?php
session_start();
include 'connection_open.php';
if(!isset($_SESSION['admin_id']))///////////////////////////////////////////////////////////
{
    header('Location:adminLogIn.php');
}
else
{
    $admin_id_no = $_SESSION['admin_id'];/////////////////////////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST["about_us_section"]))
    {
      $new_message = $_POST["about_us_section"];
      $sql_insert = 'INSERT INTO about_us(description) VALUES("'.$new_message.'")';
      $result_insert = mysqli_query($link, $sql_insert);
    }
    if(isset($_POST["submit2"]))
    {
      $new_image = $_FILES['product_img_file']['name'];
      $new_description = $_POST["add_product_section"];
      $new_category = $_POST["product_category"];
      $new_name = $_POST["product_name"];
      $new_price = $_POST["product_price"];
      $new_quantity = $_POST["product_quantity"];
      if(!empty($_POST["private_product"]))
      {
        $new_status = $_POST["private_product"];   
      }
      else
      {
        $new_status = "public";
      }
      /*echo $new_status;*/
      $sql_product_insert = 'INSERT INTO all_products(product_image, description, product_category, name, price, quantity, status, admin_id) VALUES("'.$new_image.'", "'.$new_description.'", "'.$new_category.'", "'.$new_name.'", "'.$new_price.'", "'.$new_quantity.'", "'.$new_status.'", "'.$admin_id_no.'")';
      $result_product_insert = mysqli_query($link, $sql_product_insert);
      $last_inserted_id = mysqli_insert_id($link);
      /*echo $last_inserted_id;*/
      $product_file_name = "product_image_".$last_inserted_id;
      $image_type = strtolower(pathinfo($_FILES['product_img_file']['name'], PATHINFO_EXTENSION));
      $updated_image = $product_file_name.".".$image_type;
      $target_dir = "images/".$updated_image;
      $target_file = $target_dir ;
      $temp_file = $_FILES['product_img_file']['tmp_name'];
      move_uploaded_file($temp_file, $target_file);
      $sql_product_image_update = 'UPDATE all_products SET product_image="'.$updated_image.'" WHERE product_id="'.$last_inserted_id.'"';
      $result_product_image_update = mysqli_query($link, $sql_product_image_update);
    }
    date_default_timezone_set("Asia/Dhaka");
	$currentTime = date('Y:m:d H:i:s');
	
	if(isset($_POST['member_name']) && isset($_POST['member_std_id']) && isset($_POST['member_email'])
		&& isset($_POST['member_facebook']) && isset($_POST['member_linkedin']) && isset($_POST['member_twitter'])){

		$sqlInsert = 'INSERT INTO team (member_name, member_student_id, member_email, member_facebook, member_linkedin, member_twitter,
		created_date, updated_date, status) VALUES ("'.$_POST['member_name'].'", "'.$_POST['member_std_id'].'", "'.$_POST['member_email'].'",
		"'.$_POST['member_facebook'].'","'.$_POST['member_linkedin'].'","'.$_POST['member_twitter'].'", "'.$currentTime.'", "'.$currentTime.'", 1)';
	
		$resultInsert = mysqli_query($link, $sqlInsert) or die(mysqli_error($link));
		
		$lastInsertID = mysqli_insert_id($link);
		
		//echo $lastInsertID;
	
		$memberImgName = 'member_profile_pic'.$lastInsertID;
		
		$imageType = strtolower(pathinfo($_FILES['file_upload']['name'],PATHINFO_EXTENSION));
		
		$target_dir = "memberImages/".$memberImgName.".".$imageType;
		
		$target_file = $target_dir;
		
		$temp_file = $_FILES['file_upload']['tmp_name'];
		
		move_uploaded_file($temp_file, $target_file); 
		
		if(file_exists($target_file)){
			
			$sqlUpdate = 'UPDATE team SET member_image = "'.$target_dir.'" WHERE member_id = '.$lastInsertID;
			
			$resultUpdate = mysqli_query($link, $sqlUpdate) or die(mysqli_error($link));
		}
	}
}
include 'connection_close.php';
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
  <link rel="stylesheet" href="css/adminPanelStyle.css">
  <title>Covid Protection Store</title>

</head>
<body>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-md-1" style="text-align: center;">
            <a class="navbar-brand" href="adminPanel.php"><img src="images/onlinelogomaker-031821-2357-6488-2000-transparent.png" style="height: 70px;"alt="Logo"></a>
            </div>
            <div class="col-12 col-md-11"><h1>Admin Dashboard</h1></div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row">
            <div class="col-12 col-md-3 mt-4 mb-5">
                <div class="list-group">
                    <a href="#add_products" class="list-group-item list-group-item-action">Add Products</a>
                    <a href="#about_us_message" class="list-group-item list-group-item-action">About Us Message</a>
                    <a href="#team_info" class="list-group-item list-group-item-action">Team Info</a>
                    <!--User Info button Added-->
					<a href="showProducts.php" class="list-group-item list-group-item-action">All Products</a>
                    <a href="showUserInfo.php" class="list-group-item list-group-item-action">All Users</a>
                     <!--User Info button Added-->
					 <a href="showOrders.php" class="list-group-item list-group-item-action">All Orders</a>
					 <a href="showMessages.php" class="list-group-item list-group-item-action">Messages</a>
                     <!--
                    <a href="showTeaminfo.php" class="list-group-item list-group-item-action">Team Members</a>
                     -->
                    <a href="adminLogOut.php" class="list-group-item list-group-item-action">Logout</a>
                  </div>
            </div>
            <div class="col-12 col-md-9 mt-4">
                <h2 id="add_products" class="text-center">Add Products</h2>
                <hr class="mt-3 mb-5" style="height: 2px">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mt-4">
                        <label>Product Name</label>
                        <input type="text" name="product_name" value="" class="form-control" required>
                    </div>
                    <div class="form-group mt-4">
                        <label>Price</label>
                        <input type="number" name="product_price" value="" class="form-control" required>
                    </div>
                    <div class="form-group mt-4">
                        <label>Quantity</label>
                        <input type="number" name="product_quantity" value="" class="form-control" required>
                    </div>
                    <div class="form-group mt-4">
                        <label>Add Description</label>
                        <textarea name="add_product_section" placeholder="" class="form-control" required></textarea>
                    </div>
                    <select class="form-select mt-4" aria-label="Default select example" name="product_category">
                        <option selected>Select a category</option>
                        <option value="Antiseptic Liquid">Antiseptic Liquid</option>
                        <option value="Sanitizer">Sanitizer</option>
                        <option value="Disinfectant Spray">Disinfectant Spray</option>
                        <option value="Floor Cleaner">Floor Cleaner</option>
                        <option value="Liquid Handwash">Liquid Handwash</option>
                        <option value="Detergent">Detergent</option>
                        <option value="Soap">Soap</option>
                        <option value="Mask">Mask</option>
                        <option value="Face Shield">Face Shield</option>
                        <option value="PPE">PPE</option>
                        <option value="Glove">Glove</option>
                    </select>
                    <div class="form-group mt-4">
                        <label>Upload Picture</label>
                        <input type="file" name="product_img_file" value="" class="form-control" required>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" name="private_product" value="private">
                        <label class="form-check-label" for="exampleCheck1">Want to make it private for only your registered customers?</label>
                    </div>
                    <input type="submit" class="btn btn-dark mt-5" value="Add Product" name="submit2">
                </form>
                <h2 id="about_us_message" class="mt-5 text-center">About Us Message</h2>
                <hr class="mt-3 mb-5" style="height: 2px">
                <form method="POST">
                    <div class="form-group mt-4 mb-3">
                        <label>Change the Message in About Us Page</label>
                        <textarea name="about_us_section" placeholder="" class="form-control" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-dark mt-5" style="background-color: black; color: white;" value="Save Changes" name="">
                </form>
                <h2 id="team_info" class="mt-5 text-center">Team Info</h2>
                <hr class="mt-3 mb-5" style="height: 2px">
                <form action="" method="POST" enctype = "multipart/form-data">
						<div class = "form-group mt-4">
							<label>Name</label>
							<input type="text" name="member_name" value="" placeholder="" class="form-control" required />
						</div>
						<div class = "form-group mt-4">
							<label>Student ID</label>
							<input type="number" name="member_std_id" value="" placeholder="i.e. 180104000" class="form-control" required />
						</div>
						<div class = "form-group mt-4">
							<label>Email</label>
							<input type="email" name="member_email" value="" placeholder="email@example.com" class="form-control" required />
						</div>
						<div class = "form-group mt-4">
							<label>Facebook Profile</label>
							<input type="url" name="member_facebook" value="" placeholder="" class="form-control" />
						</div>
						<div class = "form-group mt-4">
							<label>LinkedIn Profile</label>
							<input type="url" name="member_linkedin" value="" placeholder="" class="form-control" />
						</div>
						<div class = "form-group mt-4">
							<label>Twitter Profile</label>
							<input type="url" name="member_twitter" value="" placeholder="" class="form-control" />
						</div>
						<div class = "form-group mt-4">
							<label>Upload Image</label>
							<input type="file" name="file_upload" value="" class="form-control" />
						</div>
						<div class = "form-group mt-5 mb-5">
							<input type="submit" value="Add Member" class="btn" style="background-color: black; color: white;"/>
						</div>
					</form>
            </div>
        </div>
    </div>

    <div class="text-center" style="background-color: black; color: white;">
        <a class="ald btn m-5" style="text-decoration: none; background-color: white;" href="index.php" target="_blank">Go to Website</a>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>