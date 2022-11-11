<?php
//////////////////////////////////////////////////////////////////////////////////
@require_once('config.php');

$nome = $connection->real_escape_string($_POST['nome']);
$cognome = $connection->real_escape_string($_POST['cognome']);
$email = $connection->real_escape_string($_POST['email']);
$password = $connection->real_escape_string($_POST['password']);

$sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$nome','$cognome', '$email', '$password')";
if($connection->query($sql) === true){
  echo "Registrazione effettuata con successo";
}else{
  echo "Errore durante registrazione utente $sql. " . $connection->error;
}

////////////////////////////////////////////////////////////////////////////////////
// if(isset($_POST['submit'])){
//   $nome = mysqli_real_escape_string($conn, $_POST['nome']);
//   $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
//   $email = mysqli_real_escape_string($conn, $_POST['email']);
//   $password = mysqli_real_escape_string($conn, $_POST['password']);

//   $select =" SELECT * FROM utenti WHERE email = '$email' && password = '$password ";

//   $result = mysqli_query($conn, $select);

//   if(mysqli_num_rows($result) > 0){
//     $error[] = 'Utente già registrato!';
//   }else{
//     $insert = "INSERT INTO utenti(nome, cognome, email, password) VALUES('$nome', '$cognome', '$email', '$password')";
//     mysqli_query($conn, $insert);
//     header('location:login_form.php');
//   }
// }


//////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/img/favicon.ico"/>
  <title>Register form</title>
  <!-- Style -->
  <link rel="stylesheet" href="./assets/styles/style.css">
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
  <header>
    <div class="logo">
      <img src="./assets/img/logo.svg" alt="Edusogno logo">
    </div>
  </header>
  <div class="form_container">

    <h3>Crea il tuo account?</h3>
    <?php
      if(isset($error)){
        foreach($error as $error){
          echo '<span class="error-msg">'.$error.'</span>';
        };
      };
    ?>
    <form action="register_form.php" method="POST">
      <label for="nome">Inserisci il tuo nome</label>
        <input type="text" name="nome" id="nome" required placeholder="Mario">
      <label for="cognome">Inserisci il tuo cognome</label>
        <input type="text" name="cognome" id="cognome" required placeholder="Rossi">
      <label for="email">Inserisci l'e-mail</label>
        <input type="email" name="email" id="email" required placeholder="name@example.com">
      <label for="password">Inserisci la password</label>
      <input type="password" name="password" id="id_password" required placeholder="Scrivila qui" id="id_password"><i class="fa-solid fa-eye" id="togglePassword"></i>
  
      <input type="submit" name="submit" value="registrati" class="form-btn">
      <p>Hai già un account? <a href="login_form.php">Accedi</a></p>
    </form>

  </div> <!-- /form-container -->
  

  <script src="./assets/js/script.js"></script>

</body>
</html>