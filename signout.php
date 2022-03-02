<?php
    //require "nav.php";
    //If you are logged this will sign you out 
    //and redirect you to home
    if($_SESSION['logged_in']){
        session_unset();
        session_destory();
        header("Location: home.php");
    }
    //If you are not logged in and you somehow still enter this page
    //you will be automatically redirected to home. 
    else{
        header("Location: home.php");
    }


?>