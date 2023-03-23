<?php
session_start();
// UTILIZZO DI PHPMAILER E MAILTRAP

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include("connection.php");
include("functions.php");
require 'vendor/autoload.php';

$_SESSION['message']='';
if($_SERVER['REQUEST_METHOD']==="POST"){
    $usermailfield=$_POST['usermailfield'];}

$sql = "SELECT * FROM utenti WHERE email='$usermailfield' LIMIT 1";
$result= mysqli_query($conn, $sql);
$user_info=mysqli_fetch_assoc($result);

if(!empty($usermailfield) && mysqli_num_rows($result)==0){

    $_SESSION['message']="E-mail non presente nel nostro database";

}elseif($result && mysqli_num_rows($result)>0){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            ); 
        $mail->SMTPDebug = 2;                                        
        $mail->Host       = 'sandbox.smtp.mailtrap.io';              
        $mail->SMTPAuth   = true;                 
        $mail->Username   = '6b4d204ca14e38';      
        $mail->Password   = '30df617d6a8bb8';      
        $mail->SMTPSecure = false;     
        $mail->Port       = 2525;
        $mail->setFrom('Deb@edusognomail.com', 'TeamEdusogno');
        $mail->addAddress($usermailfield, $user_info['nome'].' '.$user_info['cognome']); 
    
       
        $mail->isHTML(true);                                 
        $mail->Subject = 'Ripristina la tua password';
        $mail->Body    = '<h3>Gentile '.ucfirst($user_info['nome']). ',</h3><br><p>Puoi ripristinare una nuova password&nbsp;<a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/edusogno-esercizio/change-password.php">a questo indirizzo</a>.</p><br>';
        $mail->AltBody = 'Gentile '.ucfirst($user_info['nome']).', per ripristinare una nuova password vai all\'indirizzo '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/edusogno-esercizio/change-password.php';
    
        $mail->send();
        echo 'Message has been sent';
        $_SESSION['message']="Abbiamo inviato una e-mail al tuo indirizzo per il recupero della password"; 
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}else{
      $_SESSION['message']='';
   }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edusogno</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    
    <!-- <div class="bg"> -->
        <img src="assets/img/Vector 5.png" alt="vector5" id="vector-5">
        <img src="assets/img/Vector 4.png" alt="vector4" id="vector-4">
        <img src="assets/img/Vector 1.png" alt="vector1" id="vector-1">
        
        <img src="assets/img/rocket.svg" alt="rocket" id="rocket">
        <div id="circle-1" class="circle"></div>
        <div id="circle-2" class="circle"></div>
    <!-- </div> -->
    <header>
        <nav>
            <img src="assets/img/Logo-edusogno.png" alt="logo">
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>
                Modifica password
            </h2>
            <div class="form-container">
            <?php if($_SESSION['message']):?>
                        <p style="color:red"><?php echo $_SESSION['message'] ;?></p>
                    <?php endif ;?>
               <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <label for="email">
                        Inserisci la tua e-mail
                    </label>
                    <div class="input-field">
                        <input type="email" name="usermailfield" placeholder="name@example.com" id="email" required>
                        <span class="focus-border"></span>
                       
                    </div>                    
                    <input type="submit" id="button-l" value="RICHIEDI NUOVA PASSWORD">
                    
                </form>
                <div class="links">
                <p><strong><a href="register.php">Registrati</a></strong> | <strong><a href="login.php">Accedi</a></strong></p>
                </div>
                
            </div>
        </div>
    </main>
</body>

</html>
