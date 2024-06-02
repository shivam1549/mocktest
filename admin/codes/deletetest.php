<?php
require('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare and execute the SQL statement to delete the test
        $stmt = $mysqli->prepare("DELETE FROM `tests` WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Prepare and execute the SQL statement to delete associated questions
            $stmt_questions = $mysqli->prepare("DELETE FROM `questions` WHERE testid = ?");
            $stmt_questions->bind_param("i", $id);
            
            if ($stmt_questions->execute()) {
                $response = ["success" => true];
            } else {
                $response = ["success" => false, "error" => "Failed to delete questions"];
            }
            $stmt_questions->close();
        } else {
            $response = ["success" => false, "error" => "Failed to delete test"];
        }
        $stmt->close();
    } else {
        $response = ["success" => false, "error" => "No ID provided"];
    }

    echo json_encode($response);
}
?>
