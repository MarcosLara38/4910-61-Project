<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <title>Search</title>
</head>
<body>
    <div class = "nav">
    <?php 
        require "connect.php";
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
                <input type = "text" class = "searchinput" placeholder="Search recipe...">
                <button type = "button" class = "searchbtn" onclick="addingredient()">Search Recipe</button>
            </div>


        </div>
    </div>
</body>
</html>