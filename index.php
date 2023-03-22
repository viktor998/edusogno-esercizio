<?php
    session_start();

    include("connection.php");
    include("functions.php");
    
    $user_data= check_login($conn);

        // $sql="INSERT INTO utenti(nome, cognome, email, password) VALUES
        // ('Filippo', 'D’Amelio', 'qmonkey14@falixiao.com', 'Edusogno?123'),
        // ('Gian Luca', 'Carta', 'mavbafpcmq@hitbase.net ', 'EdusognoCiao'),
        // ('Stella', 'De Grandis', 'dgipolga@edume.me', 'EdusognoGia')";

        // if($connection->query($sql)===true){
        //     echo 'utente inserito con successo';
        // }else{
        //     echo 'errore';
        // }
    
    // $query= "SELECT * FROM eventi";
    $usermail=$user_data['email'];
    $query= "SELECT * FROM eventi WHERE attendees LIKE '%$usermail%'";
    $return=mysqli_query($conn, $query);
    $events=mysqli_fetch_all($return);
    // dump($user_data['email']);


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edusogno</title>
</head>

<body>
    
    <!-- <div class="bg"> -->
        <img src="assets/img/Vector 5.png" alt="vector5" id="vector-5">
        <img src="assets/img/Vector 4.png" alt="vector4" id="vector-4">
        <img src="assets/img/Vector 1.png" alt="vector1" id="vector-1">
        
        <img src="assets/img/rocket.svg" alt="rocket" id="rocket">
        <div id="circle-1" class="circle"></div>
        <div id="circle-2" class="circle"></div>
    <!-- </div> -->
    <header>
        <nav>
            <img src="assets/img/Logo-edusogno.png" alt="logo">
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </header>
    <main>
        <div class="container">
            
            <h2>
            Ciao <?php echo strtoupper($user_data['nome']) ;?>&nbsp;<?php echo strtoupper($user_data['cognome']) ;?> ecco i tuoi eventi
            </h2>
            
                <div class="events-container">
                    <?php if($events) :?>
                        <?php foreach($events as $event) : ?>
                            <div class="card">
                                <h4><?php echo $event[2];?></h4>
                                <p><?php echo $event[3];?></p>
                                <button class="join-btn">JOIN</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else :?>
                        <p class="no-events">Nessun evento in programma</p>
                    <?php endif ;?>
                </div>
        </div>
    </main>
</body>

</html>