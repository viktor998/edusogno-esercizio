<?php

@include 'config.php';
require_once __DIR__.'/assets/db/eventi_db.php';

session_start(); 
//////////////////
$eventi = [
  [
    'attendees' => ['ulysses200915@varen8.com','qmonkey14@falixiao.com','mavbafpcmq@hitbase.net'],
    'nome_evento' => 'Test Edusogno 1',
    'data_evento' => '2022-10-13 14:00:00',
  ],
  [
    'attendees' => ['dgipolga@edume.me','qmonkey14@falixiao.com','mavbafpcmq@hitbase.net'],
    'nome_evento' => 'Test Edusogno 2',
    'data_evento' => '2022-10-15 19:00:00',
  ],
  [
    'attendees' => ['dgipolga@edume.me','ulysses200915@varen8.com','mavbafpcmq@hitbase.net'],
    'nome_evento' => 'Test Edusogno 2',
    'data_evento' => '2022-10-15 19:00:00',
  ],
  
];
// var_dump($eventi);
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
    <div class="card-group">
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
  </div> <!-- /form-container -->
    <!-- --------------------------------------------------------------------------------------------- -->
    <!-- ------------------------------------------------- -->
    <div class="card-group">
    <?php
        foreach($eventi as $key => $value){
          $evento = new Evento($value['attendees'], $value['nome_evento'], $value['data_evento']);
      ?>
      <div class="card border-secondary text-dark bg-light m-2">
        <div class="card-body">
          <h5 class="card-title"> <?php echo "{$evento->getNome_evento()}" ?> </h5>
          <p class="card-text"><small class="text-muted"> <?php echo "{$evento->getData_evento()}" ?></small></p>
          <p class="card-text"><small class="text-muted"> <?php echo "{$evento->getAttendees()}" ?></small></p>
        </div>
      </div>
      <?php
      }
      ?>
    </div> <!-- /card-group -->
    <!-- ------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------------- -->
    <div class="container-fluid">

    <?php
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

      $sql = "SELECT id, attendees, nome_evento, data_evento FROM eventi";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          echo "<table><tr><th>ID</th><th>attendees</th><th>nome_evento</th><th>data_evento</th></tr>";
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["id"]. "</td><td>" . $row["attendees"]. "</td><td>" . $row["nome_evento"]. "</td><td>" . $row["data_evento"]. "</td></tr>";
          }
          echo "</table>";
      } else {
          echo "0 results";
      }

      $conn->close();
    ?>


    </div> <!-- /container-fluid -->

    <!-- --------------------------------------------------------------------------------------------- -->



</body>
</html>