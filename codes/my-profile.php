<?php
require('../admin/db.php');
session_start();

// Assuming you have a session variable `loggedin` that is set to true when the user is logged in
if (isset($_SESSION['userdetails'])) {
    $userid = $_SESSION['userdetails']['id'];
    $username = $_SESSION['userdetails']['name'];

    $sql = "SELECT username, testdetails, testname, created_at FROM saved_questions WHERE userid = ? ORDER BY created_at DESC";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $userid);
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
                    $date = new DateTime($row['created_at']);
                    $testname = json_decode($row['testname'], true);
                    $data[] = [
                        "testname" => $testname['test'],
                        "totmarks" => $marks,
                        "attempted" => $attempted,
                        "total" => count($testdetail),
                        "date" => $date->format('d M Y'),

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
