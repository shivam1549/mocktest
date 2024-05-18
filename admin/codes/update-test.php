<?php
require('../db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['title'];
    $duration = $_POST['duration'];

    $sqltestexist = "SELECT name FROM tests WHERE name = ? AND id != ?";
    $stmt = $mysqli->prepare($sqltestexist);
    $stmt->bind_param("si", $name, $id);
    if($stmt->execute()){
        $stmt->store_result();

    if ($stmt->num_rows !== 1) {
        $sql = "UPDATE tests SET name = ?, duration =? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
        $stmt->bind_param("sdi", $name, $duration, $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => "Updated successfully"]);
        }
        else{
            echo json_encode(["error" => "Some error"]);
        }
    } 
}
else{
    echo json_encode(["error" => "Exist"]);
}
    }
}



?>