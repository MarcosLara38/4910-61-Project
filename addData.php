<?php
    require_once "connect.php";
    //die(print_r($_POST['ingredients'], true));
    //Need to figure out how to have the drop down box not be zero, so its easier to see when its checked
    //print("breakfast in checkboxes:". in_array('lunch', $_POST['cat_checkbox'])."<BR />");
    //die("<PRE>". print_r($_POST,true));
    $recname_valid = true; 
    $cat_valid = true;
    $cooktimedrop_valid = true;
    $servesizedrop_valid = true;
    $veganboolradio_valid = true;
    
    $addsteps_valid = true;
    $addingredients_valid = true;
    

    $recname_err = "";
    //$recipe_name = "";

    if(isset($_POST['submit'])){
        
        #Recipe name setting variable and boolean if isset 
        if(empty($_POST['recipe_name'])){
            $recname_valid = false;
            $recname_err = "Recipe Name is required";
        }else{
            
            $recipe_name =cleaninput($_POST['recipe_name']);
        }

    
        if (!empty($_POST['cat_checkbox'])) {
            $selected = "";
            // Counting number of checked checkboxes.
            $checked_count = count($_POST['cat_checkbox']);
            #echo "You have selected following ".$checked_count." option(s): <br/>";
            // Loop to store and display values of individual checked checkbox.
            $selected = implode(', ', $_POST['cat_checkbox']); //joins a string by the separator ', '
            //explode $ex: 'this,is,my,string' explode(',' $ex) => array('this', 'is', 'my', 'string');

            /*foreach ($_POST['cat_checkbox'] as $chk1) {
                $selected .= $chk1 . ", ";
                //substr($selected, 0, -1);                
                //$selected = rtrim($selected,',');
                #echo "<p>".$selected ."</p>";
            }*/
        }
        else {
            $cat_valid = false;
            $cat_err = "At least one food category is required";
        }


        # Cook time setting variable and boolean if isset/not empty 
        if(($_POST['cooktimedrop']) == 0){
            $cooktimedrop_valid = false;
            $cooktimedrop_err = "Need to have cook time ";
        }else{
            $cookTimeDropValue = $_POST['cooktimedrop'];
        }

       
        # Serving size setting variable and boolean if isset/not empty 
        if(($_POST['servingsizedrop']) == 0){
            $servingsizedrop_err = "Need to have serving size please";
            $servesizedrop_valid = false;
        }else{
            $drop_value = $_POST['servingsizedrop'];
        }

   
        # Vegan radio option, only one must be set

        if(empty($_POST['vegan_boolean'])){
            $veganboolradio_err = "Need to choose at least one choice";
            $veganboolradio_valid = false;

        }else{
            $veganboolradio_valid = true;
            $veganans = cleaninput($_POST['vegan_boolean']);
        }

        if(!$_POST['ingredients']){
            $ing_error = "no ingredient given <br> ";
            $addingredients_valid = false;
        }else{
            $ingredients = implode(', ', $_POST['ingredients']);
            $ingredients_list = "Ingredients given were: $ingredients <br>";
        }

        if(!$_POST['steps']){
            $steps_error = "no steps given <br> ";
            $addsteps_valid = false;
        }else{
            $steps = implode(', ', $_POST['steps']);
            $steps_list = "steps given for recipe were: $steps <br>";
        }

    }

    
    function cleaninput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = ucfirst($data);
        return $data;
    }



/*    
    echo "Recipe Name: $recipe_name<br>";
    echo "Category of food: $selected<br>";
    echo "Cook time Drop down: $cookTimeDropValue Mins <br> ";
    echo "Serving Size Drop down: $drop_value <br>";
    echo  "Is it vegan? $veganans<br>";
    
    echo "Recipe Name: $recname_valid <br>";
    echo "Category: $cat_valid<br>";
    echo "Cooktime: $cooktime_valid<br>";
    echo "Serving Size: $servsize_valid<br>";
    echo "Vegan bool: $veganboolradio_valid<br>";
    echo "Steps: $addsteps_valid<br>";
    echo "ingredients: $addingredients_valid <br>";


    //if Entires are valid then add data to database
    if($recname_valid && $cat_valid && $cooktimedrop_valid && $servesizedrop_valid
        && $veganboolradio_valid && $addsteps_valid && $addingredients_valid){
            echo "All entries are valid, preparing to enter into database<br>";
            
            $sql = "INSERT INTO rec_test (RecipeName, CategoryFood, CookTime, ServingSize, Vegan)
            VALUES ('$recipe_name','$selected','$cookTimeDropValue','$drop_value','$veganans')";

            if(mysqli_query($conn, $sql)){
                echo "New records created successfully";
            }
            else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }else{
            echo "All entries are not valid and therefore cannot proceed, please fix issues";
        }
*/
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
                <h1>Lets Enter Recipes!</h1>

                <!-- Recipe Name Field -->
                <p <?php if(!$recname_valid){ echo " style = 'color:Black'";} ?>> <?php echo $recname_err; ?> </p>
                <label class="rname" for = "recipe_name">Recipe Name</name>
                <input class = "recipe_name" type="text" name = "recipe_name" placeholder = "Texas Style Eggs" 
                <?php if(!$recname_valid){ echo " style = 'border: 4px solid black'";} 
                else{ echo "value = '$recipe_name' ";} ?> > 
                
            

                <br>
                <?php
                $is_lunch = false;
                $is_breakfast = false;
                $is_dinner = false;
                if (isset($_POST['cat_checkbox'])) {
                    $is_breakfast =  in_array('breakfast', $_POST['cat_checkbox']);
                    $is_lunch =  in_array('lunch', $_POST['cat_checkbox']);
                    $is_dinner =  in_array('dinner', $_POST['cat_checkbox']);
                }
                ?>


                <p <?php if(!$cat_valid){ echo " style = 'color:Black'";} ?>> <?php echo $cat_err; ?> </p>
                <input type="checkbox" name="cat_checkbox[]" value="breakfast" <?php if ($is_breakfast) echo "checked"; ?> ><label>Breakfeast</label>
                <input type="checkbox" name="cat_checkbox[]" value="lunch" <?php if ($is_lunch) echo "checked = 'checked'"; ?> ><label>Lunch</label>
                <input type="checkbox" name="cat_checkbox[]" value="dinner" <?php if ($is_dinner) echo "checked = 'checked'"; ?> ><label>Dinner</label>
               
                <br>

                <!-- Cooktime drop down testing -->
                <p <?php if(!$cooktimedrop_valid){ echo " style = 'color:Black'";} ?>> <?php echo "$cooktimedrop_err<br>" ?> </p>
                <label for="cooktimedrop"> How long does it take to make?</label>
                <select name ="cooktimedrop" id ="cookdropdown" required>
                    <option value = "0"> 0 </option>
                    <option <?php if ($cookTimeDropValue == '1') { ?>selected="true" <?php }; ?>value= "1">  Less Than 15Mins </option> 
                    <option <?php if ($cookTimeDropValue == '15') { ?>selected="true" <?php }; ?>value= "15"> 15 Mins </option> 
                    <option <?php if ($cookTimeDropValue == '30') { ?>selected="true" <?php }; ?>value= "30"> 30 Mins </option> 
                    <option <?php if ($cookTimeDropValue == '45') { ?>selected="true" <?php }; ?>value= "45"> 45 Mins </option> 
                    <option <?php if ($cookTimeDropValue == '60') { ?>selected="true" <?php }; ?>value= "60"> 1 Hour </option> 
                    <option <?php if ($cookTimeDropValue == '90') { ?>selected="true" <?php }; ?>value= "90"> 1.5 Hours </option> 
                    <option <?php if ($cookTimeDropValue == '120') { ?>selected="true" <?php }; ?>value= "120"> 2 Hours </option> 
                    <option <?php if ($cookTimeDropValue == '180') { ?>selected="true" <?php }; ?>value= "180"> 3 Hours</option> 
                    <option <?php if ($cookTimeDropValue == '240') { ?>selected="true" <?php }; ?>value= "240"> 4 Hours </option> 
                <select>
                <br><br>

                
                <!-- Serving Size drop down testing -->
                <p <?php if(!$servesizedrop_valid){ echo " style = 'color:Black'";} ?>> <?php echo "$servingsizedrop_err<br>" ?> </p>
                <label for="servingsizedrop" <?php if(!$servesizedrop_valid){ echo " style = 'border: 1px solid black'";}?>>How many will it feed?</label>
                <select name ="servingsizedrop" id ="servingdropdown" required>
                    <option value = "0"> 0 </option>
                    <option <?php if ($drop_value == '1') { ?>selected="true" <?php }; ?>value= "1"> 1 </option> 
                    <option <?php if ($drop_value == '2') { ?>selected="true" <?php }; ?>value= "2"> 2 </option> 
                    <option <?php if ($drop_value == '3') { ?>selected="true" <?php }; ?>value= "3"> 3 </option> 
                    <option <?php if ($drop_value == '4') { ?>selected="true" <?php }; ?>value= "4"> 4 </option> 
                    <option <?php if ($drop_value == '5') { ?>selected="true" <?php }; ?>value= "5"> 5 </option> 
                    <option <?php if ($drop_value == '6') { ?>selected="true" <?php }; ?>value= "6"> 6 </option> 
                    <option <?php if ($drop_value == '7') { ?>selected="true" <?php }; ?>value= "7"> 7 </option> 
                    <option <?php if ($drop_value == '8') { ?>selected="true" <?php }; ?>value= "8"> 8 </option> 
                <select>
                <br><br>



                <!-- Vegan? Radio Field -->
                <p <?php if(!$veganboolradio_valid){ echo " style = 'color:Black'";} ?>> <?php echo $veganboolradio_err; ?> </p>
                <div class = "radio">
                <label for="vegan">Is the recipe Vegan?</label>
                <label> Yes </label>
                <input class = "yes_rad" type="radio" name = "vegan_boolean" value="yes" 
                <?php if (isset($_POST['vegan_boolean']) && $_POST['vegan_boolean'] == 'yes') echo "checked = 'checked'"; ?>>
                <label> No </label>
                <input class = "no_rad" type="radio" name = "vegan_boolean" value="no" 
                <?php if (isset($_POST['vegan_boolean']) && $_POST['vegan_boolean'] == 'no') echo "checked = 'checked'"; ?>>
                </div>
                <br>

                



                    <!-- Adding Ingredients Fields(many) -->
                    <div class = "addIngredient">
                        <p> Syntax = Amount ingredient</p>
                        <p> Example = 3 cups of Milk </p>
                        <p <?php if(!$addingredients_valid){ echo " style = 'color:Black'";} ?>> <?php echo $ing_error; ?> </p>
                        <label for = "ingredients">Ingredients: </label>
                        <input id ="addDataInput" type = "text" name = "ingredients" placeholder="2 eggs">
                        <button type = "button" class = "addDatabtn" onclick = "addDataIng();" >Add ingredient</button><br>
                        <label for = "Quanty">Qty: </label>
                        <input id ="addQtyInput" type = "text" name = "qty" placeholder="quantity">
                        
                        <!--<button type = "button" class = "clearbtn" onclick = "clearlist()">Clear ingredient list</button>
                        <button type = "button" class = "search" onclick = "get_list_items();">Search</button> -->

                        <div id="addDataList-container">
                            <ul id = "addDataIngredient_list">
                            
                            </ul>
                        </div>

                        <?php echo $ingredients_list ?>

                    </div>
                <br>

                <!-- Adding Steps to Cook Field(many) -->
                <div class = "addStep">

                        <p <?php if(!$addsteps_valid){ echo " style = 'color:Black'";} ?>> <?php echo $steps_error; ?> </p>
                        <label for = "add_steps">Steps:  </label>
                        <input id = "addSteps" type = "text" name = "add_steps" placeholder = "Add Salt to Eggs">
                        <button type = "button" class = "addStepbtn" onclick = "addStep();" >Add Step</button>

                        <div id="addStepList-container">
                            <ul id = "addStep_list">
                            
                            </ul>
                        </div>

                        <?php echo $steps_list ?>

                </div>                

                <br>

                <input class = "add_submit" type = "submit" name = "submit" value = "Submit">        
                </form> 

        </div>
    </div>

</body>
</html>