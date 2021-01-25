<?php
/**
 * Assignment 3
 * PHP Object Demo
 * 
 * This demonstrates how to create your own 
 * objects, use inheritance, and display the object
 * attributes using PHP.
 * 
 * Author - John G.
 * 
 */


    //This is the superclass that defines what a basic product contains
    //Contains constructor as well as getters and setters
    //Type checking implemented 
    class Product { 
        private $productName;
        private $productPrice;
        private $productQuantity;

        public function __construct($pName, $pPrice, $pQuantity){
            $this->setProductName($pName);
            $this->setProductPrice($pPrice);
            $this->setProductQuantity($pQuantity);
        }

        public function getProductName(){
            return $this->productName;
        }

        public function getProductPrice(){
            return $this->productPrice;
        }

        public function getProductQuantity(){
            return $this->productQuantity;
        }

        public function setProductName($productName){
            $this->productName = $productName;
        }

        public function setProductPrice($productPrice){
            $this->productPrice = $productPrice;
        }

        public function setProductQuantity($productQuantity){
            $this->productQuantity = $productQuantity;
        }

    }

    //This is a subclass of Product. The concept is based off of 
    //the popular "Ember Mug" with bluetooth accessibility (bool) and 
    //color ("string") as variables. 
    class SmartMug extends Product{
        private $bluetoothAccessible;
        private $color;

        public function __construct($pName, $pPrice, $pQuantity, $bluetoothAccessible, $color){
            parent::__construct($pName, $pPrice, $pQuantity);
            $this->setBluetoothAccessible($bluetoothAccessible);
            $this->setColor($color);
        }

        public function getBluetoothAccessible(){
            return $this->bluetoothAccessible;
        }

        public function getColor(){
            return $this->color;
        }

        public function setBluetoothAccessible($bAccessible){
            if(is_bool($bAccessible))
                $this->bluetoothAccessible = $bAccessible;
        }

        public function setColor($color){
            if(is_string($color))
                $this->color = (string) $color;
        }

    }

    //This is a subclass of Product. It is a basic computer monitor object
    //with refresh rate (int) and hdmi input amounts(int) as variables.
    class ComputerMonitor extends Product{
        private $refreshRate;
        private $hdmiInputQuantity;

        public function __construct($pName, $pPrice, $pQuantity, $refreshRate, $hdmiInputQuantity){
            parent::__construct($pName, $pPrice, $pQuantity);
            $this->setRefreshRate($refreshRate);
            $this->setHdmiInputQuantity($hdmiInputQuantity);
        }

        public function getRefreshRate(){
            return $this->refreshRate;
        }

        public function getHdmiInputQuantity(){
            return $this->hdmiInputQuantity;
        }

        public function setRefreshRate($refreshRate){
            if(is_int($refreshRate))
                $this->refreshRate = (int) $refreshRate;
        }

        public function setHdmiInputQuantity($hdmiInputQuantity){
            if(is_int($hdmiInputQuantity))
                $this->hdmiInputQuantity = (int) $hdmiInputQuantity;
        }


    }
    

    //Creation of mug objects
    $mug1 = new SmartMug("Mug1", 50.0, 1, TRUE, "white");
    $mug2 = new SmartMug("Mug2", 30.0, 1, FALSE, "black");

    //Creation of monitor objects
    $monitor1 = new ComputerMonitor("Monitor1", 100.0, 1, 60, 2);
    $monitor2 = new ComputerMonitor("Monitor2", 200.0, 1, 144, 2);

    //2D Array of the objects created
    $productList = array(array($mug1,$mug2,), array($monitor1,$monitor2));                    
    
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

<html lang = "en-US">

<h1><center>Customer Shopping Cart</center></h1>
<table style="width:50%", class = "center">
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Bluetooth Accessible</th>
                <th>Color</th>
                <th>Refresh Rate</th>
                <th>HDMI Input Quantity</th>

            </tr>
            <?php 
                //Enter the arrays rows
                foreach($productList as $productRow){
                    //Look at each item in a given row and print its contents.
                    forEach($productRow as $item){
                        //Checks the type of each item so the table is formatted nicely.
                        if(is_a($item, "SmartMug")){
                            echo("<tr>");
                            echo("<th>".$item->getProductName()."</th>");
                            echo("<th>".$item->getProductPrice()."</th>");
                            echo("<th>".$item->getProductQuantity()."</th>");
                            if(boolval($item->getBluetoothAccessible())){
                                echo("<th>"."TRUE"."</th>");
                            }else {   
                                echo("<th>"."FALSE"."</th>");
                            }
                            echo("<th>".$item->getColor()."</th>");
                            echo("<th> N/A </th>");
                            echo("<th> N/A </th>");

                            echo("</tr>");
                        }
                        elseif(is_a($item, "ComputerMonitor")){
                            echo("<tr>");
                            echo("<th>".$item->getProductName()."</th>");
                            echo("<th>".$item->getProductPrice()."</th>");
                            echo("<th>".$item->getProductQuantity()."</th>");
                            echo("<th> N/A </th>");
                            echo("<th> N/A </th>");
                            echo("<th>".$item->getRefreshRate()."</th>");
                            echo("<th>".$item->getHdmiInputQuantity()."</th>");
                            echo("</tr>");
                        }

                        

                    }
                
                }
                
            ?>

            

        </table>

        <h1><center>PHP Code: </center></h1>
        <div style='border:2px solid black;margin-left:20em; margin-right:15em''>
            <?php echo(show_source("./code.txt", true));?>
        </div>

</html>









