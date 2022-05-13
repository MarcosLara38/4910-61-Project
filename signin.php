
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
    <style>
        .bgbody {
            background:url('pics/backgroundfull.jpeg');background-size:cover;
            background-attachment: fixed;
            background-position: 0 100%;
            background-repeat: no-repeat;
        }
        </style>
</head>
<body class="bgbody"  style= text-align:center>
    <div class = "nav">
    <?php
        //uncomment when finished setting up connect.php database side
        require_once "connect.php";
        require "nav.php";
        if (isset($_POST) && !empty($_POST)) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            //$hashed = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                $_SESSION['logged_in'] = true;
                $_SESSION['userid'] = $data['id'];
                $_SESSION['name'] = $data['fname'];
                header("Location: home.php");
            }
            $result->free();
        }
    ?>
    </div>

        <img src="pics/logo.png">  
<div class = signin>
    <?php if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false){ ?>
        <div class="containerin">
        <form method="POST" id="signin">
        <h2>Welcome to the Sign In/Sign Up page</h2>
        Email: <input class = "signin_email" type="text" name = "email"/>
        <br>
        Password: <input class = "signin_pass" type = "password" name = "password"/>
        <br>
        <input class = "signin_btn" type = "submit" value="login"/>
        <p>Don't have an account? <a id='signinbtn' href="signup.php">Sign up</p>
        </form>
        </div>
    <?php } else{ ?>
        <h1>You are logged in</h1>
    <?php } ?>
    </div>

</body>
</html>