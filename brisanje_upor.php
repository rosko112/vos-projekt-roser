<?php
require_once 'baza.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brisi_upor'])) {
    $id_u = $_POST['id_u'];

    $sql = "DELETE rl FROM rezervacije_leti rl
            INNER JOIN rezervacije r ON rl.id_r = r.id_r
            WHERE r.uporabnik_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (!mysqli_stmt_execute($stmt)) {
        echo "<p>Napaka pri brisanju rezervacij v rezervacije_leti: " . mysqli_stmt_error($stmt) . "</p>";
        mysqli_stmt_close($stmt);
        exit();
    }
    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM rezervacije WHERE uporabnik_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (!mysqli_stmt_execute($stmt)) {
        echo "<p>Napaka pri brisanju rezervacij: " . mysqli_stmt_error($stmt) . "</p>";
        mysqli_stmt_close($stmt);
        exit();
    }

    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM uporabniki WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Uporabnik je bil uspešno izbrisan.</p>";
        header("Location: admin_upor.php");
        exit();
    } else {
        echo "<p>Napaka pri brisanju uporabnika: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
}

?>