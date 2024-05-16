<?php
require('../db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['title'];
    $duration = $_POST['duration'];

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
?>