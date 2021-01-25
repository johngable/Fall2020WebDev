<?php
/**
 * Assignment 4 - PHP Database Demo
 * 
 * This file is used to create tables, fill the tables, 
 * select from the tables, and load the result sets into an
 * HTML table for display.
 * 
 * I utilized php functions to reduce monolithic code as well.
 * 
 * Author - John G. 
 */

$hostname = "localhost";
$database = "webprog10";
$username = "webprog10";
$password = "perozzot";

$conn = new mysqli($hostname, $username, $password, $database);

//Attempt to connect, if not dump error
if ($conn->connect_error) die($conn->connect_error);

//Clean the database prior to other actions (Drop preexisting tables)
cleanDB($conn);

//Create the object tables
createMugTable($conn);
createComputerMonitorTable($conn);

//Fill tables with 10 objects each
fillMugTable($conn);
fillMonitorTable($conn);

//Select objects from the tables to add them to web page table
$mugResults = selectMugObjects($conn);
$monitorReults = selectMonitorObjects($conn);

//Builds the HTML Table using the result sets from the select statements
buildWebPageTable($mugResults, $monitorReults);

?>



<?php

/**
 * These are functions for creating and filling tables
 * They take in the connection variable conn from the main php above, 
 * and then run the statements created.
 **/

 //Function to clean the database by dropping the tables
function cleanDB($conn){
    //Drop the SmartMug table
    $query = "DROP TABLE SmartMug;";
    $result = $conn->query($query);
    if (!result) echo "Drop Failed!";

    //Drop the ComputerMonitor table
    $query = "DROP TABLE ComputerMonitor;";
    $result = $conn->query($query);
    if (!result) echo "Drop Failed!";
}

//Creates the mug table statement
function createMugTable($conn){
    $query = "Create Table SmartMug(
        id int not null AUTO_INCREMENT,
        name varchar(30), 
        price float, 
        quantity int, 
        bluetoothAccess boolean, 
        color varchar(15),
        primary key (id)
        )";

    $result = $conn->query($query);
    if (!result) echo "Creation Failed!: ";
}

//Creates the computer monitor table
function createComputerMonitorTable($conn){
    $query = "Create Table ComputerMonitor(
        id int not null AUTO_INCREMENT,
        name varchar(30), 
        price float, 
        quantity int, 
        refreshRate int, 
        hdmiInputQuantity int,
        primary key (id)
        )";

    $result = $conn->query($query);
    if (!result) echo "Creation Failed!: ";
}

//Fills SmartMug table with 10 random objects
function fillMugTable($conn){
    //Insert first 5 rows
    $i=0;
    while($i<5){
        $query = "Insert into SmartMug(name, price, quantity, bluetoothAccess, color) values('smartmug".$i."', 49.99, 1, 0, 'white')";

        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
        $i++;

    }

    //Insert last 5 rows
    $i=5;
    while($i<10){
        $query = "Insert into SmartMug(name, price, quantity, bluetoothAccess, color) values('smartmug".$i."', 99.99, 1, 1, 'black')";

        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
        $i++;

    }
    
}

//Fills ComputerMonitor table with 10 random objects
function fillMonitorTable($conn){
    //Insert first 5 rows
    $i=0;
    while($i<5){
        $query = "Insert into ComputerMonitor(name, price, quantity, refreshRate, hdmiInputQuantity) values('Gaming Monitor".$i."', 149.99, 1, 144, 3)";

        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
        $i++;

    }

    //Insert last 5 rows
    $i=5;
    while($i<10){
        $query = "Insert into ComputerMonitor(name, price, quantity, refreshRate, hdmiInputQuantity) values('Office Monitor".$i."', 79.99, 1, 60, 2)";

        $result = $conn->query($query);
        if (!result) echo "Creation Failed!: ";
        $i++;

    }
    
}

//Selects all from mug table and returns result set
function selectMugObjects($conn){
    //Select objects
    $query = "select * from SmartMug";
    $result = $conn->query($query);
    if (!result) echo "Drop Failed!";

    return $result;
}

//Selects all from computer monitor table and returns result set
function selectMonitorObjects($conn){
    //Select objects
    $query = "select * from ComputerMonitor";
    $result = $conn->query($query);
    if (!result) echo "Drop Failed!";

    return $result;
}

//Takes in both resutls sets and builds the entire HTML Table frmo them
function buildWebPageTable($mugResults, $monitorResults){

    
    //Begin creating table
    echo ("<html lang = 'en-US'>

    
    <h1><center>Customer Shopping Cart</center></h1>
    
    <body>
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

    echo(show_source("./PHP_DB.php"));

    echo("</body></html>");

    

   
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
</style>






