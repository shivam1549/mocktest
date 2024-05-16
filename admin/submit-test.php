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
            $last_id = $mysqli->insert_id;
            // echo "Record Inserted";
            $msg = [
                'status' => "Record Inserted",
                'lastid' => $last_id,
            ];
            // print_r($msg);
            echo json_encode($msg, true);
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