<?php
session_start();
require('../admin/db.php');

$sql = "SELECT id, name, duration FROM tests ORDER BY ID DESC";
$stmt = $mysqli->prepare($sql);
if ($stmt) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "duration" => $row['duration']
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
        else{
            echo json_encode("No test found");
        }
        $stmt->close();
       
    }
}
else{
    echo json_encode(["error" => "Preparation failed: " . $mysqli->error], true);
}
$mysqli->close();
