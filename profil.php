<?php
require_once 'baza.php';
include 'header.php';
session_start();

if (!isset($_SESSION['id_u'])) {
    header('Location: prijava.php');
    exit;
}

$id_uporabnika = ($_SESSION['id_u']);

// Fetch user details
$sql = "SELECT ime, priimek, email, geslo, tel FROM uporabniki WHERE id_u = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_uporabnika);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$uporabnik = mysqli_fetch_assoc($result);

// Fetch user reservations
$reservations_sql = "SELECT r.id_r, r.datum_rez, r.st_sed, r.st_vrste, r.cena, l.st_leta, l.dat_odhoda, l.cas_odhoda, l.dat_prihoda, l.cas_prihoda, 
                    k_od.ime AS kraj_odhod, k_pr.ime AS kraj_prihod, d_od.ime AS drzava_od, d_pr.ime AS drzava_pr
                    FROM rezervacije r
                    INNER JOIN rezervacije_leti rl ON r.id_r = rl.id_r
                    INNER JOIN leti l ON rl.id_f = l.id_f
                    INNER JOIN kraji_odhodov ko ON l.id_o = ko.id_o
                    INNER JOIN kraji_prihodov kp ON l.id_p = kp.id_p
                    INNER JOIN kraji k_od ON ko.id_k = k_od.id_k
                    INNER JOIN kraji k_pr ON kp.id_k = k_pr.id_k
                    INNER JOIN drzave d_od ON k_od.drzava_id = d_od.id_d
                    INNER JOIN drzave d_pr ON k_pr.drzava_id = d_pr.id_d
                    WHERE r.uporabnik_id = ?
                    ORDER BY r.datum_rez DESC";
$reservations_stmt = mysqli_prepare($link, $reservations_sql);
mysqli_stmt_bind_param($reservations_stmt, "i", $id_uporabnika);
mysqli_stmt_execute($reservations_stmt);
$reservations_result = mysqli_stmt_get_result($reservations_stmt);
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
    <a href="spremeni_geslo.php" class="gumb">Spremeni geslo</a> <br> <br>
    <a href="logout.php" class="gumb">Odjava</a>
</div>

<div class="rezervacije">
    <h2 style = "text-align: center; color: #0077cc; background-color: white;">Vaše rezervacije</h2>
    <?php if (mysqli_num_rows($reservations_result) > 0): ?>
        <table border="1">
            <tr>
                <th>Let št.</th>
                <th>Odhod</th>
                <th>Prihod</th>
                <th>Datum rezervacije</th>
                <th>Sedež</th>
                <th>Vrsta</th>
                <th>Cena</th>
            </tr>
            <?php while ($reservation = mysqli_fetch_assoc($reservations_result)): ?>
                <tr>
                    <td><?php echo $reservation['st_leta']; ?></td>
                    <td><?php echo $reservation['drzava_od'] . ' - ' . $reservation['kraj_odhod'] . '<br>' . $reservation['dat_odhoda'] . ' ' . $reservation['cas_odhoda']; ?></td>
                    <td><?php echo $reservation['drzava_pr'] . ' - ' . $reservation['kraj_prihod'] . '<br>' . $reservation['dat_prihoda'] . ' ' . $reservation['cas_prihoda']; ?></td>
                    <td><?php echo $reservation['datum_rez']; ?></td>
                    <td><?php echo $reservation['st_sed']; ?></td>
                    <td><?php echo $reservation['st_vrste']; ?></td>
                    <td><?php echo $reservation['cena']; ?> €</td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Trenutno nimate nobenih rezervacij.</p>
    <?php endif; ?>
</div>

<footer>
    <div class="footer">
        <p>© 2025 Airros. Vse pravice pridržane.</p>
    </div>
</footer>
</body>
</html>

<?php mysqli_close($link); ?>
