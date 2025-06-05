<?php
require_once 'baza.php';
session_start();
include 'header.php';

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
        <a href="index.php">
            <img src="slike/logo.png" alt="tukaj je slika" class="logo">
        </a>
        <h1 class="naslov">AIRROS</h1>
        <?php
        if (!isset($_SESSION['email'])) {
            echo '<a href="login.php" class="prijava">Prijava</a>';
        }
        if ($_SESSION['vloga_id'] == 1) {
            echo '<a href="admin.php" style="padding: 10px 15px; background: #0077cc; color: white; border-radius: 5px; text-decoration: none;">Admin nadzor</a>';
        }
        ?>
    </header>

    <form action="rezultati.php" method="POST">
        <div class="iskanje">
            <label for="od">Od:</label>
                <select name="od" id="od">
                    <?php
                    $sql = 'SELECT k.id_k, k.ime AS kraj, d.ime AS drzava 
                            FROM kraji k 
                            JOIN drzave d ON k.drzava_id = d.id_d 
                            ORDER BY d.ime, k.ime';
                    $result = mysqli_query($link, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['id_k'] . '">' . $row['drzava'] . ' - ' . $row['kraj'] . '</option>';
                    }
                    ?>
                </select>
                <br>

                <label for="do">Do:</label>
                <select name="do" id="do">
                <option value="" selected disabled hidden>Destinacija</option>
                <?php
                    $sql = 'SELECT k.id_k, k.ime AS kraj, d.ime AS drzava 
                            FROM kraji k 
                            JOIN drzave d ON k.drzava_id = d.id_d 
                            ORDER BY d.ime, k.ime';
                    $result = mysqli_query($link, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['id_k'] . '">' . $row['drzava'] . ' - ' . $row['kraj'] . '</option>';
                    }
                    ?>
                </select>
            <br>
            <label for="datum_od">Datum od:</label>
            <input type="date" name="datum_od" id="datum_od" required min="<?php echo date('Y-m-d'); ?>">

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
