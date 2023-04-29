<?php
require("Database.php");
$db = new Database();
if (isset($_POST['fundiID'])) {
    if ($db->dbConnect()){
        if ($db->queryProfile("fundiprofiles", $_POST['fundiID'])) {
            /* This if statement will be used to check if a registered fundi has an existing profile or not.*/
            echo "Successful"; //With this message, the fundi will be directed to the EditFundiProfile fragment of the application
        } else {
            echo "Profile does not exist"; //With this message, the fundi will be directed to the CreateFundiProfile fragment of the application
        }
    } else {
        echo "Error: Database connection not established";
    }
} else {
    echo "Error!";
}

?>