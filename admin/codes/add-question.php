<?php
require("../db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = isset($_POST['question']) ? trim($_POST['question']) : '';
    $op1 = isset($_POST['op1']) ? trim($_POST['op1']) : '';
    $op2 = isset($_POST['op2']) ? trim($_POST['op2']) : '';
    $op3 = isset($_POST['op3']) ? trim($_POST['op3']) : '';
    $op4 = isset($_POST['op4']) ? trim($_POST['op4']) : '';
    $rightanswer = isset($_POST['rightanswer']) ? trim($_POST['rightanswer']) : '';
    $marks = isset($_POST['marks']) ? intval($_POST['marks']) : 0;
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';

    $sqlquestexist = "SELECT question FROM questions WHERE question = ? AND testid = ?";
    $stmt = $mysqli->prepare($sqlquestexist);
    $stmt->bind_param("si", $question, $id);
    if($stmt->execute()){
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo json_encode(["error" => "Question Already exist in this test"]);
    } else {
        $sql = "INSERT INTO questions (testid, question, op1, op2, op3, op4, rightanswer, marks)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
   
            $stmt->bind_param("issssssi", $id, $question, $op1, $op2, $op3, $op4, $rightanswer, $marks);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(["success" => "Added successfully"]);
        }
        else{
            echo json_encode(["error" => "Error inserting record: " . $stmt->error]);
      
        }
        $stmt->close();
    }
}
}
else{
    echo json_encode(["error" => "Some error"]);
}
}
?>