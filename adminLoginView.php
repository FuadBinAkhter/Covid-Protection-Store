<?php
session_start();
include 'connection_open.php';
$admin_email = $_POST["admin_email"];
$admin_password = md5($_POST["admin_password"]);
$sql = 'SELECT * FROM admin WHERE admin_email="'.$admin_email.'"';
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$no_of_rows = mysqli_num_rows($result);
if($no_of_rows)
{
    while($row = mysqli_fetch_assoc($result))
    {
        if($row['admin_password'] == $admin_password)
        {
            /*
            $admin_data = array(
                "adminId" => $row['admin_id'],
                "admin_email_address" => $row['admin_email']
            );
            $_SESSION['adminData'] = $admin_data;
            */
            $_SESSION['admin_id'] = $row['admin_id'];//////////////////////////////////////////////////////////////////
            header('Location:adminPanel.php');
        }
        else
        {
            echo "Email & password don't match!";
        }
    }
}
else
{
    echo "User doesn't exist!";
}
include 'connection_close.php';
?>