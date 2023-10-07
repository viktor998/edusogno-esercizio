<?php
require_once __DIR__ . "/../Helpers/DB.php";
require_once __DIR__ . "/../Models/Event.php";

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(isset($_SESSION["email"])) {
    $connection = DB::connect();
    $email = $_SESSION["email"];

    $sql = "SELECT * FROM `utenti` WHERE `email` = '$email'";
    $statement = $connection -> prepare($sql);
    $statement -> execute();
    $result = $statement->get_result();

    if($result && $result->num_rows > 0) {
        $events = Event::find($email);
    } else {
        DB::disconnect($connection);
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <!-- link style.css -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- link google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <header class="d-flex">
        <div class="logo">
            <img src="../assets/img/Group 181.png" alt="Edusogno Logo">
        </div>
    </header>
    <main>
        <div class="main-container">
            <h2 class="title pb-2">Ciao ADMIN ecco tutti gli eventi</h2>
            <div class="container text-dark bg-lighter">
                <a href="create.php" class="d-inline-block"> Aggiungi un nuovo evento</a>
                <table class="pt-2">
                    <thead>
                        <tr>
                            <th>Attendees</th>
                            <th>Nome Evento</th>
                            <th>Data Evento</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($events) { 
                        foreach ($events as $event) { ?>
                        <tr>
                            <td>
                                <?php $attendees = explode(",", $event['attendees']);
                            foreach($attendees as $attendee) {
                                echo $attendee . " ";
                            } ?>
                            </td>
                            <td><?= $event['nome_evento'] ?>
                            </td>
                            <td><?= $event['data_evento'] ?>
                            </td>
                            <td>
                                <a href="show.php?key=<?=$event["id"]?>"
                                    class="btn-small bg-primary link-unstyled">Show</a>
                                <a href="edit.php?key=<?=$event["id"]?>"
                                    class="btn-small bg-warning link-unstyled">Edit</a>
                                <button id="show-btn" class="btn-small bg-danger" 
                                    data-target="#modal<?=$event["id"]?>" data-id="<?=$event["id"]?>" data-toggle="modal">Delete</button>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td>Non ci sono eventi in programma</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div id="modal-container" class="d-none">
                    <div id="modal<?=$event["id"]?>">
                        <div class="modal-header d-flex align-center">
                        <p>Are you sure you want to delete
                            <?=$event["id"]?>?
                        </p>
                        <div id="close" class="close-modal">
                            X
                        </div>
                        </div>
                        <form action="destroy.php?key=<?=$event["id"]?>" method="post">
                            <button type="submit" class=" btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/myscript.js"></script>
</body>

</html>