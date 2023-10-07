<?php

require_once __DIR__ . "/Models/User.php";

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["password"]) && $_POST["nome"] != "" && $_POST["cognome"] != "" && $_POST["email"] != "" && $_POST["password"] != "") {

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    User::create($nome, $cognome, $email, $password);

    $_SESSION["email"] = $email;

    header('Location: dashboard.php');


    
    /* User::checkExistingEmail($email); */

    /* if (!$result) {
        $result = User::create($nome, $cognome, $email, $password);
        header('Location: dashboard.php');

    } else if ($result) {
        $_SESSION["authenticated"] = false;
        $_SESSION["errors"] = "Email esiste già";
        header("Location: register.php");
    } else {
        echo "Query error";
    }
         */
    /***** controlli
     * if mail non esiste già
     */


    // var_dump(__DIR__);

} else {
    $_SESSION["authenticated"] = null;
    $_SESSION["errors"] = "All fields must be filled";
    header('Location: register.php');
    
} 

session_write_close();
