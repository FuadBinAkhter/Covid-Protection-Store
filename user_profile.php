<?php
session_start();
error_reporting(0);
include 'connection_open.php';
$user_ID;

if($_SESSION['login']==true &&  $_SESSION['user_email']!=NULL)
{
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
    <link rel="stylesheet" href="css/user_profile.css">
    <title>Document</title>
</head>
<body>
    <div class="container rounded bg-white mt-5">
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
                <div class="row mt-3">
                    <div class="col-md-1 mt-2"><h5>Id:</h5></div>
                    <div class="col-md-10 mt-2"><p><?php echo $row['user_id']; ?></p></div>
                </div>
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
</body>
</html>

<?php
include 'connection_close.php';
?>