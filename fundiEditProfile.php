<?php
// require("Database.php");
// $db = new Database();

$conn = new mysqli("localhost", "root", "", "my_fundi_app");

if ($conn) {
    $fieldsToUpdate = array();

    // check each POST variable for null value and add to fieldsToUpdate array
    if (!empty($_POST['name'])) {
        $fieldsToUpdate[] = "name = ?";
    }
    if (!empty($_POST['gender'])) {
        $fieldsToUpdate[] = "gender = ?";
    }
    if (!empty($_POST['profession'])) {
        $fieldsToUpdate[] = "profession = ?";
    }
    if (!empty($_POST['county'])) {
        $fieldsToUpdate[] = "county = ?";
    }
    if (!empty($_POST['experience'])) {
        $fieldsToUpdate[] = "experience = ?";
    }
    if (!empty($_POST['availability'])) {
        $fieldsToUpdate[] = "availability = ?";
    }
    if (!empty($_POST['package_1'])) {
        $fieldsToUpdate[] = "package_1 = ?";
    }
    if (!empty($_POST['package_1_cost'])) {
        $fieldsToUpdate[] = "package_1_cost = ?";
    }
    if (!empty($_POST['package_2'])) {
        $fieldsToUpdate[] = "package_2 = ?";
    }
    if (!empty($_POST['package_2_cost'])) {
        $fieldsToUpdate[] = "package_2_cost = ?";
    }
    if (!empty($_POST['package_3'])) {
        $fieldsToUpdate[] = "package_3 = ?";
    }
    if (!empty($_POST['package_3_cost'])) {
        $fieldsToUpdate[] = "package_3_cost = ?";
    }
    if (!empty($_POST['package_4'])) {
        $fieldsToUpdate[] = "package_4 = ?";
    }
    if (!empty($_POST['package_4_cost'])) {
        $fieldsToUpdate[] = "package_4_cost = ?";
    }

    // create SQL statement with only the non-null fields
    $sql = "UPDATE fundiprofiles SET ";
    $sql .= implode(", ", $fieldsToUpdate);
    $sql .= " WHERE fundiID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    // bind parameters for each non-null field
    $paramTypes = str_repeat("s", count($fieldsToUpdate)) . "i";
    $params = array();
    foreach ($fieldsToUpdate as $field) {
        $params[] = $_POST[explode(" = ", $field)[0]];
    }
    $params[] = $_POST['fundiID'];
    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);

    if(mysqli_stmt_execute($stmt)) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: Database connection failed";
}





// require("Database.php");
// $db = new Database();

// $conn = new mysqli("localhost", "root", "", "my_fundi_app");

// if ($conn) {
//     $sql = "UPDATE fundiprofiles SET 
//             name = IF(? IS NOT NULL, ?, name), 
//             gender = IF(? IS NOT NULL, ?, gender), 
//             profession = IF(? IS NOT NULL, ?, profession), 
//             county = IF(? IS NOT NULL, ?, county), 
//             experience = IF(? IS NOT NULL, ?, experience), 
//             availability = IF(? IS NOT NULL, ?, availability), 
//             package_1 = IF(? IS NOT NULL, ?, package_1), 
//             package_1_cost = IF(? IS NOT NULL, ?, package_1_cost), 
//             package_2 = IF(? IS NOT NULL, ?, package_2), 
//             package_2_cost = IF(? IS NOT NULL, ?, package_2_cost), 
//             package_3 = IF(? IS NOT NULL, ?, package_3), 
//             package_3_cost = IF(? IS NOT NULL, ?, package_3_cost), 
//             package_4 = IF(? IS NOT NULL, ?, package_4), 
//             package_4_cost = IF(? IS NOT NULL, ?, package_4_cost) 
//             WHERE fundiID = ?";

//     $stmt = mysqli_prepare($conn, $sql);
//     if (!$stmt) {
//         echo "Error: " . mysqli_error($conn);
//         exit;
//     }

//     mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssi", 
//                             $_POST['name'], $_POST['name'], 
//                             $_POST['gender'], $_POST['gender'], 
//                             $_POST['profession'], $_POST['profession'], 
//                             $_POST['county'], $_POST['county'], 
//                             $_POST['experience'], $_POST['experience'], 
//                             $_POST['availability'], $_POST['availability'], 
//                             $_POST['package_1'], $_POST['package_1'], 
//                             $_POST['package_1_cost'], $_POST['package_1_cost'], 
//                             $_POST['package_2'], $_POST['package_2'], 
//                             $_POST['package_2_cost'], $_POST['package_2_cost'], 
//                             $_POST['package_3'], $_POST['package_3'], 
//                             $_POST['package_3_cost'], $_POST['package_3_cost'], 
//                             $_POST['package_4'], $_POST['package_4'], 
//                             $_POST['package_4_cost'], $_POST['package_4_cost'], 
//                             $_POST['fundiID']);

//     if(mysqli_stmt_execute($stmt)) {
//         echo "Update successful";
//     } else {
//         echo "Update failed";
//     }
//     mysqli_stmt_close($stmt);
// } else {
//     echo "Error: Database connection failed";
// }

?>