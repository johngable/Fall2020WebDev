
<?php
/**
 * This assignment demonstrates basic authentication using html forms, as well
 * as persisting logins using sessions/cookies in php.
 * 
 * Passwords were created using the php_default hash function which by default
 * salts the given passwords as well as hashing.
 * 
 * Assignment 6 - John G.
 */

    session_start();

    // Optional Debugging mode
     ini_set('error_reporting', E_ALL);
     ini_set('display_errors', true);

    require_once './login.php';
    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) die($conn->connect_error);

    //Initialize the user table and add the Default login
    //drop_user_table($conn);
    //create_user_table($conn);
    //add_user($conn);

    //Check to see if username and password were passed into the login form
    if(isset($_POST['user']) && isset($_POST['password'])){
        $tempUser = $_POST['user'];
        $tempPassword = $_POST['password'];

        //Retrieve password for given user from database
        $query = ("select * FROM users WHERE username='$tempUser';");
        $result = $conn->query($query);
        
        if($result->num_rows == 1){

            $row = $result->fetch_array(MYSQLI_NUM);

            //Use php pw verify function to compare password to the hashed
            if(password_verify($tempPassword, $row[1])){

                //If match -> set session variable for loggin in user
                $_SESSION['username'] = $_POST['user'];
                $_SESSION['password'] = $_POST['password'];
                setcookie('user', $_POST['user'], time() + (10), "/");

                show_logged_in($conn);
            }else{
                echo "Wrong password";
            }
        }else{
            echo "User : '$tempUser' not found";
        }
       
        
    }elseif(!empty(($_POST['logout']))){

        //When logout is pressed, destroy and unset the session as well as redisplay the login page
        session_unset();
        session_destroy(); 
        setcookie("user", "", time() - 3600);
        show_log_in();

    }elseif(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_COOKIE['user'])){
        //If session variables are set, allow the user to see the login page
        show_logged_in($conn);  
    }else{
        
        //Display user login page
        show_log_in();

    }

    /**
     * Drops the existing users table in order to reset to default
     */
    function drop_user_table($conn){
        //Drop the SmartMug table
        $query = "DROP TABLE users;";
        $result = $conn->query($query);
        if (!$result) echo "Drop Failed!";

    }
    /**
     * Creates the user table in sql.
     * Contains unique username and a password
     */
    function create_user_table($conn){
        $insert = "Create table users(
        username VARCHAR(20) NOT NULL UNIQUE,
        password VARCHAR(500) NOT NULL
        );";
        
        $result = $conn->query($insert);
        if(!$result) die("Could not create users table");
    }

    /**
     * Adds given user into the user table.
     */
    function add_user($conn){
        $username = 'Admin';
        $password = 'Password';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $statement = ("Insert into users values('$username','$hash')");
        $result = $conn->query($statement);
        if (!$result) echo "Default insert failed!: ";
    }

    /**
     * Shows the logged in page which contains the database contents for users table,
     * as well as the code to craete the entire program.
     */
    function show_logged_in($conn){
        $query = ("select * FROM users;");
        $result = $conn->query($query);
        
        $resultRows = $result->num_rows;
        for($i=0;$i<$resultRows;$i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_NUM);
            echo("Username'$i' : ".$row[0]);
            echo("<br>");
            echo("Password'$i' : ".$row[1]);
            echo("<br>");
        }
        echo("<br>");
        echo(show_source("./PHP_Login.php"));
        echo('<form align="right" name="logout_form" method="post" action="PHP_Login.php">
                <label class="logout">
                <input name="logout" type="submit" id="logout" value="Logout">
                </label>
            </form>');
    }


    /**
     * Displays basic login form
     */
    function show_log_in(){
        echo "<h1><center>To Login - Username = 'Admin' Password = 'Password'</center></h1>";
        
        echo('<form action="PHP_Login.php" method="post">
            <div>
                <center>
                    User <input type="text" name="user">
                    <br>
                    Password <input type="text" name="password">
                    <br>
                    <input type="submit" value="LOG IN">
                </center>
            </div>
        </form>');
    }


    

?>


<style>
    .logout{

    position:fixed;
    right:10px;
    top:5px;
    }
</style>
