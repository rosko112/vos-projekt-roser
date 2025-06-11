<?php
require_once 'baza.php';
session_start();

$id_uporabnika = $_SESSION['id_u'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $trenutno_geslo = $_POST['trenutno_geslo'];
    $novo_geslo = $_POST['novo_geslo'];
    $potrdi_novo_geslo = $_POST['potrdi_novo_geslo'];

    if ($novo_geslo !== $potrdi_novo_geslo) {
        echo "Novo geslo in potrditev se ne ujemata.";
        exit;
    }

    $sql = "SELECT geslo FROM uporabniki WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_uporabnika);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $trenutno_geslo_baza = $row['geslo'];

    } else {
        echo "Napaka pri pridobivanju gesla iz baze.";
        exit;
    }

    mysqli_stmt_close($stmt);

    if (sha1($trenutno_geslo) !== $trenutno_geslo_baza) {
        echo "Trenutno geslo ni pravilno.";
        exit;
    }

    $novo_geslo_sha1 = sha1($novo_geslo);

    $sql = "UPDATE uporabniki SET geslo = ? WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "si", $novo_geslo_sha1, $id_uporabnika);

    if (mysqli_stmt_execute($stmt)) {

        echo "Geslo je bilo uspešno spremenjeno.";
        header('Location: profil.php');
        exit;

    } else {

        echo "Napaka pri spreminjanju gesla: " . mysqli_error($link);
        
    }
    
    mysqli_stmt_close($stmt);
} 
?>
