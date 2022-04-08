<?php

    $recname_valid = true; 
    $cat_valid = true;
    $cooktime_valid = true;
    $veganboolradio_valid = true;
    $servsize_valid = true;
    $addnotes_valid = true;
    $ingredients_valid = true;

    if(isset($_POST['submit'])){

        if(empty($_POST['recipe_name'])){
            $recname_valid = false;
            $recname_err = "Recipe Name is required";
        }else{
            $recipe_name =cleaninput($_POST['recipe_name']);
        }

        //Change to radio between: Breakfast, Lunch, dinner. Maybe 2 categories
        if(empty($_POST['category'])){
            $cat_valid = false;
            $cat_err = "Food category is required";
        }else{
            $category =cleaninput($_POST['category']);
        }

        if(empty($_POST['cook_time'])){
            $cooktime_valid = false;
            $cooktime_err = "Cook time is required";
        }else{
            $cook_time =cleaninput($_POST['cook_time']);
        }
        
  

        if(empty($_POST['vegan_radio'])){
            $veganboolradio_valid = false;
            $veganboolradio_err = "Need to choose at least one choice";
        }else{
            //fix radio choices
        }

        if(empty($_POST['serving_size'])){
            $servsize_valid = false;
            $servsize_err = "Need to have serving size please";
        }else{
            $serving_size = cleaninput($_POST['serving_size']);
        }

        if(empty($_POST['add_notes'])){
            $add_notesmsg = "No additional Informatio needed";
        }else{
            $add_notes = cleaninput($_POST['add_notes']);
        }

        //ingredients, need to do differently 
        

    }

    
    function cleaninput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //escape user inputs for security
    //$recipe_name = mysqli_real_escape_string($link,$_REQUEST['recipe_name']);


    //attempt to insert the query execution
    //need to try the radio button rather than the text yes or no
    //$sql = "INSERT INTO recipes (recipe_name,cook_time,vegan,serving_size,add_notes,ingredients)
    //VALUES ('$recipe_name', '$cook_time', '$vegan_bool', '$serving_size', '$add_notes', '$ingredients')"
    //if(mysqli_query($link, $sql)){
    //    echo "Added records successfully!";
    //}else{
    //    echo "ERROR: Could not enter Records $sql. " . mysqli_error($link);
    //}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="final.js"></script>
    <title>Foodify</title>
    <style>
      label {
        width: 110px;
        align: center;
        }
      input {
        padding: 5px 10px;
      }
    </style>
</head>
<body>
    <div class = "nav">
    <?php 
        require_once "connect.php";
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

            <div class="adddata">
                <form method="POST" id="signin">
                <h2>Entering Data in Database</h2>
                <label for = "recipe_name">Recipe Name</name>
                <input class = "recipe_name" type="text" name = "recipe_name"/>
                <br>

                <label for = "category">Category:Breakfeast?Lunch?Dinner? OR 2?</label>
                <input class = "category" type = "text" name = "category"/>
                <br>

                <label for = "cook_time">Cook Time: </label>
                <input class = "cook_time" type="text" name = "cook_time"/>
                <br>

                <!--<label for = "vegan">Is it vegan? Yes/No: </label>
                <input class = "vegan" type = "text" name = "vegan"/> -->
                <label for="vegan">Is the recipe Vegan?</label>
                <input type="radio" name = "vegan_boolean" value="yes">Yes
                <input type="radio" name = "vegam_boolean" value="no" >No
                <br>

                <label for = "serving_size">Serving Size:How many will it feed?: </label>
                <input class = "serving_size" type="text" name = "serving_size"/>
                <br>

                <label for = "add_notes">Additional Notes:  </label>
                <input class = "add_notes" type = "text" name = "add_notes"/>
                <br>

                <label for = "ingredients">Ingredients: </label>
                <input class = "ingredients" type="text" name = "ingredients"/>
                <br>

                <input class = "" type = "submit" value="Add to Database"/>
                </form>
            </div>



        </div>
    </div>

</body>
</html>