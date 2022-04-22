



function addDataIng(){
    var li = document.createElement("li");
    var input = document.getElementById("addDataInput").value; 
    var t = document.createTextNode(input);
    
    li.appendChild(t);
    li.setAttribute('class', 'addData_ListItem');

    if(input === ""){
        alert("No Ingredient Entered");
    }
    else{
        document.getElementById("addDataIngredient_list").appendChild(li);
    }

    document.getElementById("addDataInput").value = "";

    //Create a delete button/X to remove ingredients
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00d7");
    span.className = "del";
    span.appendChild(txt);
    li.appendChild(span);
    
    //click X to remove item
    for(i = 0; i < del.length;i++){
        del[i].onclick = function(){
            var div = this.parentElement;
            div.parentElement.removeChild(div);

        }
    }

}


function addStep(){
    var li = document.createElement("li");
    var input = document.getElementById("addSteps").value; 
    var t = document.createTextNode(input);
    
    li.appendChild(t);
    li.setAttribute('class', 'addStep_ListItem');

    if(input === ""){
        alert("No Step Entered");
    }
    else{
        document.getElementById("addStep_list").appendChild(li);
    }

    document.getElementById("addSteps").value = "";

    //Create a delete button/X to remove ingredients
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00d7");
    span.className = "del";
    span.appendChild(txt);
    li.appendChild(span);
    
    //click X to remove item
    for(i = 0; i < del.length;i++){
        del[i].onclick = function(){
            var div = this.parentElement;
            div.parentElement.removeChild(div);
            
        }
    }

}



