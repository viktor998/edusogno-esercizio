<?php
session_start();
$_SESSION['isAuthorized'] = false;
include __DIR__ . '/controllers/utenteController.php';
if (isset($_POST['login'])) {
    $response = UtenteController::autorize($_POST['email'], $_POST['password']);
    if(is_object($response)){
        $_SESSION['nome'] = $response->nome;
        $_SESSION['email'] = $response->email;
        $_SESSION['isAuthorized'] = true;        
        header("Location: ./personale.php");
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
                    <?php if ($response === "Email errata") : ?>
                        <div class="error-text">
                            <p><?= $response ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="input">
                    <label for="password">Inserisci la password</label>
                    <input type="password" name="password" id="password" placeholder="Scrivila qui">
                    <?php if ($response === 'Password sbagliata') : ?>
                        <div class="error-text">
                            <p><?= $response ?></p>
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