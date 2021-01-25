
<?php //PHP_Form.php\

//Optional Debugging mode
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', true);

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



//Move to the UI required for the users choice of adding or edititing
if(!empty(($_POST['choiceSelector']))){
    $choice = $_POST['choiceSelector'];
    if(($_POST['choice'])=='1'){
        createEditSelectionForm($mugResults, $monitorResults);        
    }elseif(($_POST['choice'])=='2'){
        createAdditionalProductTypeForm();
    }
}
//If the user selects to add, retrieve which product table to add to
elseif (!empty(($_POST['selector']))){
    if(($_POST['Product'])=='1'){
        $product = "Smart Mug";
        echo createMugAdditionForm();

    }elseif(($_POST['Product'])=='2'){
        $product = "Computer Monitor";
        echo createMonitorAdditionForm();
    }

}
//UI Form for the user to input a new mug product into
elseif(!empty(($_POST['mug_info']))){
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
    echo "<meta http-equiv='refresh' content='0'>";

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
     
    echo "<meta http-equiv='refresh' content='0'>";
    
}
//UI/Form that populates with the selected mug information
elseif(!empty(($_POST['mugSelector']))){
    $tableName="SmartMug";
    createEditForm((string)$_POST['mugList'], $conn, $tableName);
}
//UI/Form that populates with the select monitor information
elseif(!empty(($_POST['monitorSelector']))){
    $tableName="ComputerMonitor";
    createEditForm((string)$_POST['monitorList'], $conn, $tableName);
}
//Form for the users to edit existing mug information
elseif(!empty(($_POST['edit_mug_info']))){

    $requiredField=0;

    if (empty($_POST["new_name"])) {
        $requiredField++;
    } else {
        $name = $_POST['new_name'];
    }

    if (empty($_POST["new_price"])) {
        $requiredField++;
    } else {
        $price = $_POST['new_price'];
    }
    
    if (empty($_POST["new_quantity"])) {
        $requiredField++;
    } else {
        $quantity = $_POST['new_quantity'];
    }

    if (empty($_POST["new_bluetooth_accessible"])) {
        $requiredField++;
    } else {
        $bluetooth = $_POST['new_bluetooth_accessible'];
    }

    if (empty($_POST["new_color"])) {
        $requiredField++;
    } else {
        $color = $_POST['new_color'];
    }
    
    if (empty($_POST["old_name"])) {
        $requiredField++;
    } else {
        $old_name = $_POST['old_name'];
    }

    if($requiredField==0){
        $query = ("update SmartMug set name = '".$name."', price = ".(double)$price.",quantity = ".(int)$quantity.",bluetoothAccess = ".(boolean)$bluetooth.",color = '".$color."' where name = '".$old_name."';");
        $result = $conn->query($query);
        if (!$result) echo "Creation Failed!: ";
    }

    echo "<meta http-equiv='refresh' content='0'>";
   
    
}
//Form for the users to edit existing monitor information
elseif(!empty(($_POST['edit_monitor_info']))){

    $requiredField=0;

    if (empty($_POST["new_name"])) {
        $requiredField++;
    } else {
        $name = $_POST['new_name'];
    }

    if (empty($_POST["new_price"])) {
        $requiredField++;
    } else {
        $price = $_POST['new_price'];
    }
    
    if (empty($_POST["new_quantity"])) {
        $requiredField++;
    } else {
        $quantity = $_POST['new_quantity'];
    }

    if (empty($_POST["new_refresh_rate"])) {
        $requiredField++;
    } else {
        $refreshRate = $_POST['new_refresh_rate'];
    }

    if (empty($_POST["new_hdmi_quantity"])) {
        $requiredField++;
    } else {
        $hdmiQuantity = $_POST['new_hdmi_quantity'];
    }
    
    if (empty($_POST["old_name"])) {
        $requiredField++;
    } else {
        $old_name = $_POST['old_name'];
    }

    if($requiredField==0){
        $query = ("update ComputerMonitor set name = '".$name."', price = ".(double)$price.",quantity = ".(int)$quantity.",refreshRate = ".$refreshRate.",hdmiInputQuantity = ".$hdmiQuantity." where name = '".$old_name."';");
        $result = $conn->query($query);
        if (!$result) echo "Creation Failed!: ";
    }

    echo "<meta http-equiv='refresh' content='0'>";
   
    
}
//If no post for other forms, create the initial choice between adding or editing products
else{createUserChoiceForm();}

echo("<div style ='float:left;margin:auto;padding: 5px;'>");
echo(show_source("./PHP_Form.php"));
echo("</div>");

/**
 * First initial form/ui for the users
 * Posts the users choice of editing or adding products
 */
function createUserChoiceForm(){
    echo '<input type="hidden" value="' . $choice . '" name="choiceSelector" />'; 
    echo('
    <div id = "edit_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
        <form method = "post" action = "PHP_Form.php">
            <center>
            <div>
                What would you like to do?
                <br><br>
                Edit Existing Product <input type="radio" name= "choice" value = "1">
                Add Additional Product <input type="radio" name= "choice" value="2">
                <br><br>
                <input type="submit" value="submit" name = "choiceSelector">
            </div>
            </center>
        </form></div>');

}

/**
 * Form that is populated with the list of monitor and mug products
 * and posts which product and its type is going to be edited.
 */
function createEditSelectionForm($mugResults, $monitorResults){
    $monitorRows = $monitorResults->num_rows;
    $mugRows = $mugResults->num_rows;
    

    echo("
        <div id = 'edit_form' style = 'float:left;border:2px solid black;margin:auto;padding: 5px;'>
        <center>
        <form method = 'post' action='PHP_Form.php'>
            <label for='mugList'>Choose a mug to edit:</label>
                <select name='mugList' id='mugList'>");
                    for($i=0; $i<$mugRows;$i++){
                        $mugResults->data_seek($i);
                        $row = $mugResults->fetch_array(MYSQLI_NUM);
                        echo("<option value=".$row[1].">");
                        echo($row[1]);
                        echo("</option>");
                    }
                echo("</select>");
                echo('<input type="submit" value="submit" name = "mugSelector">');  
        echo('</form>');
        echo("<form method = 'post' action='PHP_Form.php'>");
                echo("<label for='monitorList'>Choose a mug to edit:</label>");
                echo("<select name='monitorList' id='monitorList'>");
                    for($i=0; $i<$monitorRows;$i++){
                        $monitorResults->data_seek($i);
                        $row = $monitorResults->fetch_array(MYSQLI_NUM);
                        echo('<option value="'.$row[1].'">');
                        echo($row[1]);
                        echo("</option>");
                    }
                echo("</select>");
            echo('<input type="submit" value="submit" name = "monitorSelector">');   
   
    
         echo("</form></center></div>");       

}

/**
 * Form that is populated with the users selected product information for editing.
 * Posts the updated information and updates into the database.
 */
function createEditForm($selection, $conn, $tableName){

    $query = "select * from ".$tableName." where name = '".$selection."';";
    $result = $conn->query($query);
    if (!$result) echo "Drop Failed!";

    $row = mysqli_fetch_assoc($result);

    if(boolval($row['bluetoothAccess'])){
        $bluetooth="TRUE";
    }else{
        $bluetooth="FALSE";
    }

    if($tableName=="SmartMug"){
        echo'
            <div id="edit_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
            <form method = "post" action = "PHP_Form.php">
                <center>
                <div style = "margin:auto">
                    <br>
                    Enter the new information!
                    <br><br>
                    Name:  <input type="text" name= "new_name" value = "'.$row['name'].'">
                    <br><br>
                    Price:  <input type="text" name= "new_price" value = "'.$row['price'].'">
                    <br><br>
                    Quantity: <input type="text" name= "new_quantity" value = "'.$row['quantity'].'">
                    <br><br>
                    Value 1: <input type="text" name= "new_bluetooth_accessible" value = "'.$bluetooth.'">
                    <br><br>
                    Value 2: <input type="text" name= "new_color" value = "'.$row['color'].'">
                    <br><br>
                    <input type="submit" name = "edit_mug_info" value="submit">
                    <input type="hidden" name= "old_name" value = "'.$selection.'">
                </div>
                </center>
            </form>
            </div>';
    }elseif($tableName=="ComputerMonitor"){
        echo'
            <div id="edit_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
            <form method = "post" action = "PHP_Form.php">
                <center>
                <div style = "margin:auto">
                    <br>
                    Enter the new information!
                    <br><br>
                    Name:  <input type="text" name= "new_name" value = "'.$row['name'].'">
                    <br><br>
                    Price:  <input type="text" name= "new_price" value = "'.$row['price'].'">
                    <br><br>
                    Quantity: <input type="text" name= "new_quantity" value = "'.$row['quantity'].'">
                    <br><br>
                    Value 1: <input type="text" name= "new_refresh_rate" value = "'.$row['refreshRate'].'">
                    <br><br>
                    Value 2: <input type="text" name= "new_hdmi_quantity" value = "'.$row['hdmiInputQuantity'].'">
                    <br><br>
                    <input type="submit" name = "edit_monitor_info" value="submit">   
                    <input type="hidden" name= "old_name" value = "'.$selection.'">
                </div>
                </center>
            </form>
            </div>';
    }
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
                <form method = "post" action = "PHP_Form.php">
                    <center>
                    <div>
                        What new product would you like to add?
                        <br><br>
                        Smart Mug <input type="radio" name= "Product" value = "1">
                        Computer Monitor <input type="radio" name= "Product" value="2">
                        <br><br>
                        <input type="submit" value="submit" name = "selector">
                    </div>
                    </center>
                </form>
            </div>
            
        </body>
    </html>');
}

/**
 * Form for the new mug addition information to be posted
 */
function createMugAdditionForm(){
	return <<<EOD
    <div id="mug_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
            <form method = "post" action = "PHP_Form.php">
                <center>
                <div style = "margin:auto">
                    <br>
                    Enter the mug information!
                    <p><span class="error">* Required field for uploading</span></p>
                    <br>
                    Name:  <input type="text" name= "mug_name">
                    <span class="error">*</span>
                    <br><br>
                    Price:  <input type="text" name= "mug_price">
                    <span class="error">*</span>
                    <br><br>
                    Quantity: <input type="text" name= "mug_quantity">
                    <span class="error">*</span>
                    <br><br>
                    Bluetooth Access: <input type="text" name= "mug_bluetooth">
                    <span class="error">*</span>
                    <br><br>
                    Color: <input type="text" name= "mug_color">
                    <span class="error">*</span>
                    <br><br>
                    <input type="submit" name = "mug_info" value="submit">
                </div>
                </center>
            </form>
        </div>
EOD;
}

/**
 * Form for the new monitor additional information to be posted
 */
function createMonitorAdditionForm(){
    	return  <<<EOD
	 <div id="monitor_form" style = "float:left;border:2px solid black;margin:auto;padding: 5px;">
            <form method = "post" action = "PHP_Form.php">
                <center>
                <div>
                    Enter the monitor information!
                    <p><span class="error">* Required field for uploading</span></p>
                    <br>
                    Name:  <input type="text" name= "monitor_name">
                    <span class="error">*</span>
                    <br><br>
                    Price:  <input type="text" name= "monitor_price">
                    <span class="error">*</span>
                    <br><br>
                    Quantity: <input type="text" name= "monitor_quantity">
                    <span class="error">*</span>
                    <br><br>
                    Refresh Rate: <input type="text" name= "monitor_refresh_rate">
                    <span class="error">*</span>
                    <br><br>
                    HDMI Quantity: <input type="text" name= "monitor_hdmi_quantity">
                    <span class="error">*</span>
                    <br><br>
                    <input type="submit" name = "monitor_info" value="submit">
                </div>
                </center>
            </fowrm>
        </div>
EOD;
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
    echo ("<html lang = 'en-US'>

    
    
    
    <body><div style='float:right'>
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


    echo("</div></body></html>");

    

   
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
