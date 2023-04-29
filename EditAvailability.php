<?php
$conn = new mysqli("localhost", "root", "", "my_fundi_app");

if ($conn) {
    $sql = "UPDATE fundiprofiles SET availability = '1' WHERE fundiID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST['fundiID']);
    if (mysqli_stmt_execute($stmt)) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: Database connection failed";
}


?>