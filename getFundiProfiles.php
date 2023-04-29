<?php
require("Database.php");
$db = new Database();

$conn = $db->dbConnect();

$stmt = $conn->prepare("SELECT fundiProfileID, fundiID, name, gender, profession, county, experience, availability, package_1, package_1_cost, package_2, package_2_cost, package_3, package_3_cost, package_4, package_4_cost FROM fundiprofiles"); #Prepare the sql statement that will be used to execute the query on the fundi profiles table
$stmt->execute(); //Execute the sql query
$stmt->bind_result(
    //Storage of the query results
    $fundiProfileID,
    $fundiID,
    $fundiName,
    $fundiGender,
    $fundiProfession,
    $fundiCounty,
    $fundiExperience,
    $fundiAvailability,
    $package1,
    $package1cost,
    $package2,
    $package2cost,
    $package3,
    $package3cost,
    $package4,
    $package4cost
);
$fundis = array(); //This will be an array of arrays; storing several arrays representing individual records in one big array

while ($stmt->fetch()) {
    $temp = array(); //This is an array to temporarily store the fields of each record while iterating through the table

    $temp['fundiProfileID'] = $fundiProfileID;
    $temp['fundiID'] = $fundiID;
    $temp['name'] = $fundiName;
    $temp['gender'] = $fundiGender;
    $temp['profession'] = $fundiProfession;
    $temp['county'] = $fundiCounty;
    $temp['experience'] = $fundiExperience;
    $temp['availability'] = $fundiAvailability;
    $temp['package_1'] = $package1;
    $temp['package_1_cost'] = $package1cost;
    $temp['package_2'] = $package2;
    $temp['package_2_cost'] = $package2cost;
    $temp['package_3'] = $package3;
    $temp['package_3_cost'] = $package3cost;
    $temp['package_4'] = $package4;
    $temp['package_4_cost'] = $package4cost;

    array_push($fundis, $temp); //Append each record to the '$fundis' array
}

echo json_encode($fundis); //Return the queried information as a JSON

?>