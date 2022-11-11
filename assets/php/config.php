<?php
/* Configuro il database */
$host = "localhost";
$user = "root";
$password = "root";
$db = "edusogno_login";

// Creo una connessione
$connessione = new mysqli($host, $user, $password, $db);

// Controllo la connessione
if ($connessione === false){
 die("Errore durante la connessione: " . $connessione->connect_error);
  }
?>

