<?php
include __DIR__ . '/models/utente.php';
$email = $_GET['email'];
$query = "SELECT * FROM `eventi` WHERE `attendees` LIKE '%$email%'";
$mysql = mysqli_connect("127.0.0.1", "root", "root", "test-edusogno", '3306');
if ($mysql->connect_errno) {
    error_log('Connection error: ' . $mysql->connect_error);
}
$response = mysqli_query($mysql, $query);
$userEvents = $response->fetch_all(MYSQLI_ASSOC);


include __DIR__ . '/layout/header.php';
?>

<main>
    <section class="personale pt-5">
        <h1>Ciao <?= $_GET['email']; ?> ecco i tuoi eventi</h1>
        <div class="container">
            <div class="row">
                <?php if (count($userEvents) > 0) : ?>
                    <?php foreach ($userEvents as $event ) : ?>
                        <div class="col">
                            <div class="bullet">
                                <h2><?= $event['nome_evento'] ?></h2>
                                <p><?= $event['data_evento'] ?></p>
                                <div class="actions">
                                    <button name="login">JOIN</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col">
                        <div class="bullet">
                            <h2>NESSUN EVENTO</h2>
                        </div>
                    </div>
                <?php endif; ?>
            </div>




        </div>
    </section>
</main>
<?php
include __DIR__ . '/layout/footer.php';
?>