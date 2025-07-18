<?php
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
        <h2 class="login-title">Registracija</h2>
        <?php
            if (isset($_SESSION['reg_error'])) {
                echo '<p style="color: red; font-weight: bold;">' . $_SESSION['reg_error'] . '</p>';
                unset($_SESSION['reg_error']);
            }
        ?>
        <form action="regist_vmes.php" method="post">
            <input type="text" name="ime" id="ime" class="input-field" placeholder="Ime" required> <br>
            <input type="text" name="priimek" id="priimek" class="input-field" placeholder="Priimek" required> <br>
            <input type="tel" id="telefon" name="telefon" class="input-field" placeholder="Telefon" required pattern="[0-9]{9}" title="Vnesite veljavno telefonsko številko." /><br>
            <input type="email" name="email" id="email" class="input-field" placeholder="E-pošta" required> <br>
            <input type="password" name="password" id="password" class="input-field" placeholder="Geslo" required> <br>
            <a href="login.php" class="register-link">Že imate račun? Prijavite se tukaj!</a> <br>
            <button type="submit" class="submit-button">Registriraj se</button>
        </form>
    </div>
    <footer>
        <div class="footer">
            <p>Vse pravice pridržane &copy; 2023</p>
            <div class="social-media">
                <a href="#">Facebook</a>
                <a href="o_nas.php"> O nas </a>
                <a href="#">Twitter</a>
            </div>
        </div>
</body>
</html>