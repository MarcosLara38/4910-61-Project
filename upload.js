

function showData() {
    
    var file_to_read = document.getElementById("jsonfileinput").files[0];
    var fileread = new FileReader();

    fileread.onload = function(e) {
        var content = e.target.result;
        var obj = JSON.parse(content);
        var length = Object.keys(obj.Recipes).length;
        // var inglen = Object.keys(obj.Recipes[0].Ingredients).length;
        // var preplen = Object.keys(obj.Recipes[0].Preparation).length;
        /* for (i=0;i<length;i++) {
            console.log(obj.Recipes[i].name);
            document.getElementById("objectinfo").innerHTML += obj.Recipes[i].name + ", ";
            console.log(i);
        } */

        for (i=0;i<2;i++) {
            var inglen = Object.keys(obj.Recipes[i].Ingredients).length;
            var preplen = Object.keys(obj.Recipes[i].Preparation).length;
            

            document.getElementById("objectinfo").innerHTML += obj.Recipes[i].name + "<br><br> Ingredients: " + inglen + "<br>";

            for (j=0;j<inglen;j++) {
                
                
                if (obj.Recipes[i].Ingredients[j].Quantity == null) {
                    document.getElementById("objectinfo").innerHTML += obj.Recipes[i].Ingredients[j].Name;
                    document.getElementById("objectinfo").innerHTML += "<br>";
                } else {
                    document.getElementById("objectinfo").innerHTML += obj.Recipes[i].Ingredients[j].Name;
                    document.getElementById("objectinfo").innerHTML += ": "+ obj.Recipes[i].Ingredients[j].Quantity;
                    document.getElementById("objectinfo").innerHTML += "<br>";
                }
            }
            document.getElementById("objectinfo").innerHTML += "<br>Steps: " + preplen + "<br>";

            for (k=0;k<preplen;k++) {
                document.getElementById("objectinfo").innerHTML += "step "+ (k+1) + ": "+ obj.Recipes[i].Preparation[k].Step;
                document.getElementById("objectinfo").innerHTML += "<br>";
                
            }


            document.getElementById("objectinfo").innerHTML += "<br>";
        }
        console.log(inglen);
        console.log(preplen);



        




    };

    fileread.readAsText(file_to_read);

    

}