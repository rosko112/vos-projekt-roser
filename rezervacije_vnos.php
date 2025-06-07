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

            $check_sql = "SELECT COUNT(*) AS count FROM rezervacije WHERE st_sed = $st_sed AND st_vrste = $st_vrste AND id_s = $id_sedeza";
            $check_result = mysqli_query($link, $check_sql);
            $row = mysqli_fetch_assoc($check_result);
        } while ($row['count'] > 0);

        $sql = "INSERT INTO rezervacije (datum_rez, st_sed, st_vrste, uporabnik_id, id_s, cena) 
                VALUES (NOW(), $st_sed, $st_vrste, $id_uporabnika, $id_sedeza, $cena)";
        if (mysqli_query($link, $sql)) {
            $id_rezervacije = mysqli_insert_id($link);

            $check_flight_sql = "SELECT COUNT(*) AS count FROM rezervacije_leti WHERE id_r = $id_rezervacije AND id_f = $id_leta";
            $check_flight_result = mysqli_query($link, $check_flight_sql);
            $flight_row = mysqli_fetch_assoc($check_flight_result);

            if ($flight_row['count'] == 0) {
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