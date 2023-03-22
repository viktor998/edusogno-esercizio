<?php
session_start();

    include("connection.php");
    include("functions.php");

    $usermail=$_POST['usermail'];

    $sql = "SELECT * FROM utenti WHERE email='$usermail' LIMIT 1";
    $result= mysqli_query($conn, $sql);

      if($result && mysqli_num_rows($result)>0){
        $to = "thepenisonthetable@live.it";
        // $to = $usermail. ',"thepenisonthetable@live.it"';
        $subject = "Reimposta la tua password";
        $message = "Per modificare la tua password, vai alla pagina ". $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/edusogno-esercizio/change-password.php';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        // $headers .= 'From: admin.esercizio@edusogno.com' . "\r\n";
        $headers .= "From: thepenisonthetable@live.it";


        mail($to, $subject, $message, $headers);

        $_SESSION['message']="Abbiamo inviato una e-mail al tuo indirizzo per il recupero della password"; 
      }elseif(!$result || mysqli_num_rows($result)==0){
        $_SESSION['message']="E-mail non presente nel nostro database";
      }else{
        $_SESSION['message']="Inserire una e-mail valida";
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

                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <?php if($_SESSION['message']):?>
                        <p style="color:red"><?php echo $_SESSION['message'] ;?></p>
                    <?php endif ;?>
                    <label for="email">
                        Inserisci la tua e-mail
                    </label>
                    <div class="input-field">
                        <input type="email" name="usermail" placeholder="name@example.com" id="email" required>
                        <span class="focus-border"></span>
                    </div>                    
                    <input type="submit" id="button-l" value="RICHIEDI NUOVA PASSWORD">
                    
                    <p>Se non hai ricevuto la mail vai a <a href="change-password.php">questo link</a> </p>
                </form>
                <p>Non hai ancora un profilo? <strong><a href="register.php">Registrati</a></strong></p>
            </div>
        </div>
    </main>
</body>

</html>