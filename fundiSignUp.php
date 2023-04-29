<?php
require("Database.php");
$db = new Database();
if (isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbconnect()) { //First check if the connection to the database has been established
        if ($db->signUp("fundis", $_POST['firstname'], $_POST['surname'], $_POST['email'], $_POST['username'], $_POST['password'])) {
            echo "Sign Up is Successful"; //Message to display if the user signup is successful
        } else {
            echo "Sign Up Failed";
        }
    } else {
        echo "Error: Database connection";
    }
} else {
    echo "All fields are required";
}

?>