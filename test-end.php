<?php
require('admin/db.php');
session_start();
if(isset($_SESSION['userdetails'])){
    $userid = $_SESSION['userdetails']['id'];
    $username = $_SESSION['userdetails']['name'];
    if (isset($_SESSION['questions'])) {
        $testdetails = json_encode($_SESSION['questions'], true);

        if(isset($_SESSION['testdata'])){
            // $name = $_SESSION['testdata']['test'];
            // $duration = $_SESSION['testdata']['duration'];
            $testname = json_encode($_SESSION['testdata'], true);
            $sql = "INSERT INTO saved_questions (userid, username, testdetails, testname) VALUES (?,?,?,?)";
            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
                // Bind parameters
                $stmt->bind_param("isss", $userid, $username, $testdetails, $testname);
                 // Execute the statement
                 if ($stmt->execute()) {
                    unset($_SESSION['timer']);
                    unset($_SESSION['testdata']);
                    unset($_SESSION['questions']);
                    echo json_encode(["message" => "Test details saved successfully"]);
                } else {
                    echo json_encode(["message" => "Failed to save test details"]);
                }

                $stmt->close();
            } else {
                echo json_encode(["message" => "Failed to prepare the SQL statement"]);
            }


        }
        else{
            echo json_encode(["message" => "Test not saved please contact to admin"]); 
        }

    }
    else{
        echo json_encode(["message" => "Test not saved please contact to admin"]);
    }

}
else{
    echo json_encode(["message" => "User details not found"]);
}
?>