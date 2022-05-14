<!DOCTYPE html>
<?php 
    require_once "connect.php";
    require_once "dbFunc.php";
    $favoritesend = false;

    $stmt = $conn->prepare("SELECT DISTINCT * FROM recipes INNER JOIN steps ON steps.recipeid = recipes.recipeid WHERE recipes.recipeid = ?");
    $stmt->bind_param("i", $_SESSION['selectedRecipeID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data1 = $result->fetch_all(MYSQLI_ASSOC);
        $rows = count($data1);
    }
    $result->free();

    $stmt = $conn->prepare("SELECT DISTINCT * FROM recipes INNER JOIN ingredients ON ingredients.recipeid = recipes.recipeid WHERE recipes.recipeid = ?");
    $stmt->bind_param("i", $_SESSION['selectedRecipeID']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data2 = $result->fetch_all(MYSQLI_ASSOC);
        $rows2 = count($data2);
    }

    if(isset($_POST['favoriteSelection']) && isset($_SESSION['logged_in'])) {
        $stmt3 = $conn->prepare("INSERT INTO favorites (userid, recipeid ) VALUES (?, ?)");
        $stmt3->bind_param("ii", $_SESSION['userid'], $_SESSION['selectedRecipeID']);
        if ($stmt3->execute()){
            $favoritesend = true;
        }
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
</head>
<body class='bgbody' >
    <div class = "nav">
    <?php 
        
        require "nav.php";
    ?>
    </div>

    <img src="pics/logo.png"><br><br><br>  
    <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true): ?>
			<br>
            <h4> Please sign in to add this recipe to your favorites </h4>
            <a href='signin.php'>Sign in</a>
			
		<?php else: 
			print <<<HTML
			<h2>Welcome, {$_SESSION['name']}!</h2>
HTML;
			endif; ?>
    <div>
        <div class = "body">
            
            <div style="margin:25px;">
                <?php
                    if($data1 != null && $data2 != null && $favoritesend == false){
                        print "<div id = 'boxRecipe'>";
                        print "<h3 id = boxName>" . $data1[0]['RecipeName'] . "</h3>";
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                            print "<form method='post'><input class='clearbtn' type='submit' value='Add to Favorites' name='favoriteSelection'></form><br>";
                        }
                        print "<p>". "CookTime: " . $data1[0]['CookTime'] . " minutes</p>";
                        print "<p>". "Category of food is: " . $data1[0]['CategoryFood'] . "</p>";
                        print "<p>". "Serving Size: " . $data1[0]['ServingSize'] . "</p>";
                        print "<p>". "Vegan: " . $data1[0]['Vegan'] . "</p><br>";

                        print "<h3>Ingredients</h3>";
                        for($i=0;$i<$rows2;$i++){
                            print "<p>". $data2[$i]['quantity'] . " " . $data2[$i]['ingredients'] . "</p>";
                        }
                        print "<br>";
                        print "<h3>Steps</h3>";
                        for($i=0;$i<$rows;$i++){
                            print "<p>". $data1[$i]['recipestep'] . "</p><br>";
                        }
                        print "</div>";
                    } if ($data1 == null && $favoritesend == false && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {print "<h1>OOPS SOMETHING WENT WRONG</h1>";}
                    if ($favoritesend == true){
                            print "<h1>SUCCESS ADDDING FAVORITE RECIPE</h1><br>";
                            print "<h3><a href='home.php'>Return to the Homepage</a></h3>
                            <br>
                            <h3><a href='search.php'>Search for another recipe</a></h3>
                            <br>
                            <h3><a href='favorites.php'>Go to favorites</a></h3>";
                        }
                ?>
                
            </div>
            
        </div>
    </div>

</body>
</html>