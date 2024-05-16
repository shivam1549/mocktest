<?php
require('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT name, duration FROM tests WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {


                $row = $result->fetch_assoc();
                $data = [
                    "name" => $row['name'],
                    "duration" => $row['duration']
                ];
                echo json_encode($data, true);
            } else {
                echo json_encode(["error" => "No data found"]);
            }
        }
    } else {
        echo json_encode(["error" => "'id' parameter is missing"]);
    }
}
