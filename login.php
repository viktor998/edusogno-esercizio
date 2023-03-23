<?php
session_start();

    include("connection.php");
    include("functions.php");
    if($_SESSION['new-user']){
        $_SESSION['new-user']=$_SESSION['new-user'];
    }else{
        $_SESSION['new-user'] = '';
    }

    if($_SERVER['REQUEST_METHOD']==="POST"){
        
        $useremail=$_POST['useremail'];
        $userpassword=$_POST['userpassword'];

        if(!empty($useremail) && !empty($userpassword)){

            $sql = "SELECT * FROM utenti WHERE email='$useremail' AND password='$userpassword' LIMIT 1";
            
            $result= mysqli_query($conn, $sql);

            if($result && mysqli_num_rows($result)>0){
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password']===$userpassword){
                    $_SESSION['id']=$user_data['id'];
                    header("Location:index.php");
                    die();
                }
            }else{
                $_SESSION['feedback'] = "E-mail o password non corretta. Riprovare.";
            }
            header("Location:login.php");
            die();
        }else{
            echo 'Inserire i dati nel formato corretto';
        }

    }

session_destroy();

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                <?php if($_SESSION['new-user']): ?>
                    <p style="color:red"><?php echo $_SESSION['new-user'] ;?></p>
                <?php endif;?>
                <?php if($_SESSION['feedback']):?>
                        <p style="color:red"><?php echo $_SESSION['feedback'] ;?></p>
                    <?php endif ;?>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <label for="email">
                        Inserisci l'e-mail
                    </label>
                    <div class="input-field">
                        <input type="email" name="useremail" placeholder="name@example.com" id="email" required>
                        <span class="focus-border"></span>
                    </div>
                    <label for="password">
                        Inserisci la password
                    </label>
                    <div class="input-field">
                        <input type="password" name="userpassword" placeholder="Scrivila qui" id="password" required>
                        <span class="focus-border"></span>
                        <i class="fa-solid fa-eye-slash" id="toggle-pw"></i>
                    </div>            
                    <div class="forgot-pw">
                        <a href="reset-password.php" class="forgot-pw">Password dimenticata?</a>
                    </div>
                    
                    <input type="submit" id="button-l" value="ACCEDI">
                    
                </form>
                <p>Non hai ancora un profilo? <strong><a href="register.php">Registrati</a></strong></p>
            </div>
        </div>
    </main>
</body>

</html>
<script>
    $( document ).ready(function() {
        const togglePassword = document.getElementById('toggle-pw');
        const password = document.getElementById('password');

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute('type', type);

            if(this.classList.contains('fa-eye-slash')){
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }else{
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        })

      
    });
</script>