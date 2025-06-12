<?php
session_start();
require_once 'baza.php';
include 'header.php';

if (!isset($_SESSION['id_u']) || $_SESSION['vloga_id'] != 1) {
    echo "Dostop zavrnjen.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <link rel="icon" href="slike/favicon.ico">
    <title>Airros</title>
</head>
<body class = "admin">
    <header class="header">
        <a href="index.php">
            <img src="slike/logo.png" alt="tukaj je slika" class="logo">
        </a>
        <h1 class="naslov">AIRROS</h1>
    </header>
    
<div class = "dodajanje">
<form action="dod_letov.php" method="post">
    Št. leta: <input type="text" name="st_leta" required><br>
    <input  type="hidden" name="st_sedezov" value="130">
    Čas odhoda: <input type="time" name="cas_odhoda" required><br>
    Čas prihoda: <input type="time" name="cas_prihoda" required><br>
    Datum odhoda: <input type="date" name="dat_odhoda" required><br>
    Datum prihoda: <input type="date" name="dat_prihoda" required><br>

    Kraj odhoda:
    <select name="id_o" required>
        <option value="">Izberi kraj odhoda</option>
        <?php
        $res = mysqli_query($link, 
            "SELECT ko.id_o, k.ime
            FROM kraji_odhodov ko
            INNER JOIN kraji k ON ko.id_k = k.id_k");

        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $row['id_o'] . "'>" . htmlspecialchars($row['ime']) . "</option>";
        }
        ?>
    </select><br>

    Kraj prihoda:
    <select name="id_p" required>
        <option value="">Izberi kraj prihoda</option>
        <?php
        $res2 = mysqli_query($link, 
            "SELECT kp.id_p, k.ime
            FROM kraji_prihodov kp
            INNER JOIN kraji k ON kp.id_k = k.id_k");

        while ($row2 = mysqli_fetch_assoc($res2)) {
            echo "<option value='" . $row2['id_p'] . "'>" . htmlspecialchars($row2['ime']) . "</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Dodaj let" class = "dodaj">
</form>
    <a href="admin_upor.php">Upravljanje uporabnikov</a>
</div>
</body>
</html>
