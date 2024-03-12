<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../connection.php';

$email = $conn->real_escape_string($_GET['email']);
$result_event = [];
$i = 0;

$sql_select = "SELECT * FROM registration WHERE email = '$email' ";
$result = $conn->query($sql_select);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['role'] == "admin") {
        $sql_select_event = "SELECT * FROM `eventi`";
    } else {
        $sql_select_event = "SELECT * FROM `eventi` WHERE attendees LIKE '%$email%';";
    }
}

$result = $conn->query($sql_select_event);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $result_event[$i]['id'] = $row['id'];
        $result_event[$i]['attendees'] = $row['attendees'];
        $result_event[$i]['nome_evento'] = $row['nome_evento'];
        $result_event[$i]['data_evento'] = $row['data_evento'];
        $i++;
    }
    $data = json_encode($result_event);
    echo $data;
}
else echo '';


// if($_SERVER["REQUEST_METHOD"] === "POST"){
//     if($result = $connessione->query($sql_select)){

//         if($result->num_rows == 1){
//             $row = $result->fetch_array(MYSQLI_ASSOC);
//             if(password_verify($password, $row['password'])){
//                 session_start();
//                 $_SESSION['logged'] = true;
//                 $_SESSION['id'] = $row['id'];
//                 $_SESSION['email'] = $row['email'];
//                 $_SESSION['nome'] = $row['nome'];
//                 $_SESSION['cognome'] = $row['cognome'];
//                 $_SESSION['result_event'] = $result_event;
//                 header("location: private-area.php");
//             }else{
//                 echo "la password non è corretta";
//             }
//         }else{
//             echo "non ci sono account con quell'username";
//         }
//     } else {
//         echo "errore in fase di login";
//     }
//     $connessione -> close();
// }
//  ?>