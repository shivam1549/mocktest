<?php
class getAdmindata
{

    function getAlluser()
    {
        global $mysqli;
        $sqluser = "SELECT * FROM users ORDER BY created_at DESC";
        $stmtuser = $mysqli->prepare($sqluser);
        if ($stmtuser) {
            // $stmtuser->bind_param("i", $userid);
            if ($stmtuser->execute()) {
                $result = $stmtuser->get_result();
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }

                    return $data;
                    
                }
                else{
                    return false;
                }
            }
        }
    }

    function getData()
    {
        global $mysqli;

        $sqluser = "SELECT COUNT(id) AS totusers FROM users";
        $stmtuser = $mysqli->prepare($sqluser);
        if ($stmtuser) {
            // $stmtuser->bind_param("i", $userid);
            if ($stmtuser->execute()) {
                $result = $stmtuser->get_result();
                if ($result) {
                    $row = $result->fetch_assoc();
                    $totuser = $row['totusers'];
                }
            }
        }

        $sqltest = "SELECT COUNT(id) AS tottests FROM `tests`";
        $stmttest = $mysqli->prepare($sqltest);
        if ($stmttest) {
            // $stmttest->bind_param("i", $testid);
            if ($stmttest->execute()) {
                $result = $stmttest->get_result();
                if ($result) {
                    $row = $result->fetch_assoc();
                    $testststol = $row['tottests'];
                }
            }
        }


        $sqlattempt = "
    SELECT 
        JSON_EXTRACT(testname, '$.test') AS test_name,
        COUNT(*) AS attempt_count
    FROM 
        saved_questions
    GROUP BY 
        JSON_EXTRACT(testname, '$.test')
    ORDER BY 
        attempt_count DESC
    LIMIT 1;
";

        $stmt = $mysqli->prepare($sqlattempt);

        if ($stmt) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $test_name = $row['test_name'];
                    $attempt_count = $row['attempt_count'];

                    $testattemp = [
                        "attemptedcount" => $attempt_count,
                        "testname" => $test_name
                    ];
                }
            }
        }


        $sqlcounttoday = "
    SELECT COUNT(id) AS test_count 
    FROM saved_questions 
    WHERE DATE(created_at) = CURDATE();
";

        $stmt = $mysqli->prepare($sqlcounttoday);

        if ($stmt) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $test_count = $row['test_count'];
                }
            }
        }

        $data = [
            "totuser" => $totuser,
            "testststol" => $testststol,
            "testattemp" => $testattemp,
            "test_count" => $test_count
        ];


        return $data;
    }
}
