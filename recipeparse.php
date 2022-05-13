<!DOCTYPE html>
<?php 
    require_once "connect.php";
    require_once "dbFunc.php";

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
			<h1>Welcome, Guest</h1>
			
		<?php else: 
			print <<<HTML
			<h1>Welcome, {$_SESSION['name']}!</h1>
HTML;
			endif; ?>
    <div>
        <div class = "body">
            
            <div style="margin:25px;">
                <?php
                    if($data1 != null && $data2 != null){
                        print "<div id = 'boxRecipe'>";
                        print "<h3 id = boxName>" . $data1[0]['RecipeName'] . "</h3><br>";
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
                    } else {print "<h1>ERROR</h1>";}
                ?>
            </div>
            
        </div>
    </div>

</body>
</html>