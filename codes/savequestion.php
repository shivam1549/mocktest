<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the URL-encoded JSON string
    if (isset($_POST['questions'])) {
        $questionsStr = $_POST['questions'];

        // Decode the URL-encoded JSON string
        $questions = json_decode(urldecode($questionsStr), true);

        // Validate the JSON data
        if ($questions !== null) {
            // Save the data to the session
            $_SESSION['questions'] = $questions;
            echo json_encode(["status" => "success"]);
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid JSON data"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "No questions data found"]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
