<?php
    header("Access-Control-Allow-Origin: http://localhost:3000/reset-pass");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    
    // Include the connection.php file
    require_once 'connection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './phpmailer/src/Exception.php';
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data["email"];
        $token = bin2hex(random_bytes(16));

        $checkStmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Update User Data
            $updateSql = "UPDATE registration SET remember_token = '$token' WHERE email = '$email'";
            if ($conn->query($updateSql) === TRUE) {
                $mail = new PHPMailer(true);
    
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                
                //change the email with your google mail
                $mail->Username = 'edward1997703@gmail.com';
                //change password with you app Password from google
                $mail->Password = 'xbap mpnz xcyp yuht';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                
                //change the email with your google mail
                $mail->setFrom('upwork-test@gmail.com');
            
                $mail->addAddress($email);
            
                $mail->isHTML(true);
            
                $mail->Subject = "Password Reset";
                
                $mail->Body = "Per resettare la Passwrord, clicca sul seguente link: http://localhost:3000/new-pass?token=$token";
            
                $mail->send();
            } else {
                $response = array("status" => "error", "message" => "Error updating user token: " . $conn->error);
                header("Content-Type: application/json");
                echo json_encode($response);
            }
        } else {
            $response = array("status" => "error", "message" => "No user found with this email");
            header("Content-Type: application/json");
            echo json_encode($response);
        }

    
        // header("Location: ../index.php?mail_alert=true");
        
    } else {
        echo "<script> alert('Errore');document.location.href = '../reset_pass.php';</script>";
    }
    
?>
