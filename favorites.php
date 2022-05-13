<!DOCTYPE html>

<?php
    $stmtrun = false;
    require_once "connect.php";
    $stmt = $conn->prepare("SELECT DISTINCT * FROM recipes INNER JOIN favorites ON recipes.recipeid = favorites.recipeid AND userid = ? GROUP by recipes.recipeid");
    $stmt->bind_param("i", $_SESSION['userid']);
    if($stmt->execute()){
        $result = $stmt->get_result();
        $favRecipes = $result->fetch_all(MYSQLI_ASSOC);
        $rows = count($favRecipes);
        $stmtrun = true;
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
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
<body class="bgbody" >
    <div class = "nav">
    <?php 
        
        require "nav.php";
    ?>
    </div>

    <img src="pics/logo.png"><br><br><br>  
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): header("Location: signin.php");?>	
		<?php else: 
			print <<<HTML
			<h2>Welcome, {$_SESSION['name']}!</h2>
HTML;
			endif; ?>
    <div>
        <div class = "outbody">
            <?php
                if($stmtrun){
                    if($favRecipes != null){
                        print "<h3>We Found $rows Recipes in your Favorites List:</h3>";
                        print "<br>";
                        for($i=0;$i<$rows;$i++){
                            print "<div id = 'boxRecipe' >";
                            print "<h3>" . $favRecipes[$i]['RecipeName'] . "</h3>";
                            print "<p>". "CookTime: " . $favRecipes[$i]['CookTime'] . " minutes</p>";
                            print "<p>". "Category of food is: " . $favRecipes[$i]['CategoryFood'] . "</p>";
                            print "<p>". "Serving Size: " . $favRecipes[$i]['ServingSize'] . "</p>";
                            print "<form method='post'><input type='hidden' name='selectedID' value='". $favRecipes[$i]['recipeid'] ."'><input class='clearbtn' type='submit' value='Open Recipe' name='selection'></form>";
                            print "</div>";
                        }
                    } 
                }
            ?>
        </div>
    </div>
</body>
</html>