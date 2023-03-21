<?php

$host="127.0.0.1";
$user="root";
$password="";
$database="db_edusogno";

$connection=new mysqli($host, $user, $password, $database);

if($connessione===false){
  die("Errore di connessione:" . $connection->connect_error);
}

// $sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES
// (?,?,?,?)";

// if($statement=$connection->prepare($sql)){
//   $statement->bind_param("ssss", $nome, $cognome, $email, $password);

//   $nome=$_POST['nome'];
//   $cognome=$_POST['cognome'];
//   $email=$_POST['email'];
//   $password=$_POST['password'];


//   echo('utente inserito con successo') ;
// }else{
//   echo 'errore:non è possibile inserire questo utente';
// }

$nome=$connection->real_escape_string($_POST['nome']);
$cognome=$connection->real_escape_string($_POST['cognome']);
$email=$connection->real_escape_string($_POST['email']);
$password=$connection->real_escape_string($_POST['password']);

$sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES
('$nome', '$cognome','$email','$password')";

if($connection->query($sql)===true){
  echo('utente inserito con successo') ;
}else{
  echo('errore nell\'inserimento dell\'utente') ;
}

// $statement->close();
$connection->close();
?>