<?php
require('../admin/db.php');
session_start();

// Assuming you have a session variable `loggedin` that is set to true when the user is logged in
if (isset($_SESSION['userdetails'])) {
    $userid = $_SESSION['userdetails']['id'];
    $username = $_SESSION['userdetails']['name'];

    $sql = "SELECT username, testdetails, testname FROM saved_questions";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $marks = 0;
                    $attempted = 0;
                    $testdetail = json_decode($row['testdetails'], true);
                    foreach($testdetail as $test){
                        if($test['selectedans'] === $test['answer']){
                            $marks += 1;
                        }
                        if($test['state'] == 'answered'){
                            $attempted += 1;
                        }
                    }
                    $testname = json_decode($row['testname'], true);
                    $data[] = [
                        "testname" => $testname['test'],
                        "totmarks" => $marks,
                        "attempted" => $attempted,
                        "total" => count($testdetail)

                    ];
                }

                echo json_encode(["data" => $data]);
            }
            else {
                echo json_encode(["error" => "No records found"], true);
            }
        }
        else {
            echo json_encode(["error" => "Execution failed: " . $stmt->error], true);
        }
    }
    else {
        echo json_encode(["error" => "Preparation failed: " . $mysqli->error], true);
    }
}
