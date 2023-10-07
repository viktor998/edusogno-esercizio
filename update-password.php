<?php

require_once __DIR__ . "/Helpers/DB.php";

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['password']) && $_POST['email']) {

    $email = $_POST['email'];

    $connection = DB::connect();

    $password = md5($_POST['password']);
    $sql = "SELECT * FROM `utenti` WHERE `email` = '$email'";

    /** TODO bind_param && creare metodo in User class */
    $statement = $connection -> prepare($sql);

    $statement -> execute();
    $result = $statement->get_result();

    if($result->num_rows > 0) {

        $query = "UPDATE `utenti` SET  `password`='$password' WHERE `utenti`.`email` ='$email'";
        $statement = $connection -> prepare($query);

        $statement -> execute();

        header('Location: index.php');

    } else {
        echo "utente non trovato";
        DB::disconnect($connection);
    }
} else {

    echo "<p>Something goes wrong. Please try again</p>";
    DB::disconnect($connection);
    
}
