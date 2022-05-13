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

    <img src="pics/4.jpeg">
    <img src="pics/5.jpeg">
    <img src="pics/3.jpeg">   
    <h1></h1>
    <div>
        <div class = "body">
            <ul id = "list">

            </ul>

            
            <div class = "searchdiv">
                <h2>Please search a recipe name with a keyword</h2>
                <form method="post">
                    <input type = "text" class = "searchinput" name="searchQuery" placeholder="Search by recipe name..." value="">
                    <input type = "submit" name="searchBtn" value="Search" class = "searchbtn">
                </form>
            </div>
            <div style="margin-top: 100px;" id="objectinfo">
                <?php
                    if(isset($_POST['searchBtn'])){
                        if($data != null){
                            print "<h1> Based on the search these are the recipes we found </h1>";
                            print "<h1>Found $rows Recipes</h1><br>";
                            for($i=0;$i<$rows;$i++){
                                print "<div id = boxRecipe>";
                                print "<p>". $data[$i]['recipeid'] . " <a href = recipeparse.php > " . $data[$i]['RecipeName'] . "</a></p>";
                                print "<p>". "CookTime: " . $data[$i]['CookTime'] . " minutes</p>";
                                print "<p>". "Category of food is: " . $data[$i]['CategoryFood'] . "</p>";
                                print "<p>". "Serving Size: " . $data[$i]['ServingSize'] . "</p><br>";
                                
                                print "</div>";
                            }
                        } else {print "<h1>No Results found for $RecipeName </h1>";}
                    }
                ?>

            </div>
            


        </div>
    </div>
</body>
</html>