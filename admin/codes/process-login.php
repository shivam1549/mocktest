<?php
session_start();
require('../db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        // $id = $_POST['id'];
        $pass = $_POST['password'];
        $sql = "SELECT username, pass FROM `admin` WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {


                $row = $result->fetch_assoc();
                if (password_verify($pass, $row['pass'])) {
                    $_SESSION['adminloggedin'] = true;
                    echo json_encode(["success" => "logged"]);
                }
                else{
                    echo json_encode(["error" => "Incorrect password"]);   
                }
             
            } else {
                echo json_encode(["error" => "username not found"]);
            }
        }
    } else {
        echo json_encode(["error" => "Please enter username and password"]);
    }
}
?>