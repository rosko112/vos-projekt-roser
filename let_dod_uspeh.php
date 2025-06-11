<?php
session_start();
include 'header.php';
require_once 'baza.php';

if (!isset($_SESSION['id_u']) || $_SESSION['vloga_id'] != 1) {
    echo "<p>Dostop zavrnjen.</p>";
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
<body>
    <header class="header">
        <a href="index.php"> <img src="slike/logo.png" alt="tukaj je slika" class="logo"></a>
        <h1 class="naslov">AIRROS</h1>
    </header>

    <div class="uspeh">
        <h2 class="uspeh-naslov">Let uspešno dodan</h2>
        <p>Vaš let je bil uspešno dodan</p>
        <a href="admin.php" class="submit-button">Nazaj</a>
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
