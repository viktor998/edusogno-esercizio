<?php
require_once __DIR__ . "/Helpers/DB.php";
require_once __DIR__ . "/Models/Event.php";

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
    $events = Event::find($email);

    if($result && $result->num_rows > 0) {
        $user = mysqli_fetch_array($result);
    } else {
        DB::disconnect($connection);
    }
}

session_write_close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <!-- link style.css -->
    <link rel="stylesheet" href="./assets/styles/style.css">
    <!-- link google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="d-flex">
        <div class="logo">
            <img src="./assets/img/Group 181.png" alt="Edusogno Logo">
        </div>
    </header>
    <main class="pt-4">
        <div class="main-container">
            <h2 class="title pb-2">Ciao
                <span class="text-uppercase">
                    <?= $user['nome'] ?>
                </span>
                ecco i tuoi eventi
            </h2>
            <div class="card-container">
                <div class="row d-flex flex-wrap">
                    <?php foreach ($events as $event) { ?>
                    <div class="col-4">
                        <div class="card text-dark bg-lighter">
                            <h2 class="card-title">
                                <?= $event['nome_evento'] ?>
                            </h2>
                            <p class="text-secondary fs-5">
                                <?= $event['data_evento'] ?>
                            </p>
                            <div class="submit-btn d-flex justify-center pb-1">
                                <button type="submit" class="btn bg-primary text-uppercase">Join</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="big-circle">
            <svg width="180" height="358" viewBox="0 0 180 358" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="1" cy="179" r="179" fill="white" />
            </svg>
        </div>
        <div class="small-circle">
            <svg width="181" height="181" viewBox="0 0 181 181" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="90.5" cy="90.5" r="90.5" fill="white" />
            </svg>
        </div>
        <div class="white-wave">
            <svg width="1440" height="128" viewBox="0 0 1440 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M550.04 20.7802C309.334 -30.4323 58.3859 24.9498 -37 59.0424V152L1505.7 142.434C1506.68 130.171 1508.06 94.1161 1505.7 48.0053C1428.64 75.2303 850.923 84.7959 550.04 20.7802Z"
                    fill="white" />
            </svg>
        </div>
        <div class="light-wave">
            <img src="./assets/img/Vector 4.png" alt="">
        </div>
        <div class="dark-wave">
            <svg width="1440" height="226" viewBox="0 0 1440 226" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1333.21 30.8969C1794.82 -45.248 2276.07 37.0965 2459 87.7868V226L-499.505 211.778C-501.388 193.544 -504.023 139.936 -499.505 71.3763C-351.721 111.856 756.189 126.078 1333.21 30.8969Z"
                    fill="#B8CCE4" />
            </svg>
        </div>
        <div class="rocket">
            <svg width="111" height="185" viewBox="0 0 111 185" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M55.5 0L87.1099 63H23.8901L55.5 0Z" fill="white" />
                <rect x="24" y="63" width="63" height="96" fill="white" />
                <path d="M0 145.867L20 127V159.145L0 185V145.867Z" fill="white" />
                <path d="M111 145.867L91 127V159.145L111 185V145.867Z" fill="white" />
                <rect x="53" y="128" width="5" height="56" fill="white" />
                <circle cx="55.5" cy="102.5" r="14.5" fill="#D9E5F3" />
            </svg>
        </div>
    </main>
</body>

</html>