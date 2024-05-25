<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../admin/db.php');

// Sample response structure
$response = ['success' => false, 'message' => ''];

// Get POST data
$email = mysqli_real_escape_string($mysqli, $_POST['email']) ?? '';
$password = mysqli_real_escape_string($mysqli, $_POST['password']) ?? '';

// Check if user exists in the database
$sql = "SELECT id, name, passwords FROM users WHERE email = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($userid, $username, $hashedPassword);
            $stmt->fetch();
            // Verify password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['userdetails'] = [
                    "id" => $userid,
                    "name" => $username,
                ];
                $response['success'] = true;
                $response['message'] = 'Login success';
            } else {
                $response['message'] = 'Incorrect password';
            }
        } else {
            $response['message'] = 'User not found';
        }
    } else {
        $response['message'] = 'Error executing statement: ' . $stmt->error;
    }
    $stmt->close();
} else {
    $response['message'] = 'Error preparing statement: ' . $mysqli->error;
}

// Return the response as JSON
echo json_encode($response);
