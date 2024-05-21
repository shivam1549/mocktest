<?php
session_start();
require('../admin/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['questions'])) {
        echo json_encode($_SESSION['questions']);
    }
    else{
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $sql = "SELECT id,testid,question,op1,op2,op3,op4,rightanswer,marks FROM questions WHERE testid = ?";
    $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $data = [];

                    while ($row = $result->fetch_assoc()) {
                        $data[] = [
                            "id" => $row['id'],
                            "quest" => $row['question'],
                            "op1" => $row['op1'],
                            "op2" => $row['op2'],
                            "op3" => $row['op3'],
                            "op4" => $row['op4'],
                            "answer" => $row['rightanswer'],
                          
                        ];
                    }

                    echo json_encode($data, true);
                } else {
                    echo json_encode(["message" => "No records found"], true);
                }
            } else {
                echo json_encode(["error" => "Execution failed: " . $stmt->error], true);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Preparation failed: " . $mysqli->error], true);
        }

        $mysqli->close();
    }

}
?>