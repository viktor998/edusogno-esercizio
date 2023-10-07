<?php

    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Helpers/DB.php";


    if(isset($_GET['key'])){
        $id = $_GET['key'];
    $connection = DB::connect();
    $edit_Event = Event::destroy($id);

    header('Location: dashboard.php');
}

?>