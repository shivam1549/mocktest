<?php
session_start();
require('../admin/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $sql = "SELECT duration, name FROM `tests` WHERE id =?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $timer = $row['duration'];
                    if(!isset($_SESSION['timer'])){
                        $_SESSION['timer'] = time() + ($timer * 60);
                        $endTimestamp = time() + ($timer * 60);
                    }
                    else{
                        $endTimestamp = $_SESSION['timer'];  
                    }

                    $endTimeFormatted = date('H:i:s', $endTimestamp);
                    // Calculate remaining time in seconds
                    $remainingTimeInSeconds = $endTimestamp - time();
                    // Convert remaining time to a readable format (H:i:s)
                    $hours = floor($remainingTimeInSeconds / 3600);
                    $minutes = floor(($remainingTimeInSeconds % 3600) / 60);
                    $seconds = $remainingTimeInSeconds % 60;

                    $remainingTimeFormatted = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    // echo "Remaining Time: " . $remainingTimeFormatted . "<br>";
                    echo json_encode(['remainingTime' => $remainingTimeFormatted]);
                }
            }
        }
    }
}
