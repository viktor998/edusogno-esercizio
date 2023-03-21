<?php
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']==="POST"){
        $nome=$_POST['nome'];
        $cognome=$_POST['cognome'];
        $email=$_POST['email'];
        $password=$_POST['password'];


        $readValue = "SELECT `email` FROM utenti WHERE email='$email'";

        $res= mysqli_query($conn, $readValue);
        if($res && mysqli_num_rows($res)>0){
            var_dump('utente già inserito');
            header("Location:login.php");
            die();
        }else{
            if(!empty($nome)&&  !empty($cognome) && !empty($email) && !empty($password) && !is_numeric($nome) && !is_numeric($cognome)){

                $sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES
                ('$nome', '$cognome','$email','$password')";
                mysqli_query($conn, $sql);
    
                header("Location:index.php");
                die();
    
    
    
            }else{
                echo 'Inserire i dati nel formato corretto';
            }
        }

        

    }


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
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
            Crea il tuo account
        </h2>
        <div class="form-container">
            
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <label for="nome">
                        Inserisci il nome
                    </label>
                    <input type="text" name="nome" placeholder="Mario" id="nome" required>
                    <label for="cognome">
                        Inserisci il cognome
                    </label>
                    <input type="text" name="cognome" placeholder="Rossi" id="cognome" required>
                    <label for="email">
                        Inserisci l'email
                    </label>
                    <input type="email" name="email" placeholder="name@example.com" id="email" required>
                    <label for="password">
                        Inserisci la password
                    </label>
                    <input type="password" name="password" placeholder="Scrivila qui" id="password" required>
                    <input type="submit" value="REGISTRATI" id="button-r">
                </form>
                <p>Hai gi&agrave; un account? <strong><a href="login.php">Accedi</a></strong></p>
            </div>
        </div>
    </main>
 </body>

</html> 