<?php

    $postCount = count($_POST);

    if(isset($_POST['searchBtn']) && $_POST['searchQuery'] != null){
       
        $recipeName = $_POST['searchQuery'];
        // $recipeName = "" . $recipeName . "";
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE RecipeName REGEXP ?");
        $stmt->bind_param("s", $recipeName);
        $stmt->execute();
        $output = $stmt->get_result();
        $data = $output->fetch_all();
        $rows = count($data);
    }

//          HOME SEARCH

    if(isset($_POST['sub_ing']) && $_POST['sub_ing'] != null){

        if(!$_POST['ing_search']){
            $ing_search_err = "Need ingredient(s) for search";
        }else{
            $ing_search = implode('. ', $_POST['ing_search']);
            $ing_search_list = "Ingredient(s) to search: $ing_search <br>";
            $count = count($_POST['ing_search']);
            for($i = 0; $i < $count; $i++){
                $ings[$i] = $_POST['ing_search'][$i];
            }
            $string = implode("', '", $ings);
            $string = "'" . $string . "'"; 

            // print "They entred: $string <br>"; 
            // echo "Entred $count ingredient(s)";
            //$sql = "SELECT * FROM recipes WHERE recipeid IN (SELECT recipeid  FROM ingredients   WHERE ingredients in '$ings[0]' group by recipeid having count(distinct ingredients) = $count)";

            $sql = "Select * from recipes where recipeid in
            (Select T1.recipeid 
            from
            (SELECT recipeid, count(ingredients) as ingreCount  
            FROM ingredients 
            WHERE ingredients in ($string)  
            group by recipeid  
            having count(ingredients) = $count) T1
            JOIN
            (select recipeid, count(ingredients) as ingreCount
            from ingredients
            group by recipeid) T2
            ON T1.recipeid = T2.recipeid
            where T1.ingreCount = T2.ingreCount)";

            // echo "Ran sql";
            // querry for logged in users
            // "SELECT DISTINCT recipes.*, favorites.* FROM ingredients LEFT JOIN recipes using(recipeid) LEFT JOIN favorites using(recipeid) WHERE ingredients REGEXP ?"
            //$stmt = $conn->prepare("SELECT DISTINCT recipes.* FROM ingredients LEFT JOIN recipes using(recipeid) WHERE ingredients REGEXP ?");
            //$stmt->bind_param("s", $string);
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->get_result();
            $ingdata = $output->fetch_all(MYSQLI_ASSOC);
            $rows = count($ingdata);

            if($ingdata == null){
                $string = implode('|', $ings);
                //$sql = "SELECT * FROM recipes WHERE recipeid IN (SELECT recipeid FROM ingredients WHERE ingredients in ($string) group by recipeid having count(distinct ingredients) = $count)";
                $stmt = $conn->prepare("SELECT DISTINCT recipes.* FROM ingredients LEFT JOIN recipes using(recipeid) WHERE ingredients REGEXP ?");
                $stmt->bind_param("s", $string);
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);
            }


        }
    }
            


    if(isset($_POST['selection'])) {
        $_SESSION['selectedRecipeID'] = (int) $_POST['selectedID'];
        // $stmt2 = $conn->prepare("SELECT * FROM recipes WHERE recipeid = $testVar");
    //     $stmt2->execute();
    //     $output2 = $stmt2->get_result();
    //     $selection = $output2->fetch_all(MYSQLI_ASSOC);
    //     if($selection != null){
    //         var_dump($selection);
    //     }
        header("Location: recipeparse.php");
    }

    
    //$sql = "SELECT * FROM recipes WHERE recipeid IN (SELECT recipeid  FROM ingredients   WHERE ingredients in ('egg', 'bacon')   group by recipeid   having count(distinct ingredients) = 2)";
    // querry for logged in users
    // "SELECT DISTINCT recipes.*, favorites.* FROM ingredients LEFT JOIN recipes using(recipeid) LEFT JOIN favorites using(recipeid) WHERE ingredients REGEXP ?"
    /*$stmt = $conn->prepare("SELECT DISTINCT recipes.* FROM ingredients LEFT JOIN recipes using(recipeid) WHERE ingredients REGEXP ?");
    $stmt->bind_param("s", $string);
    $stmt->execute();
    $output = $stmt->get_result();
    $ingdata = $output->fetch_all(MYSQLI_ASSOC);
    $rows = count($ingdata);
    */
?>

<!--
Select * from recipes where recipeid in
  (Select T1.recipeid 
  from
  (SELECT recipeid, count(ingredients) as ingreCount  
  FROM ingredients 
  WHERE ingredients in ('flour', 'milk', 'eggs')  
  group by recipeid  
  having count(ingredients) = 3) T1
  JOIN
  (select recipeid, count(ingredients) as ingreCount
  from ingredients
  group by recipeid) T2
  ON T1.recipeid = T2.recipeid
  where T1.ingreCount = T2.ingreCount) ;



  Select T1.recipeid 
  from
  (SELECT recipeid, count(ingredients) as ingreCount  
  FROM ingredients 
  WHERE ingredients in ('flour', 'milk', 'eggs')  
  group by recipeid  
  having count(ingredients) = 3) T1
  JOIN
  (select recipeid, count(ingredients) as ingreCount
  from ingredients
  group by recipeid) T2
  ON T1.recipeid = T2.recipeid
  where T1.ingreCount = T2.ingreCount ;
  */

-->