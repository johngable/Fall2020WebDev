<!DOCTYPE html>
<html lang = "en-US">

<body>
    

    <p style="text-align: center;"> rows: 5     columns: 3</p>
    <div id = "buttons" style = "text-align: center;">
    </div>

    <div id = "output" style = "text-align: center;">
    </div>

    <div id = "response" style = "text-align: center;">
    </div>

    <br><br><br><br>
    <div style ='float:left;margin:auto;padding: 5px;'>
        <?php    
        echo(show_source("./Button_Grid.php", true));
        echo(show_source("./button_grid.js", true));
        echo(show_source("./PHP_Validate.php", true));
        ?>
    </div>


</body>


<script src="button_grid.js"></script> 


<style>

    .clean-button{
        border-radius: 4px;
        padding: 10px 24px;
        margin: 2px;
        font-size: 12px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }

    .even {
        background-color: rgb(41, 212, 133);
    }

    .odd {
        background-color: rgb(226, 137, 222);
    }



</style>


</html>