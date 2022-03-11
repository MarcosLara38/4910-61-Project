<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <title>Foodify</title>
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

            <div class = "additem">
                <input class="addingi" type = "text" placeholder="Add ingredient...">
                <button type = "button" class = "addbtn" onclick="addingredient()">Add ingredient</button>
                <button type = "button" class = "clearbtn" onclick = "clearlist()">Clear ingredient list</button>
                
            </div>


        </div>
    </div>
</body>
</html>