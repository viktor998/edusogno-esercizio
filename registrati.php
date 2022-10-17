<?php
include __DIR__ . '/models/utente.php';
if (isset($_POST['registrati'])) {
    $utente = new Utente($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password']);
    $utente->save();
    $successfull = true;
};
include __DIR__ . '/layout/header.php';
?>
<main>
    <?php if ($successfull) : ?>
        <div class="message">
            <p>Registrazione completata, ora puoi eseguire il login <a href="./index.php">QUI</a> </p>
        </div>
    <?php endif; ?>
    <section class="register pt-5">
        <h1>Hai già un account?</h1>
        <div class="container-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input">
                    <label for="nome">Inserisci il nome</label>
                    <input type="text" placeholder="Mario" id="nome" name="nome">
                </div>
                <div class="input">
                    <label for="cognome">Inserisci il cognome</label>
                    <input type="cognome" name="cognome" id="cognome" placeholder="Rossi">
                </div>
                <div class="input">
                    <label for="email">Inserisci l'e-mail</label>
                    <input type="mail" placeholder="name@example.com" id="email" name="email">
                </div>
                <div class="input">
                    <label for="password">Inserisci la password</label>
                    <input type="password" name="password" id="password" placeholder="Scrivila qui">
                </div>
                <div class="actions">
                    <button type="submit" name="registrati">REGISTRATI</button>
                </div>
            </form>
            <p class="question-link">Hai già un account? <a href="./index.php">Accedi</a></p>
        </div>
    </section>
</main>
<?php
include __DIR__ . '/layout/footer.php';
?>