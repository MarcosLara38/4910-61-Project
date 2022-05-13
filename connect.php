<?php
    session_start();

    // if(isset($_SESSION)){
    //    var_dump($_SESSION);
    // }

    $host = 'localhost';
    $user = 'orodriguez';
    $dbpassword = 'Zegh86Gupm';
    $database = 'orodriguez';
    $salt = "pepper";
    
    $conn = new mysqli($host, $user, $dbpassword, $database);
    
    if ($conn->connect_errno) {
        die("Connection failed: {$conn->connect_error}\n");
    }
?>
