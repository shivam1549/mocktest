<?php
require('../db.php');
$sql = "SELECT id, name, duration, created_at FROM tests ORDER BY ID DESC";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Add each row to the $data array
            }

            // Optionally, you can do something with $data here, like:
            echo json_encode($data);
        } else {
            echo json_encode(["message" => "No records found"], true);
        }
    } else {
        echo json_encode(["message" => "Error occurred"], true);
    }
    $stmt->close();
} else {
    echo json_encode(["message" => "Error occurred"], true);
}

$mysqli->close();
?>
