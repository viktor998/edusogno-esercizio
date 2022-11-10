<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);

  $select = " SELECT * FROM utenti WHERE email = '$email' && password = '$password' ";  

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_array($result);

    if($row['type_user'] == ''){
      $error[] = 'Email o password non corrette. Riprova!';
      
    }else{
      $_SESSION['nome'] = $row['nome'];
      header('location:eventi.php');
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
  <title>Login form</title>
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

    <h3>Hai già un account?</h3>
    <?php
      if(isset($error)){
        foreach($error as $error){
          echo '<span class="error-msg">'.$error.'</span>';
        };
      };
    ?>
    <form action="" method="post">
      <label for="email">Inserisci l'e-mail</label>
      <input type="email" name="email" required placeholder="name@example.com">
      <label for="password">Inserisci la password</label>
      <input type="password" name="password" required placeholder="Scrivila qui" id="pswShow">
      <!-- <input type="image" src="./assets/img/eye-open.svg" onclick="showpsw()" alt="Submit" width="30" height="30"> -->
  
      <input type="submit" name="submit" value="accedi" class="form-btn">
      <p>Non hai ancora un profilo? <a href="register_form.php">Registrati</a></p>
    </form>


  </div>

<!-- <script>
  function showpsw(){
    var x = document.getElementById("pswShow");
      if(x.type === "password"){
        x.type = "text";
      }else{
        x.type = "password";
      }
    }
</script> -->
</body>
</html>