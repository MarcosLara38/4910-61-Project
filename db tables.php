<?php

/* DB TABLES


recipes
+----------+------------------+------+-----+---------+----------------+
| Field    | Type             | Null | Key | Default | Extra          |
+----------+------------------+------+-----+---------+----------------+
| recipeid | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| rname    | varchar(50)      | YES  |     | NULL    |                |
| rsteps   | varchar(5)       | YES  |     | NULL    |                |
+----------+------------------+------+-----+---------+----------------+

steps
+------------+------------------+------+-----+---------+-------+
| Field      | Type             | Null | Key | Default | Extra |
+------------+------------------+------+-----+---------+-------+
| recipeid   | int(10) unsigned | NO   | MUL | NULL    |       |
| stepid     | int(5) unsigned  | NO   |     | NULL    |       |
| stepTime   | varchar(10)      | YES  |     | NULL    |       |
| recipestep | varchar(2000)    | NO   |     | NULL    |       |
+------------+------------------+------+-----+---------+-------+

ingredients
+----------+------------------+------+-----+---------+----------------+
| Field    | Type             | Null | Key | Default | Extra          |
+----------+------------------+------+-----+---------+----------------+
| ingid    | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| recipeid | int(10) unsigned | NO   | MUL | NULL    |                |
| name     | varchar(100)     | YES  |     | NULL    |                |
| amount   | varchar(100)     | YES  |     | NULL    |                |
+----------+------------------+------+-----+---------+----------------+

ingredientlist
+----------+------------------+------+-----+---------+-------+
| Field    | Type             | Null | Key | Default | Extra |
+----------+------------------+------+-----+---------+-------+
| recipeid | int(10) unsigned | NO   | MUL | NULL    |       |
| list     | varchar(500)     | YES  |     | NULL    |       |
+----------+------------------+------+-----+---------+-------+

favorites
+----------+------------------+------+-----+---------+----------------+
| Field    | Type             | Null | Key | Default | Extra          |
+----------+------------------+------+-----+---------+----------------+
| fid      | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| userid   | int(10)          | YES  |     | NULL    |                |
| recipeid | int(10)          | YES  |     | NULL    |                |
+----------+------------------+------+-----+---------+----------------+

users
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

function split ($str) {
    $pattern = "/[\n]/i";
    $result = preg_split($pattern, $str);
    return $result;
}

for ($a=0;$a<$reccount;$a++){
    $recipeName=""; 
    $ingredientList=""; 
    $ingredient="";
    $ingqty=""; 
    $recipeStep="";
    $recipeid= "";
    $ingcount = count($obj['Recipes'][$a]['Ingredients']);
    $prpcount = count($obj['Recipes'][$a]['Preparation']);
    
    //Recipe Name
    $recipeName = $obj['Recipes'][$a]['name'];
    print "RECIPE NAME: $recipeName";
    echo "<br>";

    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    //                      INSERT INTO RECIPES


    $recipestmt = $conn->prepare("INSERT INTO recipes (  rname, rsteps) VALUES (?, ?)");
    $recipestmt->bind_param("ss", $recipeName, $prpcount);
    if ($recipestmt->execute()) {
        print "$recipeName, $prpcount were inserted into recipes table";
    } else {
        var_dump($conn->error);
        var_dump($recipestmt);
    }

    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    //                      SELECT recipeid FROM RECIPES


    $stmt = $conn->prepare("SELECT recipeid FROM recipes WHERE rname = ?");
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
            $stmt = $conn->prepare("INSERT INTO ingredients ( recipeid, name ) VALUES (?, ?)");
            $stmt->bind_param("is", $recipeid, $ingredient);
            if ($stmt->execute()) {
                print "$recipeid, $ingredient inserted into ingredients table";
            } else {
                var_dump($conn->error);
                var_dump($stmt);
            }

        } else {
            print "INGREDIENT: $ingredient | QUANTITY: $ingqty <br>";
            $stmt = $conn->prepare("INSERT INTO ingredients ( recipeid, name, amount ) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $recipeid, $ingredient, $ingqty);
            if ($stmt->execute()) {
                print "$recipeid, $ingredient, $ingqty inserted into ingredients table";
            } else {
                var_dump($conn->error);
                var_dump($stmt);
            }
        }
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
    }

    print "<br>";
    //remove extra comma from ingredientList
    $ingredientList = substr($ingredientList, 0, -2);
    print "INGREDIENT LIST: $ingredientList<br><br>";

    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    //                      INSERT INTO ingredientlist

    $stmt = $conn->prepare("INSERT INTO ingredientlist ( recipeid, list) VALUES (?, ?)");
    $stmt->bind_param("is", $recipeid, $ingredientList);
    if ($stmt->execute()) {
        print "$recipeid, $ingredientList inserted into ingredientlist table";
    } else {
        var_dump($conn->error);
        var_dump($stmt);
    }
    
    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////

    for ($stepid=0;$stepid<$prpcount;$stepid++){

        $stepid2 = $stepid + 1;
        $recipeStep = $obj['Recipes'][$a]['Preparation'][$stepid]['Step'];
        $splitstep = split($recipeStep);
            if (count($splitstep) < 2){
            $time = null;
            $step = $splitstep[0];
        } else {
            $time = $splitstep[0];
            $step = $splitstep[1] . $splitstep[2];
        }

        print "RECIPE STEP $stepid2: $time <br> $step <br><br>";
        
    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    //                      INSERT INTO steps

    $stmt = $conn->prepare("INSERT INTO steps ( recipeid, stepid, stepTime, recipestep) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $recipeid, $stepid2, $time, $step);
    if ($stmt->execute()) {
        print "$recipeid, $recipeid, $stepid2, $time, $step inserted into steps table";
    } else {
        var_dump($conn->error);
        var_dump($stmt);
    }
    
    /////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    }
}
?>