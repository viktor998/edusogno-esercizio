<?php

require_once('config.php');

// recupero i valori passati via POST
$email = $connessione->real_escape_string($_POST['email']);
$password = $connessione->real_escape_string($_POST['password']);

// effettuo la query per verificare la correttezza del login
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $sql_select = " SELECT * FROM utenti WHERE email = '$email' ";
  // verifico che ci siano dei risltati...
  if($result = $connesione->query($sql_select)){
    if($result->num_rows == 1){
      $row = $result->fetch_array(MYSQLI_ASSOC);
      // effettuo la comparazione della password digitata con quella salvata nel DB
      if(password_verify($password, $row['password'])){
      // in caso di successo avvio la sesione
        session_start();
        // configuro la sesione
        $_SESSION['loggato'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];

        header("location: ./area-privata.php");

      }else{
        $error[] = 'La password non è corretta';
      }
    }else{
      $error[] = 'Non ci sono account con quella email';
    }
  }else{
    $error[] = 'Errore in fase di login';
  }
}
$connessione->close();

?>