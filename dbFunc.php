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
            $stmt = $conn->prepare("SELECT recipeid FROM ingredients WHERE ingredients REGEXP ?");
            $stmt->bind_param("s", $string);
            $stmt->execute();
            $output = $stmt->get_result();
            $ingdata = $output->fetch_all();
            $rows = count($ingdata);
        }


    }

    

?>