<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../connection.php';
require_once './Event.php';
require_once '../phpmailer/src/Exception.php';
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';

$data = json_decode(file_get_contents("php://input"), true);

// Check id
if (isset($data['event_id']) && is_numeric($data['event_id'])) {
    $eventID = $data['event_id'];
    $attendees = $data['attendees'];
    $nome_evento = $data['nome_evento'];
    $data_evento = $data['data_evento'];

    echo "UPDATE eventi SET nome_evento = '" . $nome_evento . "', data_evento = '" . $data_evento . "', attendees = '" . $attendees . "' WHERE id = '" . $eventID . "';";

    // used sql code
    $stmt = $conn->execute_query("UPDATE eventi SET nome_evento = '" . $nome_evento . "', data_evento = '" . $data_evento . "', attendees = '" . $attendees . "' WHERE id = '" . $eventID . "';");

    if ($stmt == true) {

        $mail_list = explode(',', $attendees);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        //change the email with your google mail
        $mail->Username = 'johndevis112@gmail.com';
        //change password with you app Password from google
        $mail->Password = 'richardivory112!';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //change the email with your google mail
        $mail->setFrom('johndevis112@gmail.com');

        foreach ($mail_list as $user_mail) {
            //cycle for every mail
            $mail->addAddress(trim($user_mail));
            $mail->isHTML(true);
            $mail->Subject = "Aggiornamento: Modifica evento";
            $mail->Body = "E' stato modificato un evento a cui partecipi";

            $mail->send();

            $mail->ClearAllRecipients();

        }
    } else {
        echo "Error updating event.";
    }
} else {
    echo "Errore durante la modifica dell'evento.";
}

?>
