<!DOCTYPE html>

<?php
        
    require_once "connect.php";
    require_once "dbFunc.php";
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <script src="upload.js"></script>
    <title>Search</title>
</head>
<body>
    <div class = "nav">
    <?php 
        require "nav.php";
    ?>
    </div>

    <img src="pics/logo.png">   
    <h1></h1>
    <div>
        <div class = "body">
            <ul id = "list">

            </ul>

            <div class = "searchdiv">
                <form method="post">
                    <input type = "text" class = "searchinput" name="searchQuery" placeholder="Search by recipe name..." value="">
                    <input type = "submit" name="searchBtn" value="Search" class = "searchbtn">
                </form>
            </div>
            <div style="margin-top: 100px;" id="objectinfo">
                <h1>test</h1>
            </div>

        </div>
    </div>
</body>
</html>