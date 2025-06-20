<!DOCTYPE html>
<html lang="sl">
<?php
include 'header.php';
?>
<head>
    <meta charset="UTF-8">
    <title>Spremeni geslo</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="slike/favicon.ico">
</head>
<body>
<header class="header">
    <a href="index.php"><img src="slike/logo.png" alt="logo" class="logo"></a>
    <h1 class="naslov">Spremeni geslo</h1>
</header>
<div class="spremeni-geslo">
    <form action="spremeni_geslo_vmes.php" method="POST">
        <label for="trenutno_geslo">Trenutno geslo:</label>
        <input type="password" id="trenutno_geslo" name="trenutno_geslo" required>
        <br>
        <label for="novo_geslo">Novo geslo:</label>
        <input type="password" id="novo_geslo" name="novo_geslo" required>
        <br>
        <label for="potrdi_novo_geslo">Potrdi novo geslo:</label>
        <input type="password" id="potrdi_novo_geslo" name="potrdi_novo_geslo" required>
        <br>
        <button type="submit">Spremeni geslo</button>
    </form>
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