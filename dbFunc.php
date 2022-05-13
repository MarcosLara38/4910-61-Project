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
            for($i = 0; $i < count($_POST['ing_search']); $i++){
                $ings[$i] = $_POST['ing_search'][$i];
            }
            $string = implode('|', $ings);
            print $string;
            // querry for logged in users
            // "SELECT DISTINCT recipes.*, favorites.* FROM ingredients LEFT JOIN recipes using(recipeid) LEFT JOIN favorites using(recipeid) WHERE ingredients REGEXP ?"
            $stmt = $conn->prepare("SELECT DISTINCT recipes.* FROM ingredients LEFT JOIN recipes using(recipeid) WHERE ingredients REGEXP ?");
            $stmt->bind_param("s", $string);
            $stmt->execute();
            $output = $stmt->get_result();
            $ingdata = $output->fetch_all(MYSQLI_ASSOC);
            $rows = count($ingdata);
        }


    }

    

?>