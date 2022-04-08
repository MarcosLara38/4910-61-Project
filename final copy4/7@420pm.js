const list = document.getElementById("list");

var itemcounter = 0;


function addingredient(){
    var input = document.getElementById("addingi").value; 
    //alert(input);

    if(input != ""){
        var text = document.createTextNode(input);
        var newitem = document.createElement("li");
        var newcheck = document.createElement("button"); //was originally input
        //newcheck.type = "checkbox"
        newcheck.type = "button"; //added
        //creating id for each new item added (ing1,ing2)
        //newcheck.id = "ing" + itemcounter.toString();
        newcheck.id = "ing"; // added
        newcheck.appendChild(document.createTextNode('Delete'));
        itemcounter++;

        var newlabel = document.createElement("li");
        newlabel.setAttribute("for",newcheck.id);
        newlabel.innerHTML = input;

        /*newcheck.onclick = function(){
            if(newcheck.checked){
                newlabel.innerHTML = "<del>" + input + "</del>";
            
            }
            else{
                newlabel.innerHTML = input;
            }
        };
        */

        //add the a checkmark next to the new item and apply the label
        newitem.append(newcheck);
        newitem.append(newlabel);
        document.getElementById("list").appendChild(newitem);
        document.getElementById("addingi").value = ""; 
        
        
        
    }
    //if input is empty then let them know 
    else{
        console.log("Nothing to add");
        alert("empty input");
    }

}

//clear ingredient list 
    function clearlist(){
        //alert("entered clear list function");
        var ingredientlist = document.getElementById("list");
        ingredientlist.innerHTML = "";
    }

//Delete button next to list item is pressed NOT WORKING
document.getElementById('ing').onclick = function(){
    console.log("Delete button was now clicked");
}

function get_list_items(){
    console.log(document.getElementById("li"));
    }