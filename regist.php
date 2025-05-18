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
        <h2 class="login-title">Registracija</h2>
        <form action="login.php" method="post">
            <input type="text" name="ime" id="ime" class="input-field" placeholder="Ime" required> <br>
            <input type="text" name="priimek" id="priimek" class="input-field" placeholder="Priimek" required> <br>
            <input type="text" name="naslov" id="naslov" class="input-field" placeholder="Naslov" required> <br>
            <input type="text" name="telefon" id="telefon" class="input-field" placeholder="Telefon" required> <br>
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
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
</body>
</html>