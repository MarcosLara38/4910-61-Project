<?php
    require_once "connect.php";
  


//$nameErr = $emailErr = $genderErr = $websiteErr = "";
//$name = $email = $gender = $comment = $website = "";
$fnamevalid=true;
$lnamevalid=true;
$emailvalid=true;
$unamevalid=true;
$pwordvalid=true;
$confirmpwordvalid=true;
$validpassword=false;

if (isset($_POST['submit'])){


    if (empty($_POST["fname"])) {
        $fnamevalid = false;
      $fnameerr = "Name is required";
    } else {
      $fname = cleaninput($_POST["fname"]);
    }

    if (empty($_POST["lname"])) {
        $lnamevalid = false;
      $lnameerr = "Name is required";
    } else {
      $lname = cleaninput($_POST["lname"]);
    }

    
    
    if (empty($_POST["email"])) {
        $emailvalid=false;
      $emailerr = "Email is required";
    } else {
      $email = cleaninput($_POST["email"]);
    }
      
    #if (empty($_POST["uname"])) {
    #    $unamevalid=false;
    #  $unameerr = "Username is required";
    #} else {
    #  $uname = cleaninput($_POST["uname"]);
    #}
  
    if (empty($_POST["pword"])) {
        $pwordvalid=false;
      $pworderr = "Password is required";
    } else {
      $pword = cleaninput($_POST["pword"]);
    }
  
    if (empty($_POST["confirmpword"])) {
        $confirmpwordvalid=false;
      $confirmpworderr = "Confirmed password is required";
    } else {
      $confirmedpword = cleaninput($_POST["confirmpword"]);
    }

    if($pwordvalid && $confirmedpword){
        if(strcmp($pword,$confirmedpword) == 0){
            $validpassword = true;
            echo "Both passwords are the same and is valid, thank you!<br>";
        } else{
            $validpassword = false;
            echo "Passwords are not the same<br>";
        }
    }

    
    if($validpassword) {
            Echo "All entries are valid. Ready to enter info into database<br>";

            $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
            
            $stmt->bind_param("ssss", $fname, $lname, $email, $pword);
        if ($stmt->execute()) {
            
            $_SESSION['logged_in'] = true;
            $_SESSION['name'] = $fname;
            header("Location: home.php");
        } else {
            var_dump($conn->error);
            var_dump($stmt);
        }
    }
        



    

  
    /*
    echo "$fname<br>";
    echo "$email<br>";
    echo "$uname<br>";
    echo "$pword<br>";
    echo "$confirmedpword<br>";
  */  
    //var_dump($_POST);
  }

    /*
if(isset($_POST["fname"]) && !empty($_POST["fname"]) &&
isset($_POST["email"]) && !empty($_POST["email"]) &&
isset($_POST["uname"]) && !empty($_POST["uname"]) &&
isset($_POST["pword"]) && !empty($_POST["pword"]) &&
isset($_POST["confirmpword"]) && !empty($_POST["confirmpword"])){
    
    $fname = cleaninput($_POST["fname"]);
    $email = cleaninput($_POST["email"]);
    $uname = cleaninput($_POST["uname"]);
    $pword = cleaninput($_POST["pword"]);
    $confirmpword = cleaninput($_POST["confirmpword"]);

    echo "Thank you! $fname";
}else{
    Echo "Sorry, you need to enter all information needed";
}
*/


function cleaninput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="home.css">

</head>
<body>
  <?php require "nav.php"; ?>
  <div>
    <img src="pics/logo.png"> 
  </div>
<?php if(!$validpassword) { ?>
<form method="POST" id='signup'>

<p id='welcomesignup'>You're almost there, Just need some information about you first!</p>
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" placeholder="" <?php if(!$fnamevalid){ echo " style = 'border: 1px solid red'";} else{ echo "value = '$fname' ";} ?> > <?php echo $nameerr; ?> <br>
    <label for="lname">Lastname:</label>
    <input type="text" id="lname" name="lname" placeholder="" <?php if(!$lnamevalid){ echo " style = 'border: 1px solid red'";} else{ echo "value = '$lname' ";} ?>?> ><?php echo $lnameerr;?><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="" <?php if(!$emailvalid){ echo " style = 'border: 1px solid red'";}else{ echo "value = '$email' ";} ?> ?> ><?php echo $emailerr;?><br>
    <label for="pword">Password:</label>
    <input type="password" id="pword" name="pword" placeholder="" <?php if(!$pwordvalid){ echo " style = 'border: 1px solid red'";} ?>><?php echo $pworderr;?><br>
    <label for="confirmpword">Confirm Password:</label>
    <input type="password" id="confirmpword" name="confirmpword" placehorlder="" <?php if(!$confirmpwordvalid){ echo " style = 'border: 1px solid red'";} ?>><?php echo $confirmpworderr;?><br>
    <input type="submit" value="submit" name="submit">
</form>
<?php }else echo "Thank you $fname, you will be entered in our database. "?>

</body>
</html>