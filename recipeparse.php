<!DOCTYPE html>
<?php 
    require_once "connect.php";

    $stmt = $conn->prepare("SELECT * FROM recipes WHERE recipeid = ?");

    $stmt->bind_param("i", $_SESSION['selectedRecipeID']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        var_dump($data);
        // header("Location: home.php");
    }
    $result->free();

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

            <div style="margin:25px;">
                <?php
                    if($data != null){
                        print "<div id = 'boxRecipe'>";
                        print "<p id = boxName>" . $data['RecipeName'] . "</p>";
                        print "<p>". "CookTime: " . $data['CookTime'] . " minutes</p>";
                        print "<p>". "Category of food is: " . $data['CategoryFood'] . "</p>";
                        print "<p>". "Serving Size: " . $data['ServingSize'] . "</p><br>";
                        print "</div>";
                    } else {print "<h1>ERROR</h1>";}
                ?>
            </div>
            
        </div>
    </div>

</body>
</html>