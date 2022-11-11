<?php
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
  header("location: ./index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Area privata</title>
</head>
<body>
  <?php
    echo "Ciao " . $_SESSION["nome" . "cognome"];
  ?>
  <a href="./assets/php/logout.php">Disconnetti</a>
</body>
</html>