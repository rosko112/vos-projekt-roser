<?php
require_once 'baza.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $st_leta = $_POST['st_leta'];
    $st_sedezov = 130;
    $cas_odhoda = $_POST['cas_odhoda'];
    $cas_prihoda = $_POST['cas_prihoda'];
    $dat_odhoda = $_POST['dat_odhoda'];
    $dat_prihoda = $_POST['dat_prihoda'];
    $id_o = $_POST['id_o']; 
    $id_p = $_POST['id_p']; 

    $sql = "INSERT INTO leti 
        (st_leta, st_sedezov, cas_odhoda, cas_prihoda, dat_odhoda, dat_prihoda, id_o, id_p) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
        echo "<p>Napaka pri pripravi stavka: " . mysqli_error($link) . "</p>";
    }

    mysqli_stmt_bind_param($stmt, "sissssii", $st_leta, $st_sedezov, $cas_odhoda, $cas_prihoda, $dat_odhoda, $dat_prihoda, $id_o, $id_p);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: let_dod_uspeh.php");
        exit();
    } else {
        echo "<p>Napaka pri vnosu: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
}
?>
?>