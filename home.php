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

<img class= "boardpic" src="pics/6.jpeg">    
<div class = "bodydiv">
    <img src="pics/logo.png">  
    <img class="eggbowlpic" src="pics/1.jpeg">
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): ?>
			<h1>Welcome, Guest</h1>
			
		<?php else: 
			print <<<HTML
			<h1 class = "welcome">Welcome, {$_SESSION['name']}!</h1>
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
<<<<<<< HEAD
                
            <div style="margin-top: 100px;">
                <?php
                    if($_POST['sub_ing'] != null){
                        if($ingdata != null){
                            print "<h1>We Found $rows Recipes that have the ingredients included</h1>";
                            echo "<div id = parent>";
                            for($i=0;$i<$rows;$i++){
                                 
                                    print "<div id = boxRecipe>";
                                    print "<p>". $ingdata[$i]['recipeid'] . " <a href = recipeparse.php > " . $ingdata[$i]['RecipeName'] . "</a></p>";
                                    print "<p>". "CookTime: " . $ingdata[$i]['CookTime'] . " minutes</p>";
                                    print "<p>". "Category of food is: " . $ingdata[$i]['CategoryFood'] . "</p>";
                                    print "<p>". "Serving Size: " . $ingdata[$i]['ServingSize'] . "</p><br>";
                                    print "</div>";
                                
                            }
                        } echo "<div>";
                        // else {print "<h1>No Results found for $string </h1>";}
                    }
                ?>
            </div>
=======

                <div style="margin: 25px;">
                    <?php
                        if($_POST['sub_ing'] != null){
                            if($ingdata != null){
                                print "<h1>We Found $rows Recipes that have the ingredients included</h1>";
                                for($i=0;$i<$rows;$i++){
                                    print "<form id = 'boxRecipe' method='post'>";
                                    print "<input type='hidden' name='selectedID' value='". $ingdata[$i]['recipeid'] ."'><input class='clearbtn' type='submit' value='Select' name='selection'>";
                                    print "<p>" . $ingdata[$i]['RecipeName'] . "</p>";
                                    print "<p>". "CookTime: " . $ingdata[$i]['CookTime'] . " minutes</p>";
                                    print "<p>". "Category of food is: " . $ingdata[$i]['CategoryFood'] . "</p>";
                                    print "<p>". "Serving Size: " . $ingdata[$i]['ServingSize'] . "</p>";
                                    print "</form><br>";
                                }
                            } 
                            // else {print "<h1>No Results found for $string </h1>";}
                        }
                    ?>
                </div>
>>>>>>> a403a3080402e38f45fa2a9051073861a330f8c0
            
        </div>
    </div>
                </div>

</body>

</html>