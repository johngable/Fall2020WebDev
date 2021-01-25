
<?php 
    /**
     * This is the PHP based webpage for Assignment 1 in Web Prog. 
     * There's a welcoming header, followed by subheaders that title the section
     * being exampled, the sections sample code, and then the actual PHP code that echoes to 
     * an output box on the webpage.
     * 
     * Author - John G.
     * 
     */

    //Basic centered header with border around it to welcome users to the page
    echo "<h1 style = 'border:2px solid black;margin:auto;'><center>These are PHP Examples!</center></h1>";

    //This is the section for the While Loops header and Example Code box
    echo "<h2><center><u> While Loops </u></center></h2>"; 
    echo "<div style='border:2px solid black; margin-left:30em; margin-right:30em'>"."<h3> Example Code: </h3>" . "<p> $"."temp=0 <br><br> while("."$"."temp<1){ <br> echo 'Hello!' "."($"."temp +1)"."; <br>" . "$"."temp++" . "<br>};</p>"."</div>";
    
    //This is the actual PHP code and output for the while loops output box
    $temp = 0;

    while($temp<2){
        echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output " . ($temp+1) . ": </h3>" . "<center>Hello! " .$temp."</center>"."</div>");
        $temp++;
    }

    //This is the section for If/Else statement header and Example Code box
    echo "<h2><center><u> If/Else Statements </u></center></h2>";
    echo "<div style='border:2px solid black; margin-left:30em; margin-right:30em'>"."<h3> Example Code: </h3>" . "<p> $"."exampleVar='Yes'; <br><br> if ("."$"."exampleVar=='Yes'){ <br> echo 'You must've had yes as your variable!'; <br>"."}else {<br>"."echo 'You didn't have yes as your variable.';" . "<br>}</p>"."</div>";
    
    //This is the actual PHP code and output for the if/else output box
    $exampleVar = 'Yes';

    if($exampleVar=='Yes'){
        echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>You must've had yes as your variable!</center>"."</div>");
    }else{
        echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>You didn't have yes as your variable</center>"."</div>");
    }

    //This section is for the Switch Case header and Example Code box
    echo "<h2><center><u> Switch Case Statements </u></center></h2>";
    echo "<div style='border:2px solid black; margin-left:30em; margin-right:30em'>"."<h3> Example Code: </h3>" . "<p> $"."switchVar=2; <br><br> switch ("."$"."exampleVar){ <br> case 0: <br> echo 'Variable was 0'; <br> break; <br>"."case 1: <br> echo 'Variable was 1'; <br> break; <br>"."case 2: <br> echo 'Variable was 2'; <br> break; <br>}"."</p>"."</div>";


    //This is the actual PHP code and output for the switch case output box
    $switchVar=2;

    switch($switchVar){
        case 0: 
            echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>Variable was 0</center>"."</div>");
            break;
        case 1:
            echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>Variable was 1</center>"."</div>");
            break;
        case 2:
            echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>Variable was 2</center>"."</div>");
            break;
    }

    //This section is for the Type Casting header and Example Code box
    echo "<h2><center><u> Type Casting </u></center></h2>";
    echo "<div style='border:2px solid black; margin-left:30em; margin-right:30em'>"."<h3> Example Code: </h3>" . "<p> $"."stringVar='10'; <br> $"."numVar=10;<br><br> echo $"."stringVal*$"."numVal;"."</p>"."</div>";
    
    //This is the actual PHP code and output for the type casting
    //You can see that PHP will typecast the string '10' to a numeric in order to perform multiplication
    $stringVal = "10";
    $numVal = 10;

    echo("<div style='border:2px solid black; margin-top:10px; margin-left:30em; margin-right:30em'>"."<h3> Output : </h3>" . "<center>".$stringVal * $numVal."</center>"."</div>");


?>