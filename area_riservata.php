<?php
session_start();

if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: login.html"); 
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Riservata Utenti Registrati</title>
    
</head>
<body>
    <h1>AREA RISERVATA UTENTI REGISTRATI</h1>

    <?php
    echo "Ciao " . $_SESSION['username'];
    ?>

    <a href="login.html">Disconnetti</a>
</body>
</html>