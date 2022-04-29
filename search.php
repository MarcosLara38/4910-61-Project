<?php

$file = 'Recipe1.json'; 
$data = file_get_contents($file); 
$obj = json_decode($data, TRUE);
$reccount = count($obj['Recipes']);

for ($a=0;$a<1;$a++){

    $ingcount = count($obj['Recipes'][$a]['Ingredients']);
    $prpcount = count($obj['Recipes'][$a]['Preparation']);

    print ($obj['Recipes'][$a]['name']);
    echo "<br>";

    for ($i=0;$i<$ingcount;$i++){
        print ($obj['Recipes'][$a]['Ingredients'][$i]['Name']);
        echo ": ";
        print ($obj['Recipes'][$a]['Ingredients'][$i]['Quantity']);
        echo "<br>";
        
    }

    for ($b=0;$b<$prpcount;$b++){

        print ($obj['Recipes'][$a]['Preparation'][$b]['Step']);
        echo "<br>";
    }

    

}





?>

<!DOCTYPE html>
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
            <div>
                <input type="file" id="jsonfileinput">

                <button type = "button" class = "searchbtn" onclick="showData();">Show Data</button>
            </div>
            <div id="objectinfo"></div>

        </div>
    </div>
</body>
</html>