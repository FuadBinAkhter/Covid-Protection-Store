<?php
session_start();
unset($_SESSION['adminData']);
header('Location:adminLogIn.php');
?>