
<html>
    <head>
    <body>
        <div id = productAddition name = product></div>
        <div style="position:relative">
            
            <div style="position:absolute; top:500;">
                <?php echo(show_source("./Ajax_Database.php", true)); ?>
            </div>
        </div>
        
    </body>


    <script>
    
    var product="";

    function recieveUpdate(){
        
        if(product=="mug"){
            console.log("HELP");
            var name = document.getElementById("mug_name").value;
            var price = document.getElementById("mug_price").value; 
            var quantity = document.getElementById("mug_quantity").value; 
            var bluetooth = document.getElementById("mug_bluetooth").value; 
            var color = document.getElementById("mug_color").value; 
        }else if(product=="monitor"){
            var name = document.getElementById("monitor_name").value;
            var price = document.getElementById("monitor_price").value; 
            var quantity = document.getElementById("monitor_quantity").value; 
            var refresh = document.getElementById("monitor_refresh_rate").value; 
            var hdmi = document.getElementById("monitor_hdmi_quantity").value; 
        }

        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.open("POST", "Ajax_Database.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("tableDiv").innerHTML = this.responseText;
            }
        }
        
        if(product=="mug"){
            var start = "mug_info=1"
            var post = start.concat("&mug_name=", name, "&mug_price=", price, "&mug_quantity=", quantity, "&mug_bluetooth=", bluetooth, "&mug_color=", color);
            xhttp.send(post);
        }else if(product=="monitor"){
            var start = "monitor_info=1"
            var post = start.concat("&monitor_name=", name, "&monitor_price=", price, "&monitor_quantity=", quantity, "&monitor_refresh_rate=", refresh, "&monitor_hdmi_quantity=", hdmi);
            xhttp.send(post);
        } 
        location.reload(); 

        

    }

    function productChoice(){
        if(document.getElementById("mug_check").checked){
            product="mug";
            document.getElementById('productAddition').innerHTML=`<div id='mug_form' style = 'float:left;border:2px solid black;margin:auto;padding: 5px;'> 
            <form> 
                <center> 
                <div style = 'margin:auto'> <br>
                    Enter the mug information!
                    <p><span class='error'>* Required field for uploading</span></p>
                    <br>
                    Name:  <input type='text' id = 'mug_name' name= 'mug_name'>
                    <span class='error'>*</span>
                    <br><br>
                    Price:  <input type='text' id= 'mug_price' name= 'mug_price'>
                    <span class='error'>*</span>
                    <br><br>
                    Quantity: <input type='text' id= 'mug_quantity' name= 'mug_quantity'>
                    <span class='error'>*</span>
                    <br><br>
                    Bluetooth Access: <input type='text' id= 'mug_bluetooth' name= 'mug_bluetooth'>
                    <span class='error'>*</span>
                    <br><br>
                    Color: <input type='text' id = 'mug_color' name= 'mug_color'>
                    <span class='error'>*</span>
                    <br><br>
                    <button type='button' onclick='recieveUpdate()'> submit </button>
                </div>
                </center>
            </form>
        </div>`
        }else if(document.getElementById("monitor_check").checked){
            product="monitor";
            document.getElementById('productAddition').innerHTML=`<div id="monitor_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
            <form method = "post" action = "Ajax_Database.php">
                <center>
                <div>
                    Enter the monitor information!
                    <p><span class="error">* Required field for uploading</span></p>
                    <br>
                    Name:  <input type="text" id = 'monitor_name' name= "monitor_name">
                    <span class="error">*</span>
                    <br><br>
                    Price:  <input type="text" id = 'monitor_price' name= "monitor_price">
                    <span class="error">*</span>
                    <br><br>
                    Quantity: <input type="text" id = 'monitor_quantity' name= "monitor_quantity">
                    <span class="error">*</span>
                    <br><br>
                    Refresh Rate: <input type="text" id = 'monitor_refresh_rate' name= "monitor_refresh_rate">
                    <span class="error">*</span>
                    <br><br>
                    HDMI Quantity: <input type="text" id= "monitor_hdmi_quantity" name= "monitor_hdmi_quantity">
                    <span class="error">*</span>
                    <br><br>
                    <button type='button' onclick='recieveUpdate()'> submit </button>
                </div>
                </center>
            </form>
            </div>`
        }
    }

    </script>

</html>


<?php

//DB Login Information
$hostname = "localhost";
$database = "webprog10";
$username = "webprog10";
$password = "perozzot";

$conn = new mysqli($hostname, $username, $password, $database);

//Attempt to connect, if not dump error
if ($conn->connect_error) die($conn->connect_error);

//Retrieve result sets from Select * on mugs and monitors
//**Required for filling initial table */
$mugResults = selectMugObjects($conn);
$monitorResults = selectMonitorObjects($conn);

//Build the initial table
buildWebPageTable($mugResults, $monitorResults);


//UI Form for the user to input a new mug product into
if(!empty(($_POST['mug_info']))){
    $requiredField=0;

    if (empty($_POST["mug_name"])) {
        $requiredField++;
    } else {
        $name = $_POST['mug_name'];
    }

    if (empty($_POST["mug_price"])) {
        $requiredField++;
    } else {
        $price = $_POST['mug_price'];
    }
    
    if (empty($_POST["mug_quantity"])) {
        $requiredField++;
    } else {
        $quantity = $_POST['mug_quantity'];
    }

    if (empty($_POST["mug_bluetooth"])) {
        $requiredField++;
    } else {
        $bluetooth = $_POST['mug_bluetooth'];
    }

    if (empty($_POST["mug_color"])) {
        $requiredField++;
    } else {
        $color = $_POST['mug_color'];
    }
    
   
    if($requiredField==0){
        $query = "Insert into SmartMug(name, price, quantity, bluetoothAccess, color) values('".$name."',".(double)$price.",".(int)$quantity.",".(boolean)$bluetooth.",'".$color."');";
        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
    }

}
//UI Form for the user to input a new monitor product into
elseif(!empty(($_POST['monitor_info']))){
    $requiredField=0;

    if (empty($_POST["monitor_name"])) {
        $requiredField++;
    } else {
        $name = $_POST['monitor_name'];
    }

    if (empty($_POST["monitor_price"])) {
        $requiredField++;
    } else {
        $price = $_POST['monitor_price'];
    }
    
    if (empty($_POST["monitor_quantity"])) {
        $requiredField++;
    } else {
        $quantity = $_POST['monitor_quantity'];
    }

    if (empty($_POST["monitor_refresh_rate"])) {
        $requiredField++;
    } else {
        $monitor_refresh_rate = $_POST['monitor_refresh_rate'];
    }
    
    if (empty($_POST["monitor_hdmi_quantity"])) {
        $requiredField++;
    } else {
        $monitor_hdmi_quantity = $_POST['monitor_hdmi_quantity'];
    }
    
    if($requiredField==0){
        $query = "Insert into ComputerMonitor(name, price, quantity, refreshRate, hdmiInputQuantity) values('".$name."',".(double)$price.",".(int)$quantity.",".(int)$monitor_refresh_rate.",".(int)$monitor_hdmi_quantity.");";
        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
    }
     
    
}else{        
    createAdditionalProductTypeForm();
}


//Selects all from mug table and returns result set
function selectMugObjects($conn){
    //Select objects
    $query = "select * from SmartMug";
    $result = $conn->query($query);
    if (!$result) echo "Drop Failed!";

    return $result;
}

//Selects all from computer monitor table and returns result set
function selectMonitorObjects($conn){
    //Select objects
    $query = "select * from ComputerMonitor";
    $result = $conn->query($query);
    if (!$result) echo "Drop Failed!";

    return $result;
}

//Takes in both result sets and builds the entire HTML Table frmo them
function buildWebPageTable($mugResults, $monitorResults){

    
    //Begin creating table
    echo ("<div id=tableDiv style='float:right'>
    <h1><center>Customer Shopping Cart</center></h1>
    <table style='width:50%; vertical-align:top;', class = 'center'>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Bluetooth Accessible</th>
                <th>Color</th>
                <th>Refresh Rate</th>
                <th>HDMI Input Quantity</th>

            </tr>");

    //Iterate through the mug result set and add the elements to the table
    $mugRows = $mugResults->num_rows;

    for($i=0; $i<$mugRows;$i++){
        $mugResults->data_seek($i);
        $row = $mugResults->fetch_array(MYSQLI_NUM);

        echo("<tr>");
            echo("<th>".$row[1]."</th>");
            echo("<th>".$row[2]."</th>");
            echo("<th>".$row[3]."</th>");
            if(boolval($row[4])){
                echo("<th>"."TRUE"."</th>");
            }else {   
                echo("<th>"."FALSE"."</th>");
            }
            echo("<th>".$row[5]."</th>");
            echo("<th> N/A </th>");
            echo("<th> N/A </th>");
        echo("</tr>");

    }

    //Iterate through the monitor result set and add them to the table
    $monitorRows = $monitorResults->num_rows;
    for($i=0; $i<$monitorRows;$i++){
        $monitorResults->data_seek($i);
        $row = $monitorResults->fetch_array(MYSQLI_NUM);

        echo("<tr>");
            echo("<th>".$row[1]."</th>");
            echo("<th>".$row[2]."</th>");
            echo("<th>".$row[3]."</th>");
            echo("<th> N/A </th>");
            echo("<th> N/A </th>");
            echo("<th>" .$row[4]. "</th>");
            echo("<th>".$row[5]."</th>");
        echo("</tr>");

    }

    echo("</table><br>");


    echo("</div>");

    

   
}

/**
 * If the user selected to add additional products, this form will facilitate and post
 * which type of product they would like to add to the database.
 */
function createAdditionalProductTypeForm(){
	echo(' <html lang = "en-US">
        <head>
            <title> PHP DB Form</title>
        </head>
        <body>
            <div id="selection_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
                <form method = "post" action = "Ajax_Database.php">
                    <center>
                    <div>
                        What new product would you like to add?
                        <br><br>
                        <input type="checkbox" id="mug_check" name="mug_check" value="checkbox">
                        <label for="mug_check"> Smart Mug </label><br>
                        <input type="checkbox" id="monitor_check" name="monitor_check" value="checkbox">
                        <label for="monitor_check"> Computer Monitor</label><br> 
                        <br><br>
                        <button type="button" onclick="productChoice()">Submit</button>
                    </div>
                    </center>
                </form>
            </div>
            
        </body>
    </html>');
}


?>

<style>
    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }

    table.center {
    margin-left: auto;
    margin-right: auto;
    }
    
    .error {color: #FF0000;}
    
</style>