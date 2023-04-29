<?php
require "Database.php";
$db = new Database(); //Dynamically create a new Database object
if (isset($_POST['username']) && isset($_POST['password'])) { //Check if the user has entered text in both input fields
    if ($db->dbConnect()) { //First check if the connection to the database has been established
        if ($db->logIn("users"/*Name of the table in the database*/, $_POST['username'], $_POST['password'])) {
            echo "Login Success"; //Message to display if the login is successful
        } else { 
            echo "The Username or Password entered are incorrect";
        }
    } else {
        echo "Error: Database connection not established";
    }
} else {
    echo "All fields are required";
}

?>