<?php
session_start();

// Assuming you have a session variable `loggedin` that is set to true when the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

header('Content-Type: application/json');
echo json_encode(['loggedIn' => $loggedIn]);
?>
