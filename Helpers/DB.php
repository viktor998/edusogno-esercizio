<?php
  require_once __DIR__ . "/../env.php";
  
  class DB {
    public static function connect() {

      $connection = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

      if ($connection && $connection -> connect_error) {
        throw new Exception("Connection failed: " . $connection -> connect_error);
      }
      return $connection;
    }

    public static function disconnect($connection) {
      $connection->close();
    }
  }