<?php
require_once 'baza.php';
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="slike/favicon.ico">
    <title>O nas - Airros</title>
</head>
<body>
<header class="header">
    <a href="index.php"><img src="slike/logo.png" alt="logo" class="logo"></a>
    <h1 class="naslov">O nas</h1>
</header>

<div class="onas">
    <h2>Naša zgodba</h2>
    <p>
        Airros je nastal leta 2010 z vizijo, da poveže ljudi po vsem svetu. Naše podjetje se je začelo kot majhna skupina
        navdušencev nad letalstvom, ki so želeli ustvariti bolj dostopne in prijetne letalske storitve. Z leti smo rasli
        in se razvijali, vendar je naša strast do povezovanja ljudi ostala enaka.
    </p>
    <p>
        Danes Airros ponuja lete v več kot 50 držav po vsem svetu. Naša ekipa več kot 500 predanih zaposlenih vsak dan
        dela na tem, da vam zagotovi najboljšo izkušnjo. Od trenutka, ko rezervirate let, do trenutka, ko pristanete na
        svoji destinaciji.
    </p>

    <h2>Naša vizija</h2>
    <p>
        Naša vizija je ustvariti svet, kjer so potovanja dostopna vsem. Verjamemo, da potovanja niso le premikanje iz
        ene točke v drugo, temveč priložnost za odkrivanje novih kultur, ustvarjanje spominov in povezovanje z ljudmi.
    </p>

    <h2>Zakaj izbrati nas?</h2>
    <ul>
        <li>Ugodne cene letalskih kart</li>
        <li>Prijazna in strokovna podpora strankam</li>
        <li>Več kot 10 let izkušenj v letalski industriji</li>
        <li>Sodobna in okolju prijazna flota letal</li>
    </ul>

    <h2>Kontakt</h2>
    <p>
        Če imate kakršna koli vprašanja, nas lahko kontaktirate na:
        <br><strong>Email:</strong> info@airros.com
        <br><strong>Telefon:</strong> +386 1 234 5678
    </p>
</div>

<footer>
    <div class="footer">
        <p>Vse pravice pridržane &copy; 2023 Airros</p>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank">Facebook</a>
            <a href="https://www.instagram.com/" target="_blank">Instagram</a>
            <a href="https://www.twitter.com/" target="_blank">Twitter</a>
        </div>
    </div>
</footer>
</body>
</html>