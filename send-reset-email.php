<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . "/Helpers/DB.php";
/* require_once __DIR__ . "/vendor/phpmailer/phpmailer/src/PHPMailer.php"; */

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['email'])) {
    $connection = DB::connect();
    $email = $_POST['email'];

    $sql = "SELECT `email` FROM `utenti` WHERE `email` = '$email'";
    /** TODO bind_param && creare metodo in User class */
    $statement = $connection -> prepare($sql);

    $statement -> execute();
    $result = $statement->get_result();

    if($result->num_rows > 0) {
        var_dump("esiste");

        $link = "<a href='http://localhost:8888/PHP/edusogno-esercizio/reset-password.php?key=" . $email . "'>Click To Reset password</a>";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '9fd77901b79629';
        $mail->Password = '6ee6e46db8f1d6';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($email, 'Joe User');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = $link;
        $mail->AltBody = 'http://localhost:8888/PHP/edusogno-esercizio/reset-password.php?key=" . $email . "';

        $mail->send();

        if($mail->send()) {
            echo "Check Your Email and Click on the link sent to your email";
        } else {
            echo "Mail Error - >" . $mail->ErrorInfo;
        }
    } else {
        var_dump('non esiste');
        DB::disconnect($connection);
    }

}


session_write_close();
