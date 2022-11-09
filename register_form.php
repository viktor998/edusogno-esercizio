<?php
@include 'config.php';

if(isset($_POST['submit'])){
  $nome = mysqli_real_escape_string($conn, $_POST['nome']);
  $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $select =" SELECT * FROM utenti WHERE email = '$email' && password = '$password ";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){
    $error[] = 'Utente già registrato!';
  }else{
    $insert = "INSERT INTO utenti(nome, cognome, email, password) VALUES('$nome', '$cognome', '$email', '$password')";
    mysqli_query($conn, $insert);
    header('location:login_form.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register form</title>
  <!-- Style -->
  <link rel="stylesheet" href="./assets/styles/style.css">
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
    <form action="" method="post">
      <label for="nome">Inserisci il tuo nome</label>
        <input type="text" name="nome" required placeholder="Mario">
      <label for="cognome">Inserisci il tuo cognome</label>
        <input type="text" name="cognome" required placeholder="Rossi">
      <label for="email">Inserisci l'e-mail</label>
        <input type="email" name="email" required placeholder="name@example.com">
      <label for="password">Inserisci la password</label>
        <input type="password" name="password" required placeholder="Scrivila qui">
  
      <input type="submit" name="submit" value="registrati" class="form-btn">
      <p>Hai già un account? <a href="login_form.php">Accedi</a></p>
    </form>

  </div>

</body>
</html>