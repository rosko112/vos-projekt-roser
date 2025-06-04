<?php
session_start();
require_once 'baza.php';
include 'header.php';

if (!isset($_SESSION['id_u']) || $_SESSION['vloga_id'] != 1) {
    echo "Dostop zavrnjen.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $st_leta = $_POST['st_leta'];
    $st_sedezov = $_POST['st_sedezov'];
    $cas_odhoda = $_POST['cas_odhoda'];
    $cas_prihoda = $_POST['cas_prihoda'];
    $dat_odhoda = $_POST['dat_odhoda'];
    $dat_prihoda = $_POST['dat_prihoda'];
    $id_o = $_POST['id_o']; 
    $id_p = $_POST['id_p']; 

    $sql = "INSERT INTO leti 
        (st_leta, st_sedezov, cas_odhoda, cas_prihoda, dat_odhoda, dat_prihoda, id_o, id_p) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "sissssii", $st_leta, $st_sedezov, $cas_odhoda, $cas_prihoda, $dat_odhoda, $dat_prihoda, $id_o, $id_p);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Let je bil uspešno dodan.</p>";
    } else {
        echo "<p>Napaka pri vnosu: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
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
<form action="" method="post">
    Št. leta: <input type="text" name="st_leta" required><br>
    Št. sedežev: <input type="number" name="st_sedezov" required><br>
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
</div>
    <a href="index.php">Domov</a> <br><br>
<footer>
        <div class="footer">
            <p>Vse pravice pridržane &copy; 2023</p>
            <div class="social-media">
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                <a href="https://www.instagram.com/" target="_blank">Instagram</a>
                <a href="https://www.twitter.com/" target="_blank">Twitter</a>
            </div>
        </div>
    </footer>
</body>
</html>
