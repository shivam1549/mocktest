<?php
 require('../db.php');
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $question = $_POST['question'];
     $op1 = $_POST['op1'];
     $op2 = $_POST['op2'];
     $op3 = $_POST['op3'];
     $op4 = $_POST['op4'];
     $rightanswer = $_POST['rightanswer'];
     $marks = $_POST['marks'];
     $id = $_POST['id'];

     $sqltestexist = "SELECT question FROM questions WHERE question = ? AND id != ?";
     $stmt = $mysqli->prepare($sqltestexist);
     $stmt->bind_param("si", $question, $id);
     if ($stmt->execute()) {
         $stmt->store_result();
         
         if ($stmt->num_rows === 0) { 
             $sql = "UPDATE questions SET question = ?, op1 = ?, op2 = ?, op3 = ?, op4 = ?, rightanswer = ?, marks = ? WHERE id = ?";
             $stmt = $mysqli->prepare($sql);
             if ($stmt) {
                 $stmt->bind_param("ssssssii", $question, $op1, $op2, $op3, $op4, $rightanswer, $marks, $id);
                 if ($stmt->execute()) {
                     echo json_encode(["success" => "Updated successfully"]);
                 } else {
                     echo json_encode(["error" => "Some error occurred during update"]);
                 }
             } else {
                 echo json_encode(["error" => "Failed to prepare the update statement"]);
             }
         } else {
             echo json_encode(["error" => "Question already exists"]);
         }
     } else {
         echo json_encode(["error" => "Failed to execute the select statement"]);
     }
     $stmt->close();
 } else {
     echo json_encode(["error" => "Invalid request method"]);
 }
 ?>
 

