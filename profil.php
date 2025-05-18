<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css"> <!-- Use the same CSS file -->
    <title>Profil</title>
</head>
<body>
    <header class="header">
        <a href="index.php">
            <img src="slike/logo.png" alt="tukaj je slika" class="logo">
        </a>
        <h1 class="naslov">AIRROS</h1>
        <a href="login.php" class="prijava">Prijava</a>
    </header>

    <div class="profil">
        <h2 class="profil-title">Moj profil</h2>
        <form action="profil.php" method="post">
            <input type="text" name="ime" id="ime" class="input-field" placeholder="Ime" required> <br>
            <input type="text" name="priimek" id="priimek" class="input-field" placeholder="Priimek" required> <br>
            <input type="text" name="naslov" id="naslov" class="input-field" placeholder="Naslov" required> <br>
            <input type="text" name="telefon" id="telefon" class="input-field" placeholder="Telefon" required> <br>
            <input type="email" name="email" id="email" class="input-field" placeholder="E-pošta" required> <br>
            <button type="submit" class="submit-button">Shrani spremembe</button>
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
    </footer>