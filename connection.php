<?php

$host="127.0.0.1";
$user="root";
$password="";
$database="db_edusogno";

$conn=mysqli_connect($host, $user, $password, $database);

if($conn===false){
  die("Errore di connessione:" . $connection->connect_error);
}


?>