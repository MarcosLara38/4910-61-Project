

function clicked() {
    return confirm('Are you sure you want to submit?');
}

function addDataIng(){
    var li = document.createElement("li");
    var input = document.getElementById("addDataInput").value; 
    let inputQty = document.getElementById("addQtyInput").value;
    if(input == "" || inputQty == "" ){
        alert("Must enter both ingredient and quantity");
    }else{
        let totalVal = inputQty + " " + input;

        var t = document.createTextNode(totalVal);
        var hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'ingredients[]';
        hidden.value = input;

        var hiddenQty = document.createElement('input')
        hiddenQty.type = 'hidden';
        hiddenQty.name = 'quantities[]';
        hiddenQty.value = inputQty;
        
        li.appendChild(t);
        li.setAttribute('class', 'addData_ListItem');

        if(input === ""){
            alert("No Ingredient Entered");
        }
        else{
            document.getElementById("addDataIngredient_list").appendChild(li);
        }

        document.getElementById("addDataInput").value = "";
        document.getElementById("addQtyInput").value = "";

        //Create a delete button/X to remove ingredients
        var span = document.createElement("SPAN");
        var txt = document.createTextNode("\u00d7");
        span.className = "del";
        span.appendChild(txt);
        li.appendChild(span);
        li.appendChild(hidden);
        li.appendChild(hiddenQty);
        
        //click X to remove item
        for(i = 0; i < del.length;i++){
            del[i].onclick = function(){
                var div = this.parentElement;
                div.parentElement.removeChild(div);

            }
        }
    }

}


function addStep(){
    var li = document.createElement("li");
    var input = document.getElementById("addSteps").value; 
    var t = document.createTextNode(input);
    var hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'steps[]';
    hidden.value = input

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
    li.appendChild(hidden);

    //click X to remove item
    for(i = 0; i < del.length;i++){
        del[i].onclick = function(){
            var div = this.parentElement;
            div.parentElement.removeChild(div);
            
        }
    }

}



