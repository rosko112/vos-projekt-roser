<?php
require_once 'baza.php';
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultati iskanja</title>
    <link rel="icon" href="slike/favicon.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <a href="index.php"><img src="slike/logo.png" alt="logo" class="logo"></a>
    <h1 class="naslov">Rezultati letov</h1>
</header>

<div class="rezultati">
<?php
$od = $_POST['od'];
$do = $_POST['do'];
$datum_od = $_POST['datum_od'];

$sql = "SELECT l.*, 
    ko.id_k AS id_k_odhod, 
    kp.id_k AS id_k_prihod,
    k_od.ime AS kraj_odhod, 
    k_pr.ime AS kraj_prihod,
    d_od.ime AS drzava_od, 
    d_pr.ime AS drzava_pr
FROM leti l INNER JOIN kraji_odhodov ko ON l.id_o = ko.id_o
INNER JOIN kraji_prihodov kp ON l.id_p = kp.id_p
INNER JOIN kraji k_od ON ko.id_k = k_od.id_k
INNER JOIN kraji k_pr ON kp.id_k = k_pr.id_k
INNER JOIN drzave d_od ON k_od.drzava_id = d_od.id_d
INNER JOIN drzave d_pr ON k_pr.drzava_id = d_pr.id_d
WHERE 
    ko.id_k = '$od' AND
    kp.id_k = '$do' AND
    l.dat_odhoda >= '$datum_od'
ORDER BY l.dat_odhoda, l.cas_odhoda";

$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Let št.</th><th>Odhod (z uro)</th><th>Prihod (z uro)</th><th>Datum</th><th>Sedeži na voljo</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . ($row['st_leta']) . "</td>";
        echo "<td>" . ($row['drzava_od']) . " - " . ($row['kraj_odhod']) . "<br><strong>" . ($row['cas_odhoda']) . "</strong></td>";
        echo "<td>" . ($row['drzava_pr']) . " - " . ($row['kraj_prihod']) . "<br><strong>" . ($row['cas_prihoda']) . "</strong></td>";
        echo "<td>" . ($row['dat_odhoda']) . "</td>";
        echo "<td>" . ($row['st_sedezov']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p class = 'napaca'>Za izbrane kriterije ni na voljo nobenega leta.</p>";
}

mysqli_close($link);
?>
</div>

<footer>
    <div class="footer">
        <p>© 2025 Airros. Vse pravice pridržane.</p>
    </div>
</footer>
</body>
</html>
