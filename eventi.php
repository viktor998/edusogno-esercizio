<?php

@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventi</title>
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

    <h3>Ciao [nome_utente] ecco i tuoi eventi</h3>
    <div class="card-container">
      <div class="card">
        <div class="card-title">Nome evento</div>
        <div class="card-date">Data evento</div>
        <div class="card-btn"><p>Join</p></div>
      </div>
      <div class="card">
        <div class="card-title">Nome evento 2</div>
        <div class="card-date">Data evento 2</div>
        <div class="card-btn"><p>Join</p></div>
      </div>
      <div class="card">
        <div class="card-title">Nome evento 3</div>
        <div class="card-date">Data evento 3</div>
        <div class="card-btn"><p>Join</p></div>
      </div>
    </div>


  </div>

</body>
</html>