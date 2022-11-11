<?php

require_once('config.php');

$nome = $connessione->real_escape_string($_POST['nome']);
$cognome = $connessione->real_escape_string($_POST['cognome']);
$email = $connessione->real_escape_string($_POST['email']);
$password = $connessione->real_escape_string($_POST['password']);
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// $sql = "INSERT INTO utenti (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
$sql = " INSERT INTO utenti (nome, cognome, email, password) VALUES ('$nome','$cognome','$email', '$password') ";
if($connessione->query($sql) === true){
  echo "Registrazione effettuata con successo";
  header("location: index.php");
}else{
  echo "Errore durante registrazione utente $sql. " . $connesione->error;
}

?>