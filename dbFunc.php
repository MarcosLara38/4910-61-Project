<?php

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

<<<<<<< HEAD

            
            if($count == 1){
                echo "Entred one ingredients";
                echo $ings[0];
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

                echo "Ran sql";
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

                }

                

            }
            else if($count == 2){
                echo "Entred two ingredients";
                echo $ings[0];
                echo $ings[1];

                $sql = "Select * from recipes where recipeid in
                (Select T1.recipeid 
                from
                (SELECT recipeid, count(ingredients) as ingreCount  
                FROM ingredients 
                WHERE ingredients in ('$ings[0]', '$ings[1]')  
                group by recipeid  
                having count(ingredients) = $count) T1
                JOIN
                (select recipeid, count(ingredients) as ingreCount
                from ingredients
                group by recipeid) T2
                ON T1.recipeid = T2.recipeid
                where T1.ingreCount = T2.ingreCount)";

                echo "Ran sql";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);
                
            }
            else if($count == 3){
                echo "Entred three ingredients";
                echo $ings[0];
                echo $ings[1];
                echo $ings[2];
                
                $sql = "Select * from recipes where recipeid in
                (Select T1.recipeid 
                from
                (SELECT recipeid, count(ingredients) as ingreCount  
                FROM ingredients 
                WHERE ingredients in ('$ings[0]', '$ings[1]', '$ings[2]')  
                group by recipeid  
                having count(ingredients) = $count) T1
                JOIN
                (select recipeid, count(ingredients) as ingreCount
                from ingredients
                group by recipeid) T2
                ON T1.recipeid = T2.recipeid
                where T1.ingreCount = T2.ingreCount)";

                echo "Ran sql";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);
            }
            else if($count == 4){
                echo "Entred four ingredients";
                echo $ings[0];
                echo $ings[1];
                echo $ings[2];
                echo $ings[3];

                $sql = "Select * from recipes where recipeid in
                (Select T1.recipeid 
                from
                (SELECT recipeid, count(ingredients) as ingreCount  
                FROM ingredients 
                WHERE ingredients in ('$ings[0]', '$ings[1]', '$ings[2]', '$ings[3]')  
                group by recipeid  
                having count(ingredients) = $count) T1
                JOIN
                (select recipeid, count(ingredients) as ingreCount
                from ingredients
                group by recipeid) T2
                ON T1.recipeid = T2.recipeid
                where T1.ingreCount = T2.ingreCount)";

                echo "Ran sql";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);

            }
            else if($count == 5){
                echo "Entred five ingredients";
                echo $ings[0];
                echo $ings[1];
                echo $ings[2];
                echo $ings[3];
                echo $ings[4];

                $sql = "Select * from recipes where recipeid in
                (Select T1.recipeid 
                from
                (SELECT recipeid, count(ingredients) as ingreCount  
                FROM ingredients 
                WHERE ingredients in ('$ings[0]', '$ings[1]', '$ings[2]', '$ings[3]', '$ings[4]')  
                group by recipeid  
                having count(ingredients) = $count) T1
                JOIN
                (select recipeid, count(ingredients) as ingreCount
                from ingredients
                group by recipeid) T2
                ON T1.recipeid = T2.recipeid
                where T1.ingreCount = T2.ingreCount)";

                echo "Ran sql";
                $stmt = $conn->prepare($sql);
=======
            if($ingdata == null){
                $string = implode('|', $ings);
                print "rows: $rows, String: $string";
                //$sql = "SELECT * FROM recipes WHERE recipeid IN (SELECT recipeid FROM ingredients WHERE ingredients in ($string) group by recipeid having count(distinct ingredients) = $count)";
                $stmt = $conn->prepare("SELECT DISTINCT recipes.* FROM ingredients LEFT JOIN recipes using(recipeid) WHERE ingredients REGEXP ?");
                $stmt->bind_param("s", $string);
>>>>>>> 1fddf81bdf469976bb80783a593623f116aa5394
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);
                print_r($ingdata);

            }

<<<<<<< HEAD
                echo "Ran sql";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $output = $stmt->get_result();
                $ingdata = $output->fetch_all(MYSQLI_ASSOC);
                $rows = count($ingdata);



            }else{
                echo "error";

            }
=======
        }
>>>>>>> 1fddf81bdf469976bb80783a593623f116aa5394

            





            
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
    }


    

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