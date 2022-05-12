<?php

    /* DB TABLES


    recipes (recipeid, RecipeName, CategoryFood, CookTime, ServingSize, Vegan)
    +--------------+------------------+------+-----+---------+----------------+
    | Field        | Type             | Null | Key | Default | Extra          |
    +--------------+------------------+------+-----+---------+----------------+
    | recipeid     | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | RecipeName   | varchar(255)     | YES  |     | NULL    |                |
    | CategoryFood | varchar(255)     | YES  |     | NULL    |                |
    | CookTime     | varchar(255)     | NO   |     | NULL    |                |
    | ServingSize  | int(11)          | NO   |     | NULL    |                |
    | Vegan        | varchar(15)      | NO   |     | NULL    |                |
    +--------------+------------------+------+-----+---------+----------------+

    steps (recipeid, recipestep)
    +------------+------------------+------+-----+---------+-------+
    | Field      | Type             | Null | Key | Default | Extra |
    +------------+------------------+------+-----+---------+-------+
    | recipeid   | int(10) unsigned | NO   | MUL | NULL    |       |
    | recipestep | varchar(2000)    | NO   |     | NULL    |       |
    +------------+------------------+------+-----+---------+-------+

    ingredients (ingid, recipeid, ingredients, quantity)
    +-------------+------------------+------+-----+---------+----------------+
    | Field       | Type             | Null | Key | Default | Extra          |
    +-------------+------------------+------+-----+---------+----------------+
    | ingid       | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | recipeid    | int(10) unsigned | NO   | MUL | NULL    |                |
    | ingredients | varchar(100)     | YES  |     | NULL    |                |
    | quantity    | varchar(100)     | YES  |     | NULL    |                |
    +-------------+------------------+------+-----+---------+----------------+

    ingredientlist (recipeid, list)
    +----------+------------------+------+-----+---------+-------+
    | Field    | Type             | Null | Key | Default | Extra |
    +----------+------------------+------+-----+---------+-------+
    | recipeid | int(10) unsigned | NO   | MUL | NULL    |       |
    | list     | varchar(500)     | YES  |     | NULL    |       |
    +----------+------------------+------+-----+---------+-------+

    favorites (fid, userid, recipeid)
    +----------+------------------+------+-----+---------+----------------+
    | Field    | Type             | Null | Key | Default | Extra          |
    +----------+------------------+------+-----+---------+----------------+
    | fid      | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | userid   | int(10)          | YES  |     | NULL    |                |
    | recipeid | int(10)          | YES  |     | NULL    |                |
    +----------+------------------+------+-----+---------+----------------+

    users (id, fname, lname, email, password)
    +----------+------------------+------+-----+---------+----------------+
    | Field    | Type             | Null | Key | Default | Extra          |
    +----------+------------------+------+-----+---------+----------------+
    | id       | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | fname    | varchar(50)      | YES  |     | NULL    |                |
    | lname    | varchar(50)      | YES  |     | NULL    |                |
    | email    | varchar(50)      | YES  |     | NULL    |                |
    | password | varchar(50)      | YES  |     | NULL    |                |
    +----------+------------------+------+-----+---------+----------------+
    */




    $file = 'Recipe1.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data, TRUE);
    $reccount = count($obj['Recipes']);


    if(isset($_POST['test'])) {
        //populateTables();
        $file = 'Recipe1.json'; 
        $data = file_get_contents($file); 
        $obj = json_decode($data, TRUE);
        $reccount = count($obj['Recipes']);
        
        for ($a=0;$a<$reccount;$a++){
            $recipeName=""; 
            $ingredientList=""; 
            $ingredient="";
            $ingqty=""; 
            $recipeStep="";
            $recipeid= "";
            $ingcount = count($obj['Recipes'][$a]['Ingredients']);
            $prpcount = count($obj['Recipes'][$a]['Preparation']);
            $catFood = array("Breakfast","Lunch","Dinner");
            $cookTime = array(0,15,30,45,60,90,120,180,240);
            $randCook = rand(0,8);
            $vegan = "no";
            $servSize = rand(1,7);
            //Recipe Name
            $recipeName = $obj['Recipes'][$a]['name'];
            
            print "<br>RECIPE NAME: $recipeName <br>";

            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            //                      INSERT INTO RECIPES
            if ($a % 8 == 0 && $a != 0){
                $vegan = "yes";
            }
        
            $r = rand(0,2);
            $catResult = $catFood[$r];
            if($catResult != $catFood[2]){
                $catResult .= ", " . $catFood[$r+1];
            }

            $recipestmt = $conn->prepare("INSERT INTO recipes (RecipeName, CategoryFood, CookTime, ServingSize, Vegan) VALUES (?, ?, ?, ?, ?)");
            $recipestmt->bind_param("sssis", $recipeName, $catResult, $cookTime[$randCook], $servSize, $vegan);
            if ($recipestmt->execute()) {
                print "$recipeName, $catResult, $cookTime[$randCook], $servSize, $vegan were inserted into recipes table";
            } else {
                var_dump($conn->error);
                var_dump($recipestmt);
            }

            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////

            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            //                      SELECT recipeid FROM RECIPES


            $stmt = $conn->prepare("SELECT recipeid FROM recipes WHERE RecipeName = ?");
                $stmt->bind_param("s", $recipeName);
                $stmt->execute();
                $output = $stmt->get_result();
                $data = $output->fetch_assoc();
                $recipeid = $data["recipeid"];
            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////


            for ($i=0;$i<$ingcount;$i++){

                $ingredient = $obj['Recipes'][$a]['Ingredients'][$i]['Name'];
                $ingqty = $obj['Recipes'][$a]['Ingredients'][$i]['Quantity'];
                $ingredientList .= $obj['Recipes'][$a]['Ingredients'][$i]['Name'];
                $ingredientList .= ", ";
                /////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////
                //                      INSERT INTO ingredients
                
                if($ingqty == null) {
                    print "INGREDIENT: $ingredient <br>";
                    $stmt = $conn->prepare("INSERT INTO ingredients ( recipeid, ingredients ) VALUES (?, ?)");
                    $stmt->bind_param("is", $recipeid, $ingredient);
                    if ($stmt->execute()) {
                        print "$recipeid, $ingredient inserted into ingredients table";
                    } else {
                        var_dump($conn->error);
                        var_dump($stmt);
                    }

                } else {
                    print "INGREDIENT: $ingredient | QUANTITY: $ingqty <br>";
                    $stmt = $conn->prepare("INSERT INTO ingredients ( recipeid, ingredients, quantity ) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $recipeid, $ingredient, $ingqty);
                    if ($stmt->execute()) {
                        print "$recipeid, $ingredient, $ingqty inserted into ingredients table";
                    } else {
                        var_dump($conn->error);
                        var_dump($stmt);
                    }
                }
                print "<br>";
                /////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////
            }

            print "<br>";
            // //remove extra comma from ingredientList
            // $ingredientList = substr($ingredientList, 0, -2);
            // print "INGREDIENT LIST: $ingredientList<br><br>";

            // /////////////////////////////////////////////////////////////////////
            // /////////////////////////////////////////////////////////////////////
            // //                      INSERT INTO ingredientlist

            // $stmt = $conn->prepare("INSERT INTO ingredientlist ( recipeid, list) VALUES (?, ?)");
            // $stmt->bind_param("is", $recipeid, $ingredientList);
            // if ($stmt->execute()) {
            //     print "$recipeid, $ingredientList inserted into ingredientlist table";
            // } else {
            //     var_dump($conn->error);
            //     var_dump($stmt);
            // }
            
            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            for ($stepid=0;$stepid<$prpcount;$stepid++){
                
                // $stepid2 = $stepid + 1;
                $recipeStep = $obj['Recipes'][$a]['Preparation'][$stepid]['Step'];
                // $splitstep = split($recipeStep);
                //     if (count($splitstep) < 2){
                //     $time = null;
                //     $step = $splitstep[0];
                // } else {
                //     $time = $splitstep[0];
                //     $step = $splitstep[1] . $splitstep[2];
                // }

                // print "RECIPE STEP $stepid2: $time <br> $step <br><br>";
                
            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            //                      INSERT INTO steps

            $stmt = $conn->prepare("INSERT INTO steps ( recipeid, recipestep) VALUES (?, ?)");
            $stmt->bind_param("is", $recipeid, $recipeStep);
            if ($stmt->execute()) {
                print "$recipeid, $recipeStep inserted into steps table<br>";
            } else {
                var_dump($conn->error);
                var_dump($stmt);
            }
            
            /////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            }
        }
        
    }


    function split ($str) {
        $pattern = "/[\n]/i";
        $catResult = preg_split($pattern, $str);
        return $catResult;
    }

?>