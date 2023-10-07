<?php

require_once __DIR__ . "/../Helpers/DB.php";

class Event
{
    public static function find($email)
    {
        $connection = DB::connect();

        if($email === 'admin@edusogno.com') {
            $sql = "SELECT * FROM eventi";
        } else {
            $sql = "SELECT * FROM eventi WHERE attendees LIKE '%$email%'";
        }

        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        if($result && $result->num_rows > 0) {
            //$events = mysqli_fetch_array($result);
            return $result -> fetch_all(MYSQLI_ASSOC);
        } else {
        }
    }

    public static function store($attendees, $nome_evento, $data_evento)
    {
        $connection = DB::connect();

        $sql = "INSERT INTO `eventi` (id, attendees, nome_evento, data_evento) VALUES (NULL, '$attendees', '$nome_evento', '$data_evento')";
        $statement = $connection->prepare($sql);
        $statement->execute();
        // var_dump($statement);
        $result = $statement->get_result();

        if($result) {
            // var_dump($result);
            return $result;
        } else {
            DB::disconnect($connection);
            return false;
        }
    }

    public static function update($id, $nome_evento, $data_evento, $attendees){
        $connection = DB::connect();
        $sql = "UPDATE eventi SET attendees= '$attendees',nome_evento='$nome_evento',data_evento='$data_evento' WHERE id = '$id'";

        $statement = $connection->prepare($sql);
        $statement->execute();
        // var_dump($statement);
        $result = $statement->get_result();

        if($result) {
            // var_dump($result);
            return $result;
          } else {
          DB::disconnect($connection);
          return false;
        }
    }

    public static function destroy($id){
    $connection = DB::connect();
    $sql = "DELETE FROM `eventi` WHERE `id` = '$id'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    // var_dump($statement);
    $result = $statement->get_result();

    if($result) {
        // var_dump($result);
        return $result;
    } else {
        DB::disconnect($connection);
        return false;
    }
    }

}
