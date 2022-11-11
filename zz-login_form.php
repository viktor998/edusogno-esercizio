<?php

@require_once ('config.php');

$email = $connessione->real_escape_string($_POST['email']);
$password = $connessione->real_escape_string($_POST['password']);

if($_SERVER["REQUEST_METHOD"] === "POST"){
  $sql_select = "SELECT * FROM utenti WHERE email = '$email'";
  if($result = $connesione->query($sql_select)){
    if($result->num_rows == 1){
      $row = $result->fetch_array(MYSQLI_ASSOC);
      if(password_verify($password, $row['password'])){
        session_start();

        $_SESSION['loggato'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];

        header("location: are-privata.php");
      }else{
        echo "La password non è corretta";
      }
    }else{
      echo "Non ci sono account con quello username";
    }
  }else{
    echo "Errore in fase di login";
  }
}
$connessione->close();
//////////////////
$utenti = [
  [
    'nome' => 'Mario',
    'cognome' => 'Rossi',
    'email' => 'ulysses200915@varen8.com ( https://generator.email/ulysses200915@varen8.com )',
    'password' => 'Edusogno123',
    'user_type' => 'registrato',
  ],
  [
    'nome' => 'Filippo',
    'cognome' => 'D\Amelio',
    'email' => 'qmonkey14@falixiao.com ( https://generator.email/qmonkey14@falixiao.com )',
    'password' => 'Edusogno?123',
    'user_type' => 'registrato',
  ],
  [
    'nome' => 'Gian Luca',
    'cognome' => 'Carta',
    'email' => 'mavbafpcmq@hitbase.net (https://generator.email/mavbafpcmq@hitbase.net )',
    'password' => 'EdusognoCiao',
    'user_type' => 'registrato',
  ],
  [
    'nome' => 'Stella',
    'cognome' => 'De Grandis',
    'email' => 'dgipolga@edume.me  ( https://generator.email/dgipolga@edume.me )',
    'password' => 'EdusognoGia',
    'user_type' => 'registrato',
  ]

];
// var_dump($utenti);
//////////////////

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/img/favicon.ico"/>
  <title>Login form</title>
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

  <main>
    <div class="form_container">


    <!-- ------------------------------------------------- -->
    <div class="card-group">
    <?php
        foreach($utenti as $key => $value){
          $utente = new Utente($value['nome'], $value['cognome'], $value['email'], $value['password'], $value['user_type']);
      ?>
      <div class="card border-secondary text-dark bg-light m-2">
        <img src=" <?php echo "{$utente->getCognome()} " ?> " class="card-img-top" alt="<?php echo "{$utente->getType()}" ?>  ">
        <div class="card-body">
          <h5 class="card-title"> <?php echo "{$utente->getNome()}" ?> </h5>
          <p class="card-text"><small class="text-muted"> <?php echo "{$utente->getCognome()}" ?></small></p>
          <p class="card-text"><small class="text-muted"> <?php echo "{$utente->getEmail()}" ?></small></p>
          <p class="card-text"> <?php echo "{$utente->getPassword()}" ?> </p>
        </div>
      </div>
      <?php
      }
      ?>
    </div> <!-- /card-group -->
    <!-- ------------------------------------------------- -->
     <h3>Hai già un account?</h3>
      <!-- < ?php
        if(isset($error)){
          foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
          };
        };
      ?> -->
      <form action="register_form.php" method="POST">
        <label for="email">Inserisci l'e-mail</label>
        <input type="email" name="email" required placeholder="name@example.com">
        <label for="password">Inserisci la password</label>
        <input type="password" name="password" id="id_password" required placeholder="Scrivila qui" id="id_password"><i class="fa-solid fa-eye" id="togglePassword"></i>
        
        <input type="submit" name="submit" value="accedi" class="form-btn">
        <p>Non hai ancora un profilo? <a href="register_form.php">Registrati</a></p>
      </form>

    </div> <!-- /form-container -->


    <!-- --------------------------------------------------------------------------------------------- -->
    <div class="container">

    <!-- < ?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "edusogno_login";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT id, email, password FROM utenti";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          echo "<table><tr><th>ID</th><th>email</th><th>password</th></tr>";
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["id"]. "</td><td>" . $row["email"]. "</td><td>" . $row["password"].  "</td></tr>";
          }
          echo "</table>";
      } else {
          echo "0 results";
      }

      $conn->close();
    ?> -->


    </div> <!-- /container -->

    <!-- --------------------------------------------------------------------------------------------- -->
    </main>
<script src="./assets/js/script.js"></script>

</body>
</html>