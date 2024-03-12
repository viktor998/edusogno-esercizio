<?php
    header("Access-Control-Allow-Origin: http://localhost:3000/new-pass");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");

    require_once 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = json_decode(file_get_contents("php://input"), true);
        $token = $data["token"];
        $newPassword = $data["new_pass"];
        $confirmPassword = $data["confirmpassword"];

        if($newPassword === $confirmPassword){
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("SELECT * FROM registration WHERE remember_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $updateSql = "UPDATE registration SET password = '$newPasswordHash' WHERE remember_token = '$token'";
                if ($conn->query($updateSql) === TRUE) {
                    $response = array("status" => "success", "message" => "Password changed successfully!");
                    header("Content-Type: application/json");
                    echo json_encode($response);
                }
            }else {
                $response = array("status" => "error", "message" => "user does not match");
                header("Content-Type: application/json");
                echo json_encode($response);
            }
    
            // Close the PDO connection
            // $pdo = null;
        }else{
            $response = array("status" => "error", "message" => "Passwords does not match");
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => "Invalid request.");
        header("Content-Type: application/json");
        echo json_encode($response);
    }
