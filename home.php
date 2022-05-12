<!DOCTYPE html>
<?php 
    require_once "connect.php";
    
    if(isset($_POST['sub_ing'])){

        if(!$_POST['ing_search']){
            $ing_search_err = "Need ingredient(s) for search";
        }else{
            $ing_search = implode('. ', $_POST['ing_search']);
            $ing_search_list = "Ingredient(s) to search: $ing_search <br>";

            for($i = 0; $i < count($_POST['ing_search']); $i++){
                $ings[$i] = $_POST['ing_search'][$i];
                //$ings = mysqli_real_escape_string( $conn,$ings);
               
                
               // $sql = "SELECT * FROM ingredients WHERE ingredients = '$ings' and recipeid=";
                //if($sql == 1){
                //    $data = $result->fetch_assoc
                //}
                echo "Ingredients = $ings<br>";
            }
           echo  $sql = 'SELECT * FROM ingredients WHERE ingredients IN ("' . implode('", "', $ings) . '")';
            //echo "Ingredients Out of For loop = $ings<br>";
        }


    }

    //Grab the array of ingredients entred by the user
    //compare the ingredients entered by user and compare to the ingredients in the table
    //if the ingredient is the same as table ingredient, return the recipeid(do i need an array?)
    //then use the recipeid to get the recipe that correlates with the ingredients they have

    //if there are no options, then offer the user recipes that can be 
    // +++made with some of the recipes they have on hand
    //ie: they enter eggs, flour, sugar,
    //the computer returns: sorry no match to recipes but you can make cake if you have other recipes





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
                    <input class = "sub_ing" type = "submit" name = "sub_ing" value = "Search"><br>
                    <?php echo "$ing_search_list <br>"?>
                    <!--<button type = "button" class = "search" onclick = "get_list_items();">Search</button> -->
                </div>

            </form>

        </div>
    </div>

</body>
</html>