<?php
require_once 'baza.php';
session_start();
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

    <div class="login">
        <h2 class="login-title">Prijava</h2>
        <?php
            if (isset($_SESSION['login_error'])) {
                echo '<p style="color: red; font-weight: bold;">' . $_SESSION['login_error'] . '</p>';
                unset($_SESSION['login_error']);
            }
        ?>
        <form action="login_vmes.php" method="POST">
            <input type="email" name="email" id="email" class="input-field" placeholder="E-pošta" required> <br>
            <input type="password" name="geslo" id="geslo" class="input-field" placeholder="Geslo" required> <br>
            <button type="submit" class="submit-button">Prijava</button>
        </form>
        <a href="regist.php" class="register-link">Nimate računa? Registrirajte se tukaj!</a>
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