<?php
  require_once __DIR__ . "/../Helpers/DB.php";

  class User {
    public static function find($email, $password) {
      $md5Password = md5($password);

      $connection = DB::connect();
      // var_dump($connection);
    
      $sql = "SELECT `id`, `email` FROM `utenti` WHERE `email` = ? AND `password` = ?";

      $statement = $connection -> prepare($sql);
      $statement -> bind_param("ss", $email, $md5Password);

      $statement -> execute();
      // var_dump($statement);
      $result = $statement->get_result();
      if($result) {
        // var_dump($result);
        return $result;
      }
      DB::disconnect($connection);
      return false;
    }

    public static function create($nome, $cognome, $email, $password) {
      $md5Password = md5($password);

      $connection = DB::connect();
      
      $sql = "INSERT INTO `utenti` (`id`, `nome`, `cognome`, `email`, `password`) VALUES (NULL, '$nome', '$cognome', '$email', '$md5Password')";
      /* TODO bindare*/
      $statement = $connection->prepare($sql);

      $statement->execute();
      // var_dump($statement);
      $result = $statement->get_result();
      if($result) {
        // var_dump($result);
        return $result;
      }
      DB::disconnect($connection);
      return false;
    }

    /* public static function checkExistingEmail($newEmail) {
      $connection = DB::connect();
      // var_dump($connection);
    
      $sql = "SELECT `email` FROM `utenti` WHERE `email` = ?";
       TODO bindare
      $statement = $connection -> prepare($sql);
      $statement -> bind_param("s", $newEmail);

      $statement -> execute();
      $result = $statement->get_result();

      var_dump($result);
      if($result) {
        // var_dump($result);
        return true;
      } 
      DB::disconnect($connection);
       return false; 
    } */

    public static function all() {
      $connection = DB::connect();
      $sql = "SELECT * FROM `utenti` WHERE email <> 'admin@edusogno.com'";
      $results = $connection -> query($sql);
      DB::disconnect($connection);
      return $results -> fetch_all(MYSQLI_ASSOC);
    }
}