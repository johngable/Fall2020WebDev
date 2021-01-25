<?php

//Optional Debugging mode
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', true);

//if post is recieved
if (isset($_POST['phrase'])){
    echo validate($_POST['phrase'], $_POST['phraseID']);
}

//Function to validate given phrases
function validate($phrase, $phraseID){
    switch($phraseID){

        case 4: //Validate date ##/##/####
          if((bool)preg_match("^\\d{1,2}/\\d{2}/\\d{4}^",$phrase)){
              return("Phrase Validated!");
          }else{return("Phrase Invalid - Please format date correctly!");}
            break;
        case 5: //Contains 0-9 or A-F
            if((bool)preg_match("^[A-F|\d]+$^",$phrase)){
                return("Phrase Validated!");
            }else{return("Phrase Invalid - Please ensure it contains 0-9 or A-F only!");}
            break;

    }
    

}

?>
