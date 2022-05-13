<?php
    session_start();

    //if(isset($_SESSION)){
    //    print_r($_SESSION);
    //}

    $host = 'localhost';
    $user = 'orodriguez';
    $dbpassword = 'Zegh86Gupm';
    $database = 'orodriguez';
    
    $conn = new mysqli($host, $user, $dbpassword, $database);
    
    if ($conn->connect_errno) {
        die("Connection failed: {$conn->connect_error}\n");
    }
?>
