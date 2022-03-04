const list = document.getElementById("list");

var itemcounter = 0;

function addingredient(){
    var input = document.getElementById("input").value; 
    //alert(input);

    if(input != ""){
        var text = document.createTextNode(input);
        var newitem = document.createElement("li");
        var newcheck = document.createElement("input");
        newcheck.type = "checkbox";
        newcheck.id = "useritem" + itemcounter.toString();
        itemcounter++;

        var newlabel = document.createElement("label");
        newlabel.setAttribute("for",newcheck.id);
        newlabel.innerHTML = input;

        newcheck.onclick = function(){
            if(newcheck.checked){
                newlabel.innerHTML = "<del>" + input + "</del>";
            
            }
            else{
                newlabel.innerHTML = input;
            }
        };

        //add the a checkmark next to the new item and apply the label
        newitem.append(newcheck);
        newitem.append(newlabel);
        document.getElementById("list").appendChild(newitem);
        document.getElementById("input").value = "";    
    }
    //if input is empty then let them know 
    else{
        console.log("Nothing to add");
        alert("empty input");
    }

    //clear ingredient list 
    function clearlist(){
        var ingrdientlist = document.getElementById("list");
        ingredientlist.innerHTML = "";
    }

}