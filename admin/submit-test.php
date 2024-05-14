<?php
require("db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$title = $_POST['title'];
$duration = $_POST['duration'];

$sqltestexist = "SELECT name FROM tests WHERE name = ?";
$stmt = $mysqli->prepare($sqltestexist);
$stmt->bind_param("s", $title);
if($stmt->execute()){
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo "Test already exists.";
    } else {
        $sql = "INSERT INTO tests (name, duration) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sd", $title, $duration);
        if($stmt->execute()){
            echo "Record Inserted";
        }
        else{
            echo "Error inserting record: " . $stmt->error;
        }
        $stmt->close();
    }
}
}
else{
    echo "Invalid Request";
}
?>