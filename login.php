<?php
require_once 'baza.php';
session_start();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Airros</title>
</head>
<body>
    <header class="header">
    <a href="index.php"> <img src="slike/logo.png" alt="tukaj je slika" class="logo"></a>
        <h1 class="naslov">AIRROS</h1>
    </header>

    <div class="login">
        <h2 class="login-title">Prijava</h2>
        <form action="login_vmes.php" method="POST">
            <input type="email" name="email" id="email" class="input-field" placeholder="E-pošta" required> <br>
            <input type="password" name="password" id="password" class="input-field" placeholder="Geslo" required> <br>
            <button type="submit" class="submit-button">Prijava</button>
        </form>
        <a href="regist.php" class="register-link">Nimate računa? Registrirajte se tukaj!</a>
    </div>
    <footer>
        <div class="footer">
            <p>Vse pravice pridržane &copy; 2023</p>
            <div class="social-media">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
</body>
</html>