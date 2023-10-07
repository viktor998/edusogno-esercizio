<?php

    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Helpers/DB.php";
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
      }
      
    if(isset( $_POST['attendees'], $_POST['nome_evento'], $_POST['data_evento'])){
    $connection = DB::connect();
    $attendees = implode(",", $_POST['attendees']);
    $nome_evento = $_POST['nome_evento']; 
    $data_evento = $_POST['data_evento']; 

    $new_Event = Event::store($attendees, $nome_evento, $data_evento);

    header('Location: dashboard.php');
    DB::disconnect($connection);
}

?>