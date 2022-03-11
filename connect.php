<?php
    session_start();

    $host = 'localhost';
    $user = 'orodriguez';
    $dbpassword = 'Zegh86Gupm';
    $database = 'orodriguez';
    
    $conn = new mysqli($host, $user, $dbpassword, $database);
    
    if ($conn->connect_errno) {
        die("Connection failed: {$conn->connect_error}\n");
    }
?>