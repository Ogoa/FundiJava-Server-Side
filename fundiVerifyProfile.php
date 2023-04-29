<?php
require("Database.php");
$db = new Database(); //Dynamically a new Database object
if (isset($_POST['username'])) {
    if ($db->dbConnect()) { //First check if the connection to the database has been established
        $verifyProfileResult = $db->verifyProfile("fundis"/*Name of the table in the database*/, $_POST['username']);
        if ($verifyProfileResult['verify']) { //If the query is succussful and the $verify returns a true value
            $response = array(
                'message' => 'Successful', //Message to display if the record is found
                'fundiID' => $verifyProfileResult['fundiID']
            );
            echo json_encode($response); //Return the response as a JSON object
        } else {
            $response = array(
                'message' => "The Fundi Username was not found", //Message to display if the record is not found/does not exist
                'fundiID' => $verifyProfileResult['fundiID'] //In this case, the fundiID will simply hold a null value
            );
            echo json_encode($response); //Return the response as a JSON object
        }
    } else {
        echo "Error: Database connection not established";
    }
} else {
    echo "Please enter your fundi username";
}

?>