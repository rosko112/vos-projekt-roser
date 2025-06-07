<?php
require_once 'baza.php';
session_start();

if (!isset($_SESSION['id_u'])) {
    header('Location: prijava.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_r = $_POST['id_r'];

    // Preveri, ali rezervacija pripada trenutnemu uporabniku
    $sql = "SELECT * FROM rezervacije WHERE id_r = ? AND uporabnik_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_r, $_SESSION['id_u']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Najprej izbriši povezane vrstice iz tabele rezervacije_leti
        $sql = "DELETE FROM rezervacije_leti WHERE id_r = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_r);
        if (!mysqli_stmt_execute($stmt)) {
            $_SESSION['error_message'] = "Napaka pri brisanju povezave rezervacije.";
            header('Location: profil.php');
            exit;
        }

        // Nato izbriši rezervacijo iz tabele rezervacije
        $sql = "DELETE FROM rezervacije WHERE id_r = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_r);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "Rezervacija je bila uspešno preklicana.";
        } else {
            $_SESSION['error_message'] = "Napaka pri preklicu rezervacije.";
        }
    } else {
        $_SESSION['error_message'] = "Rezervacija ni bila najdena ali ne pripada vam.";
    }

    header('Location: profil.php');
    exit;
}
?>