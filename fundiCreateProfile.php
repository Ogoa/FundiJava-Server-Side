<?php
require("Database.php");
$db = new Database(); //Dynamically create a new Database object
if (
    isset($_POST['fundiID']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['profession']) &&
    isset($_POST['county']) && isset($_POST['experience']) && isset($_POST['availability']) /*&& isset($_POST['package_1']) &&
    isset($_POST['package_1_cost']) && isset($_POST['package_2']) && isset($_POST['package_2_cost']) &&
    isset($_POST['package_3']) && isset($_POST['package_3_cost']) && isset($_POST['package_4']) && isset($_POST['package_4_cost'])*/
) {
    //Taking care of cases where the fundi package fields are left empty or otherwise
    $package1 = isset($_POST['package_1']) && !empty($_POST['package_1']) ? $_POST['package_1'] : null;
    $package1_cost = isset($_POST['package_1_cost']) && !empty($_POST['package_1_cost']) ? $_POST['package_1_cost'] : null;
    $package2 = isset($_POST['package_2']) && !empty($_POST['package_2']) ? $_POST['package_2'] : null;
    $package2_cost = isset($_POST['package_2_cost']) && !empty($_POST['package_2_cost']) ? $_POST['package_2_cost'] : null;
    $package3 = isset($_POST['package_3']) && !empty($_POST['package_3']) ? $_POST['package_3'] : null;
    $package3_cost = isset($_POST['package_3_cost']) && !empty($_POST['package_3_cost']) ? $_POST['package_3_cost'] : null;
    $package4 = isset($_POST['package_4']) && !empty($_POST['package_4']) ? $_POST['package_4'] : null;
    $package4_cost = isset($_POST['package_4_cost']) && !empty($_POST['package_4_cost']) ? $_POST['package_4_cost'] : null;

    if ($db->dbconnect()) { //First check if the connection to the database has been established
        if ($db->createNewProfile(
            "fundiprofiles", 
            $_POST['fundiID'], 
            $_POST['name'], 
            $_POST['gender'], 
            $_POST['profession'], 
            $_POST['county'], 
            $_POST['experience'], 
            $_POST['availability'], 
            // $_POST['package_1'], 
            // $_POST['package_1_cost'], 
            // $_POST['package_2'], 
            // $_POST['package_2_cost'], 
            // $_POST['package_3'], 
            // $_POST['package_3_cost'], 
            // $_POST['package_4'], 
            // $_POST['package_4_cost']
            $package1,
            $package1_cost,
            $package2,
            $package2_cost,
            $package3,
            $package3_cost,
            $package4,
            $package4_cost
            )) {
            echo "Successful"; //Message to display if the user signup is successful
        } else {
            echo "Failed";
        }
        echo "Successful";
    } else {
        echo "Error: Database connection";
    }
} else {
    echo "Enter the required fields";
}


?>