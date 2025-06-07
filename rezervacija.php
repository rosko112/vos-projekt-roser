<?php
require_once 'baza.php';
session_start();
include 'header.php';

if (!isset($_SESSION['id_u'])) {
    header("Location: login.php");
    exit;
}

$id_f = ($_POST['id_f']);
$st_leta = ($_POST['st_leta']);
$kraj_odhod = ($_POST['kraj_odhod']);
$drzava_od = ($_POST['drzava_od']);
$cas_odhoda = ($_POST['cas_odhoda']);
$dat_odhoda = ($_POST['dat_odhoda']);
$kraj_prihod = ($_POST['kraj_prihod']);
$drzava_pr = ($_POST['drzava_pr']);
$cas_prihoda = ($_POST['cas_prihoda']);
$dat_prihoda = ($_POST['dat_prihoda']);
$st_sedezov = ($_POST['st_sedezov']);
$cena = ($_POST['cena']);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podrobnosti rezervacije</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="slike/favicon.ico">
</head>
<body>
<header class="header">
    <a href="index.php">
        <img src="slike/logo.png" alt="logo" class="logo">
    </a>
    <h1 class="naslov">Podrobnosti rezervacije</h1>
</header>

<div class="rezervacija">
    <form action="rezervacije_vnos.php" method="post">
        <input type="hidden" name="id_f" value="<?php echo $id_f; ?>">
        <p><strong>Let št.:</strong> <?php echo ($st_leta); ?></p>
        <p><strong>Odhod:</strong> <?php echo ($kraj_odhod) . ' (' . ($drzava_od) . ')'; ?> ob <?php echo ($dat_odhoda) . ' ' . ($cas_odhoda); ?></p>
        <p><strong>Prihod:</strong> <?php echo ($kraj_prihod) . ' (' . ($drzava_pr) . ')'; ?> ob <?php echo ($dat_prihoda) . ' ' . ($cas_prihoda); ?></p>
        <p><strong>Število sedežev na voljo:</strong> <?php echo ($st_sedezov); ?></p>

        <label for="st_sed">Število sedežev:</label>
        <input type="number" id="st_sed" name="st_sed" min="1" max="10" required> <br>

        <label for="razred">Razred:</label>
        <select id="razred" name="id_s" required>
            <option value="1">Ekonomski (<?php echo (50); ?> €)</option>
            <option value="2">Poslovni (<?php echo (120); ?> €)</option>
            <option value="3">Prvi (<?php echo (250); ?> €)</option>
        </select> <br>

        <input type="submit" value="Potrdi rezervacijo">
    </form>
</div>

<footer>
        <div class="footer">
            <p>Vse pravice pridržane &copy; 2023</p>
            <div class="social-media">
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                <a href="o_nas.php"> O nas </a>
                <a href="https://www.twitter.com/" target="_blank">Twitter</a>
            </div>
        </div>
    </footer>
</body>
</html>
