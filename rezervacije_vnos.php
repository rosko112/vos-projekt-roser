<?php
require_once 'baza.php';
session_start();

if (!isset($_SESSION['id_u'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_leta = $_POST['id_f'];
    $id_sedeza = $_POST['id_s']; 
    $id_uporabnika = $_SESSION['id_u'];
    $st_sed_total = $_POST['st_sed'];

    $zac_cena_sql = "SELECT cena FROM sedezi WHERE id_s = $id_sedeza";
    $zac_cena_result = mysqli_query($link, $zac_cena_sql);
    $zac_cena_row = mysqli_fetch_assoc($zac_cena_result);

    if (!$zac_cena_row) {
        echo "Napaka: Neveljaven sedež.";
        exit;
    }

    $cena = $zac_cena_row['cena'];

    for ($i = 0; $i < $st_sed_total; $i++) {
        do {
            $st_sed = rand(1, 140);
            $st_vrste = rand(1, 20);

            $preveri_sql = "SELECT COUNT(*) AS count FROM rezervacije WHERE st_sed = $st_sed AND st_vrste = $st_vrste AND id_s = $id_sedeza";
            $preveri_result = mysqli_query($link, $preveri_sql);
            $row = mysqli_fetch_assoc($preveri_result);
        } while ($row['count'] > 0);

        $sql = "INSERT INTO rezervacije (datum_rez, st_sed, st_vrste, uporabnik_id, id_s, cena) 
                VALUES (NOW(), $st_sed, $st_vrste, $id_uporabnika, $id_sedeza, $cena)";
        if (mysqli_query($link, $sql)) {
            $id_rezervacije = mysqli_insert_id($link);

            $preveri_let_sql = "SELECT COUNT(*) AS count FROM rezervacije_leti WHERE id_r = $id_rezervacije AND id_f = $id_leta";
            $preveri_let_result = mysqli_query($link, $preveri_let_sql);
            $let_vrsta = mysqli_fetch_assoc($preveri_let_result);

            if ($let_vrsta['count'] == 0) {
            $sql2 = "INSERT INTO rezervacije_leti (id_r, id_f) VALUES ($id_rezervacije, $id_leta)";
            if (!mysqli_query($link, $sql2)) {
                echo "<p>Napaka pri povezovanju rezervacije z letom: " . mysqli_error($link) . "</p>";
            }
        } else {
            header("Location: rezervacija_neuspeh.php");
            exit;
        }
    }
    }
    header("Location: rezervacija_uspeh.php");
}

mysqli_close($link);
?>