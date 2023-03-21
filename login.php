<?php
session_start();

    include("connection.php");
    include("functions.php");


    if($_SERVER['REQUEST_METHOD']==="POST"){
        
        $useremail=$_POST['useremail'];
        $userpassword=$_POST['userpassword'];

        if(!empty($useremail) && !empty($userpassword)){

            $sql = "SELECT * FROM utenti WHERE email='$useremail' LIMIT 1";
            
            $result= mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result)>0){
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password']===$userpassword){
                    $_SESSION['id']=$user_data['id'];
                    header("Location:index.php");
                    die();
                }
              }

            header("Location:login.php");
            die();



        }else{
            echo 'Inserire i dati nel formato corretto';
        }

    }




   


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
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>
                Hai già un account?
            </h2>
            <div class="form-container">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <label for="email">
                        Inserisci l'email
                    </label>
                    <input type="email" name="useremail" placeholder="name@example.com" id="email" required>
                    <label for="password">
                        Inserisci la password
                    </label>
                    <input type="password" name="userpassword" placeholder="Scrivila qui" id="password" required>
                    <input type="submit" id="button-l" value="ACCEDI">
                </form>
                <p>Non hai ancora un profilo? <strong><a href="register.php">Registrati</a></strong></p>
            </div>
        </div>
    </main>
</body>

</html>