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


                
            <div style="margin-top: 100px;">
                <?php
                    if($_POST['sub_ing'] != null){
                        if($ingdata != null){
                            print "<h1>We Found $rows Recipes that have the ingredients included</h1>";
                            for($i=0;$i<$rows;$i++){
                                print "<div id = singlerecipe>";
                                print "<p id = boxName>". $ingdata[$i]['recipeid'] . " <a href = recipeparse.php > " . $ingdata[$i]['RecipeName'] . "</a></p>";
                                print "<p>". "CookTime: " . $ingdata[$i]['CookTime'] . " minutes</p>";
                                print "<p>". "Category of food is: " . $ingdata[$i]['CategoryFood'] . "</p>";
                                print "<p>". "Serving Size: " . $ingdata[$i]['ServingSize'] . "</p><br>";
                                print "</div>";
                            }
                        } else {print "<h1>No Results found for $string </h1>";}
                    }
                ?>
            </div>
            
        </div>
    </div>

</body>
</html>