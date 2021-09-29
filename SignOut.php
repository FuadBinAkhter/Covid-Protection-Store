<?php

    if(isset($_GET['signout']) and $_GET['signout'] == 'logout')
    {
        session_start();
        $_SESSION= ARRAY();
        session_destroy();
        header('location: SignIn.php');
    }
?>