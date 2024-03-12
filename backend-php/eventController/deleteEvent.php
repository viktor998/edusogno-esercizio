<?php

require_once '../connection.php';

require_once './Event.php';

// Check id
$data = json_decode(file_get_contents("php://input"), true);
$eventId = $data["event_id"];

// SQL code
$stmt = $conn->query("DELETE FROM eventi WHERE id = ". $eventId);

if($stmt == false) {
    echo "cannot delete event:". $conn->error;
} else {
    echo json_encode(array("status"=> "success","message"=> "successfully deleted."));
}