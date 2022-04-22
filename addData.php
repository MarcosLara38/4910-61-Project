<?php

    $recname_valid = true; 
    $cat_valid = true;
    $cooktime_valid = true;
    $servsize_valid = true;
    $veganboolradio_valid = true;
    $addsteps_valid = true;
    $addingredients_valid = true;
    

    $recname_err = "";
    $recipe_name = "";

    if(isset($_POST['submit'])){

        #Recipe name setting variable and boolean if isset 
        if(empty($_POST['recipe_name'])){
            $recname_valid = false;
            $recname_err = "Recipe Name is required";
        }else{
            $recipe_name =cleaninput($_POST['recipe_name']);
        }
        
/*
        # checkbox, at least one must be pressed.
        # come back to this 
        if(empty($_POST['category'])){
            $cat_valid = false;
            $cat_err = "Food category is required";
        }else{
            $dataArray = array();
            $i = 0;
            foreach($_POST['category'] as $value){
                $dataArray[i] = $value;
            }
            #$category =cleaninput($_POST['category']);
        }
*/

    
        if (!empty($_POST['cat_checkbox'])) {
            // Counting number of checked checkboxes.
            $checked_count = count($_POST['cat_checkbox']);
            #echo "You have selected following ".$checked_count." option(s): <br/>";
            // Loop to store and display values of individual checked checkbox.
            foreach ($_POST['cat_checkbox'] as $selected) {
                #echo "<p>".$selected ."</p>";
            }
        }
        else {
            $cat_valid = false;
            $cat_err = "At least one food category is required";
        }
        




        # Cook time setting variable and boolean if isset/not empty 
        if(empty($_POST['cook_time'])){
            $cooktime_valid = false;
            $cooktime_err = "Cook time is required";
        }else{
            $cook_time =cleaninput($_POST['cook_time']);
        }
       
        # Serving size setting variable and boolean if isset/not empty 
        if(empty($_POST['serving_size'])){
            $servsize_valid = false;
            $servsize_err = "Need to have serving size please";
        }else{
            $serving_size = cleaninput($_POST['serving_size']);
        }
   
        # Vegan radio option, only one must be set

        if(empty($_POST['vegan_radio'])){
            $veganboolradio_valid = false;
            $veganboolradio_err = "Need to choose at least one choice";
        }else{
            $veganans = cleaninput($_POST['vegan_boolean']);
        }
/*
         # Add ingredients setting variable/arrays and boolean if isset/not empty
         # Come back to this to fix arrays/ how itll work ############################################
         if(empty($_POST['ingredients'])){
            $add_notesmsg = "No additional Informatio needed";
        }else{
            $add_ingredients = cleaninput($_POST['ingredients']);
        }

        # Add steps setting variable/arrays and boolean if isset/not empty
        # Come back to this to fix arrays/ how itll work ############################################
        if(empty($_POST['add_steps'])){
            $add_stepsmsg = "No additional Informatio needed";
        }else{
            $add_steps = cleaninput($_POST['add_steps']);
        }

        //ingredients, need to do differently 
        
*/
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
    //$sql = "INSERT INTO recipes (recipe_name,cook_time,vegan,serving_size,add_steps,ingredients)
    //VALUES ('$recipe_name', '$cook_time', '$vegan_bool', '$serving_size', '$add_steps', '$ingredients')"
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
    <script src="addData.js"></script>
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
                <form method="POST" id="signin" >
                <h1>Entering Recipes!</h1>

                <!-- Recipe Name Field -->
                <label class="rname" for = "recipe_name">Recipe Name</name>
                <input class = "recipe_name" type="text" name = "recipe_name" placeholder = "Texas Style Eggs" 
                <?php if(!$recname_valid){ echo " style = 'border: 4px solid black'";} 
                else{ echo "value = '$recipe_name' ";} ?> > 
                <?php echo $recname_err; ?>
                
            

                <br>

                <!--Radio check box for Break/Lunch/Dinner 
                
                <input type = "checkbox" name = "cat_checkbox" value = "breakfeast"
                <?php if (isset($_POST['cat_checkbox[]']) && $_POST['cat_checkbox[]'] == 'breakfeast') echo "checked = 'checked'"; ?> >
                <label for = "breakfeast">Breakfeast</label>
                <input type = "checkbox" name = "cat_checkbox[]" value = "lunch" 
                <?php if (isset($_POST['cat_checkbox[]']) && $_POST['cat_checkbox[]'] == 'lunch') echo "checked = 'checked'"; ?> >
                <label for = "lunch">lunch</label>
                <input type = "checkbox" name = "cat_checkbox[]" value = "dinner" 
                <?php if (isset($_POST['cat_checkbox[]']) && $_POST['cat_checkbox[]'] == 'dinner') echo "checked = 'checked'"; ?> >
                <label for = "dinner">Dinner</label>-->

                <p <?php if(!$cat_valid){ echo " style = 'color:Black'";} ?>> <?php echo $cat_err; ?> </p>
                <input type="checkbox" name="cat_checkbox[]" value="breakfeast"><label>Breakfeast</label>
                <input type="checkbox" name="cat_checkbox[]" value="lunch"><label>Lunch</label>
                <input type="checkbox" name="cat_checkbox[]" value="dinner"><label>Dinner</label>
               
                <br>

                <!-- Cooktime Input Field -->
                <label class = "ctime_label" for = "cook_time">Cook Time: </label>
                <input class = "cook_time" type="text" name = "cook_time" placeholder = "2 hrs" <?php if(!$cooktime_valid){ echo " style = 'border: 4px solid black'";} else{ echo "value = '$cook_time' ";} ?> > 
                <?php echo $cooktime_err; ?>
                <br>

                <!-- Serving Size Input Field -->
                <label for = "serving_size">Serving Size:How many will it feed?: </label>
                <input class = "serving_size" type="text" name = "serving_size" placeholder = "1 Person"<?php if(!$servsize_valid){ echo " style = 'border: 4px solid black'";} else{ echo "value = '$serving_size' ";} ?> > 
                <?php echo $servsize_err; ?>
                <br>

                <!-- Vegan? Radio Field -->
                <div class = "radio">
                <label for="vegan">Is the recipe Vegan?</label>
                <label> Yes </label>
                <input class = "yes_rad" type="radio" name = "vegan_boolean" value="yes" 
                <?php if (isset($_POST['vegan_boolean']) && $_POST['vegan_boolean'] == 'yes') echo "checked = 'checked'"; ?>>
                <label> No </label>
                <input class = "no_rad" type="radio" name = "vegan_boolean" value="no" 
                <?php if (isset($_POST['vegan_boolean']) && $_POST['vegan_boolean'] == 'no') echo "checked = 'checked'"; ?>>
                <p <?php if(!$veganboolradio_valid){ echo " style = 'color:Black'";} ?>> <?php echo $veganboolradio_err; ?> </p>
                </div>
                <br>

                



                    <!-- Adding Ingredients Fields(many) -->
                    <div class = "addIngredient">
                        <p> Syntax = Amount ingredient</p>
                        <p> Example = 3 cups of Milk </p>
                        <label for = "ingredients">Ingredients: </label>
                        <input id ="addDataInput" type = "text" name = "ingredients" placeholder="2 eggs">
                        <button type = "button" class = "addDatabtn" onclick = "addDataIng();" >Add ingredient</button>
                        <!--<button type = "button" class = "clearbtn" onclick = "clearlist()">Clear ingredient list</button>
                        <button type = "button" class = "search" onclick = "get_list_items();">Search</button> -->

                        <div id="addDataList-container">
                            <ul id = "addDataIngredient_list">
                            
                            </ul>
                        </div>
                    </div>
                <br>

                <!-- Adding Steps to Cook Field(many) -->
                <div class = "addStep">

                        <label for = "add_steps">Steps:  </label>
                        <input id = "addSteps" type = "text" name = "add_steps" placeholder = "Add Salt to Eggs">
                        <button type = "button" class = "addStepbtn" onclick = "addStep();" >Add Step</button>
                        <!--<button type = "button" class = "clearbtn" onclick = "clearlist()">Clear ingredient list</button>
                        <button type = "button" class = "search" onclick = "get_list_items();">Search</button> -->

                        <div id="addStepList-container">
                            <ul id = "addStep_list">
                            
                            </ul>
                        </div>
                </div>                

                <br>

                <input class = "add_submit" type = "submit" name = "submit" value = "Submit">        
                </form> 

        </div>
    </div>

</body>
</html>