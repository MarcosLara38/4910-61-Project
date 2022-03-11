<?php
    $host = 'localhost';
    $user = 'orodriguez';
    $password = 'Zegh86Gupm';
    $database = 'orodriguez';
    
    $conn = new mysqli($host, $user, $password, $database);
    
    if ($conn->connect_errno) {
        die("Connection failed: {$conn->connect_error}\n");
    }

    function sanitize($data) {
        $sanitized_data = '';
        if (is_array($data)) {
            $sanitized_data = [];
            foreach ($data as $key => $val) {
                $sanitized_data[$key] = htmlspecialchars($val);
            }
        } else {
            $sanitized_data = htmlspecialchars($data);
        }
        return $sanitized_data;
    }
?>