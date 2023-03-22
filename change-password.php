<?php
session_start();
  include("connection.php");
  include("functions.php");

$newPw=$_POST['new-pw'];
$confPw=$_POST['conf-pw'];
$usermail=$_POST['usermail'];

$sql = "SELECT * FROM utenti WHERE email='$usermail' LIMIT 1";
$result= mysqli_query($conn, $sql);

if($confPw != $newPw){
  $_SESSION['alert']="Le password devono coincidere";
}else{
  $query="UPDATE password FROM utenti SET password='$confPw' WHERE email='$usermail'";
  $res= mysqli_query($conn, $query);
  if($res && mysqli_num_rows($res)>0){
    $_SESSION['alert']="Password aggiornata correttamente";
    header("Location: login.php");
    die();
  }
}

// }
// elseif(!$result || mysqli_num_rows($result)==0){
//   $_SESSION['alert']="Questa e-mail non è presente nei nostri sistemi";
//   header("Location: register.php");
//   die();

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
                    <label for="email">
                        Inserisci la tua e-mail
                    </label>
                    <div class="input-field">
                      <input type="email" name="usermail" placeholder="name@example.com" id="email" required>
                      <span class="focus-border"></span>
                    </div>
                   
                    <label for="new-pw">
                        Scegli una nuova password
                    </label>
                    <div class="input-field">
                      <input type="text" name="new-pw" placeholder="Inserisci una nuova password" id="new-pw" required>
                      <span class="focus-border"></span>
                    </div>
                    <label for="confirm-pw">
                        Conferma password
                    </label>
                    <div class="input-field">
                      <input type="text" name="confirm-pw" placeholder="Conferma password" id="confirm-pw" required>
                      <span class="focus-border"></span>
                    </div>
                   
                    
                    
                    <input type="submit" id="button-l" value="CONFERMA NUOVA PASSWORD">
                    <?php if($_SESSION['alert']):?>
                        <p style="color:red"><?php echo $_SESSION['alert'] ;?></p>
                    <?php endif ;?>
                </form>
                <p>Non hai ancora un profilo? <strong><a href="register.php">Registrati</a></strong></p>
            </div>
        </div>
    </main>
</body>

</html>