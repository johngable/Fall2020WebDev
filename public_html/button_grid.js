

//Random labels for the buttons to be populated with
labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'];

//initialize the div from the DOM that will be filled with buttons
var buttonDiv = document.getElementById("buttons");

for(var i=0; i<5; i++){ //5 rows
    for(var j=0; j<3; j++){ //3 columns

        //Pick random label from the array above 
        var randomLabel = labels[Math.floor(Math.random()*labels.length)];

        //Create the new button, with a random label and onclick functionality 
        var button = document.createElement("button");
        button.innerHTML = randomLabel;
        button.setAttribute("id", randomLabel);
        button.setAttribute("onclick", "buttonClicked(this.id)");

        //Add css class for color coding        
        if(i%2 == 0){   //If even row (from 0-4) then green buttons
            button.classList.add("even"); 
        }else{  //If odd row then pink
            button.classList.add("odd");     
        }

        //Additional css to help buttons not look ugly
        button.classList.add("clean-button"); 

        buttonDiv.appendChild(button);

    }
    //Add br for new rows
    buttonDiv.appendChild(document.createElement('br'));
}

//Function for button clicks, that creates new phrase variable for validation depending on the 
//button clicked id
function buttonClicked(buttonID){

    var phrase;

    switch (buttonID){
        //1. Int b/w 1-100
        case '1':
            phrase = new Phrase(1, 101); //Invalid
            break;
        case '2':
            phrase = new Phrase(1,  24); //Valid
            break;
        case '3':
            phrase = new Phrase(1, 10); //Valid
            break;
        
        //2. real number
        case '4':
            phrase = new Phrase(2, 101); //Invalid
            break;
        case '5': 
            phrase = new Phrase(2, 59.21); //Valid
            break;
        case '6':
            phrase = new Phrase(2, 101.10); //Valid
            break;
        
        //3. String a-z/A-Z
        case '7': 
            phrase = new Phrase(3, "abcABC123"); //Invalid
            break;
        case '8':
            phrase = new Phrase(3, "defDEF"); //Valid
            break;
        case '9':
            phrase = new Phrase(3, "qrsQRS"); //Valid
            break;
            
        //4. Date ##/##/####
        case '10':
            phrase = new Phrase(4, "1/18/20"); //Invalid
            break;
        case '11':
            phrase = new Phrase(4, "10/30/1999"); //Valid
            break;
        case '12':
            phrase = new Phrase(4, "10/9/2020"); //Valid
            break;
    
        //5. Contains 0-9 or A-F
        case '13':
            phrase = new Phrase(5, "8675309EEEeeee"); //Invalid
            break;
        case '14':
            phrase =  new Phrase(5,"8675309EEE"); //Valid
            break;
        case '15':
            phrase = new Phrase(5, "8675309EEEFFFQ"); //Valid
            break;    
        }

        
        postPhrase(phrase);
    
}

//Constructor function for phrase objects
function Phrase(id, phrase){

    //Type and phrase instance variables
    this.id = id;
    this.phrase = phrase;

    //Attached validation method for Phrase class
    this.validate = function(){

        switch(this.id){
            
            case 1: //Int 1-100
                if(/^([0-9]|([1-9][0-9]))$/.test(this.phrase)){
                    document.getElementById("response").innerHTML = "<br> Phrase is valid!<br>";
                }else{
                    document.getElementById("response").innerHTML = "<br>Error - Phrase is not between 1-100!<br>";
                }
                break;
    
            case 2: //Real number
                if(/^\d+\.\d{0,5}$/.test(this.phrase)){
                    document.getElementById("response").innerHTML = "<br> Phrase is valid!<br>";
                }else{
                    document.getElementById("response").innerHTML = "<br>Error - Phrase is not a real number!<br>";
                }
                break;
            case 3: //String a-zA-Z
                if(/^[a-zA-Z]+$/.test(this.phrase)){
                    document.getElementById("response").innerHTML = "<br> Phrase is valid!<br>";
                }else{
                    document.getElementById("response").innerHTML = "<br>Error - Does not contain just a-z or A-Z<br>";
                }
                break;
        }
    }
}

//Function determines to validate using js or using php depending on the phrase type
function postPhrase(phrase){
    document.getElementById("output").innerHTML = "<br>Phrase Type: "+phrase.id + "<br>";
    document.getElementById("output").innerHTML += "Phrase: "+phrase.phrase + "<br>";

    if(phrase.id>=1 && phrase.id<=3){   //validate using js 
        document.getElementById("output").innerHTML += "<br>Validating using JS...<br>";
        phrase.validate();
    }else{  //validate using php
        document.getElementById("output").innerHTML += "<br>Validating using PHP...<br>";

        //Send data to post for php validations
        var request = new XMLHttpRequest();
        request.open("POST", "./PHP_Validate.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("phrase="+phrase.phrase+"&phraseID="+phrase.id);

        //Wait for the php validation response
        request.onreadystatechange = function() {
            if (this.status == 200) {
                document.getElementById("response").innerHTML = this.responseText;
            } else {
                document.getElementById("response").innerHTML = "Error validating the phrase";
            }
        };

    }
}

