<?php

$host =	"localhost";
$user = "root";
$password =	"root";
$db = "log_in";

$connessione = new mysqli ($host,$user,$password,$db);

if($connessione === false){
    die("Errore durante la connessione: " . $connessione->connect_error);

}

?>