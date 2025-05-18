<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css"> 
    <title>Airros</title>
</head>
<body>
    <header class="header">
        <a href="index.php">
            <img src="slike/logo.png" alt="tukaj je slika" class="logo">
        </a>
        <h1 class="naslov">AIRROS</h1>
        <a href="login.php" class="prijava">Prijava</a>
    </header>

    <form>
        <div class="iskanje">
            <input type="option" placeholder="Od">
            <input type="option" placeholder="do">
            <input type="date" placeholder="Datum od">
            <input type="date" placeholder="Datum do">
            <input type="number" placeholder="Število potnikov" min="1" max="10"> <br>
            <select>
                <option value="izbira">Izbira razreda</option>
                <option value="ekonomija">Ekonomija</option>
                <option value="prvi-razred">Prvi razred</option>
            </select> <br>
            <button type="submit" class="submit">Išči</button>
            <button type="reset" class="submit">Ponastavi</button>
        </div>
    </form>
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