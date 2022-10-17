<?php
include __DIR__ . '/models/utente.php';
if (isset($_POST['login'])) {
    $checkEmail = $_POST['email'];
    $query = "SELECT `email`, `password`,`nome` FROM `utenti` WHERE `email` = '$checkEmail'";
    $mysql = mysqli_connect("127.0.0.1", "root", "root", "test-edusogno", '3306');
    if ($mysql->connect_errno) {
        error_log('Connection error: ' . $mysql->connect_error);
    }
    $emailPasswordUser = mysqli_query($mysql, $query);

    if (!$emailPasswordUser->num_rows <= 0) {
        $dataUser = $emailPasswordUser->fetch_object();

        if ($dataUser->password === $_POST['password']) {
            header("Location: ./personale.php?email=$dataUser->email&nome=$dataUser->nome");
        } else {
            $errorPassword = 'Password sbagliata';
        }
    } else {
        $errorEmail = 'Email errata';
    }
}
include __DIR__ . '/layout/header.php';
?>

<main>
    <section class="login pt-5">
        <h1>Hai già un account?</h1>
        <div class="container-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input">
                    <label for="email">Inserisci l'e-mail</label>
                    <input type="mail" placeholder="name@example.com" id="email" name="email" value="<?= $_POST['email'] ?>">
                    <?php if ($errorEmail) : ?>
                        <div class="error-text">
                            <p><?= $errorEmail ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="input">
                    <label for="password">Inserisci la password</label>
                    <input type="password" name="password" id="password" placeholder="Scrivila qui">
                    <?php if ($errorPassword) : ?>
                        <div class="error-text">
                            <p><?= $errorPassword ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="actions">
                    <button type="submit" name="login">ACCEDI</button>
                </div>
            </form>
            <p class="question-link">Non hai ancora un profilo? <a href="./registrati.php">Registrati</a></p>
        </div>
    </section>
</main>
<?php
include __DIR__ . '/layout/footer.php';
?>