<?php
require_once 'baza.php';
include 'header.php';
session_start();

if (!isset($_SESSION['id_u'])) {
    header('Location: prijava.php');
    exit;
}

$id_uporabnika = ($_SESSION['id_u']);

$sql = "SELECT ime, priimek, email, geslo, tel FROM uporabniki WHERE id_u = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_uporabnika);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$uporabnik = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8" />
    <title>Profil uporabnika</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="slike/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="header">
    <a href="index.php"><img src="slike/logo.png" alt="logo" class="logo" /></a>
    <h1 class="naslov">Profil uporabnika</h1>
</header>

<div class="podatki">
    <h2>Dobrodošli, <?php echo ($uporabnik['ime'] . ' ' . $uporabnik['priimek']); ?>!</h2>
    <p><strong>Telefonska številka:</strong> <?php echo ($uporabnik['tel']); ?></p>
    <p><strong>Email:</strong> <?php echo ($uporabnik['email']); ?></p>
    <a href="spremeni_geslo.php" class="gumb">Spremeni geslo</a> <br>
    <a href="logout.php" class="gumb">Odjava</a>
</div>

<footer>
    <div class="footer">
        <p>© 2025 Airros. Vse pravice pridržane.</p>
    </div>
</footer>
</body>
</html>

<?php mysqli_close($link); ?>
