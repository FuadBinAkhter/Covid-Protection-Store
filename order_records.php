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
    $sql_orders = "SELECT * FROM orders WHERE user_id='$user_ID'";
    $result_product = mysqli_query($link, $sql_orders) or die(mysqli_error($link));
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
    <link rel="stylesheet" href="css/order_style.css">
    <title>Document</title>
</head>
<body>

    <h1 class="mt-5 mb-3 text-center">Your Orders</h1>
    <table class="table table-dark table-hover text-center">
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
    
</body>
</html>

<?php
include 'connection_close.php';
?>