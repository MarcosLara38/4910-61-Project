var ing_list = document.getElementsByTagName("LI");
var i; 
for(i = 0; i < ing_list.length; i++){
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "del";
    span.appendChild(txt);
    ing_list[i].appendChild(span);
}

//add the delete buttona and append it to each item
var del = document.getElementsByClassName("del");
var i; 
for(i=0;i < del.length;i++){
    del[i].onclick = function(){
        var div = this.parentElement;
        div.parentElement.removeChild(div);
        //div.innerHTML = "";
    }
}
function addingredient(){
    var li = document.createElement("li");
    var input = document.getElementById("addingi").value; 
    var t = document.createTextNode(input);
    li.appendChild(t);
    li.setAttribute('class',"new_ing");

    if(input === ""){
        alert("empty input");
    }
    else{
        document.getElementById("ingredient_list").appendChild(li);
    }

    

    document.getElementById("addingi").value = "";

    //Creating a delete button or X to remove ingredients
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00d7");
    span.className = "del";
    span.appendChild(txt);
    li.appendChild(span);

    //click x to remove item
    for(i = 0; i < del.length;i++){
        del[i].onclick = function(){
            var div = this.parentElement; 
            div.parentElement.removeChild(div);
            //div.innerHTML = "";
        }
    } 
}

//clear ingredient list 
    function clearlist(){
        //alert("entered clear list function");
        var ingredientlist = document.getElementById("ingredient_list");
        ingredientlist.innerHTML = "";
    }

    function test(){
        console.log("in test func call");
    }



function get_list_items(){
    console.log("Test click");
    //var allElmnts = document.querySelectorAll("ul");
    //var arr = []; 
    //arr.length = allElmnts.length; 
    //for(var i = 0; i < allElmnts.length; i++){
    //arr[i] = allElmnts[i]; 
    //console.log[i];
    //}
    let listArray= document.querySelectorAll('#list-container li');
    let listValues= [];
    listArray.forEach(list=> listValues.push(list.textContent));
    console.log(listValues);

}

    function addarray(t){
        var ingarr = [];
        ingarr.push(t);
        for(i=0;i<ingarr.length;i++)
            console.log(ingarr[i]);
    }