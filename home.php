<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require "nav.php";
    ?>

    <img src="pics/banner.png">   
    <h1>This is a heading for the home page</h1>
    <div>
        <div>
            <ul id = "list">

            </ul>

            <div class = "additem">
                <input type = "text" id = "input" placeholder="Add ingredient...">
                <button type = "button" id = "button" onclick="addingredient()">Add ingredient</button>
                <button type = "button" id = "clear" onclick = "clearlist()">Clear ingredient list</button>
            </div>


        </div>
    </div>
</body>
</html>