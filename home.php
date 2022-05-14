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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
<body class="bgbody"  style="">
    
    <div class = "nav">
    <?php 
        
        require "nav.php";
    ?>
    </div>

  
<div class = "bodydiv">
    <img class= "boardpic" src="pics/6.jpeg">  
    <img src="pics/logo.png">  
    <img class="eggbowlpic" src="pics/1.jpeg">
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): ?>
        <br><br>
		<?php else: 
			print <<<HTML
			<h2 class = "welcome">Welcome, {$_SESSION['name']}!</h2>
HTML;
			endif; ?>
            <p class = "intro_text"> Welcome to Foodify! Where we are taking part in reducing the waste of food. 
        We know our lives can get hectic and forget about about what we have in our disposal to make. 
        Instead of wasting money on gas and the unhealthy fast food that is out there lets see what you have 
        in your pantry and lets get cooking! </p>
    
    <div>
        <div class = "body">
            

            <form method="POST" id = "searchform">
        

                <div id="list-container">
                    <ul id = "ingredient_list">

                    </ul>
                </div>
                


                <div class = "additem">
                    <?php echo "$ing_search_err <br>"?>
                    <input id ="addingi" type = "text" placeholder="Add ingredient...">
                    <button type = "button" class = "addbtn" onclick="addingredient();">Add ingredient</button>
                    <button type = "button" class = "clearbtn" onclick = "clearlist()">Clear ingredient list</button>
                    <input class = "clearbtn" type = "submit" name = "sub_ing" value = "Search"><br>
                    
                    <!--<button type = "button" class = "search" onclick = "get_list_items();">Search</button> 
                    <a href = "favorites.php">Favorites</a>
                    -->
                </div>
            </form>

                <div class = "outbody"  style="margin: 25px;">
                    <?php
                        if($_POST['sub_ing'] != null){
                            if($ingdata != null){
                                print "<h1>We Found $rows Recipes that have the ingredients included</h1>";
                                print "<br>";
                                for($i=0;$i<$rows;$i++){
                                    print "<div id = 'boxRecipe' >";
                                    print "<h3>" . $ingdata[$i]['RecipeName'] . "</h3>";
                                    print "<p>". "CookTime: " . $ingdata[$i]['CookTime'] . " minutes</p>";
                                    print "<p>". "Category of food is: " . $ingdata[$i]['CategoryFood'] . "</p>";
                                    print "<p>". "Serving Size: " . $ingdata[$i]['ServingSize'] . "</p>";
                                    print "<p>". "Vegan: " . $ingdata[$i]['Vegan'] . "</p>";
                                    print "<form method='post'><input type='hidden' name='selectedID' value='". $ingdata[$i]['recipeid'] ."'><input class='clearbtn' type='submit' value='Open Recipe' name='selection'></form>";
                                    print "</div>";
                                }
                            } 
                        }
                    ?>
                </div>
            
        </div>
    </div>
                </div>

</body>

</html>