<?php
/*  Marcos lara

    NOTES-- The user gets the choice to either upload an image to detect the ingredients or 
    by adding them one by one in an text list. Once done, they will get their results of different
    repieces. 
    
    Right now the current database that is it trying to connect to is my local one.
*/


include("config.php");

//If the user uploaded a image, this is where it will be uploaded to the database
if(isset($_POST['Picture_upload'])){
  if (is_uploaded_file($_FILES['file']['tmp_name'])) {
 
    $db = mysqli_connect("localhost", "root", "", "photos");

  $imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
  $imageProperties = getimageSize($_FILES['file']['tmp_name']);
  
  $sql = "INSERT INTO output_images(imageType ,imageData)
  VALUES('{$imageProperties['mime']}', '{$imgData}')";
  $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
  if (isset($current_id)) {
      header("Location: listImages.php");
  }
  mysqli_close($db);
  }

 
}

//If the user upload a text list, this is where it will be sent to the database
if(isset($_POST['List_upload'])){
  //if (isset($_POST['list_item'])) {
    //$db = mysqli_connect("localhost", "root", "", "ListOfIngredients");
    //$test = "Plz";
    //echo ($test);
    //$list = 'list_item';

    //$sql = "INSERT INTO test(Name) VALUES($list)";
    //$current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on List Insert<br/>" . mysqli_error($db));

    //mysqli_close($db);
  
}
//Beginning of the website
?>
<head>
  <title>Ingredients</title>
</head>
<body>
  <h1>Recipes Searcher</h1>
  <p>You can either type in your ingredients or upload a picture of your ingredients.</p><br>
 
  <p>Enter each ingredient into this list.</p>
  

  
  <fieldset style="width:500px">
    <legend> List of your Ingredients: </legend>
    <ul id="list_item" name = "Plz"></ul>
  </fieldset ><br>

  <input type="text" id="Item" />
  <button id="addButton" onclick="addItem()" class="buttonClass">
    Add item</button>
  <button onclick="removeItem()" class="buttonClass">
    Remove item</button>

<!-- 2 scripts dealing with adding and removing the items in the list-->
<script>
    var input = document.getElementById("Item");
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("addButton").click();
      }
    })
    function addItem() {
      var a = document.getElementById("list_item");
      var item = document.getElementById("Item");
      var li = document.createElement("li");
      li.setAttribute('id', item.value);
      li.appendChild(document.createTextNode(item.value));
      a.appendChild(li);
    }

    function removeItem() {
    // Declaring a variable to get select element
    var a = document.getElementById("list_item");
    var item = document.getElementById("Item");
    var item2 = document.getElementById(item.value);
    a.removeChild(item2);
    }

    function test() {
        
    }
  </script>
  
  <p>Once you are done entering your ingredient list, Submit it.</p>
    
    <form method="post" onsubmit="test()" action="" enctype='multipart/form-data'>
      <input type='submit' value='Submit' name='List_upload'>
    </form>
  </p>
  <br>
  <P>Upload an image of your ingredients.</p>
  <form method="post" action="" enctype='multipart/form-data'>
    <input type='file' name='file' />
    <input type='submit' value='Upload' name='Picture_upload'>
  </form>
</body>
