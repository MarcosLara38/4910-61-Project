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
    <title>Foodify</title>
</head>
<body >
    <div class = "nav">
    <?php 
        
        require "nav.php";
    ?>
    </div>

    <img src="pics/logo.png"><br><br><br>  
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): ?>
			<h1>Welcome, Guest</h1>
			
		<?php else: 
			print <<<HTML
			<h1>Welcome, {$_SESSION['name']}!</h1>
HTML;
			endif; ?>
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

            
                
            
            
        </div>
    </div>

</body>
</html>