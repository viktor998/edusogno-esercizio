<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- pagina register.html -->

    <form action="./php/register.php" method="POST">
        <h2>Registrati</h2>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="inserisci il tuo username" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="inserisci la tua email" required>

        <label for="password">Password</label>
        <input type="text" name="password" id="password" placeholder="inserisci la tua password" required>

        <input type="submit" value="Invia">
        <p> Hai già un account? Se sì inserisci le tue credenziali per accedere <a href="login.html"> Accedi</a></p>
    </form>

</body>

</html>