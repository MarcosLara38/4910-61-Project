
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <title>Foodify</title>
    <style>
        .bgbody {
            background:url('pics/backgroundfull.jpeg');background-size:cover;
            background-attachment: fixed;
            background-position: 0 100%;
            background-repeat: no-repeat;
        }
        </style>
</head>
<body class="bgbody" >
    <div class = "nav">
    <?php 
        require_once "connect.php";
        require "nav.php";
    ?>
    </div>

    <img src="pics/logo.png"><br><br><br>  
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): header("Location: signin.php");?>	
		<?php else: 
			print <<<HTML
			<h2>Welcome, {$_SESSION['name']}!</h2>
HTML;
			endif; ?>
    <div>
        <div class = "body">
            


        </div>
    </div>
</body>
</html>