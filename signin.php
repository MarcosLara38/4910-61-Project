
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="home.css">

<body style= text-align:center>
    <div class = "nav">
    <?php
        //uncomment when finished setting up connect.php database side
        //require "connect.php";
        require "nav.php";
    ?>
    </div>
<?php if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false){ ?>
<form method="POST" id="signin">
    <h2>Welcome to the Sign In/Sign Up page</h2>
    Username: <input type="text" name = "username"/>
    <br>
    Password: <input type = "password" name = "password"/>
    <br>
    <input type = "submit" value="login"/>
    <p>Don't have an account? <a id='signinbtn' href="signup.php">Sign up</p>
</form>
<?php } else{ ?>
    <h1>You are logged in</h1>
<?php } ?>

</body>
</html>