<?php
require_once 'baza.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sprem_vloge'])) {
    $id_u = $_POST['id_u'];
    $nova_vloga = $_POST['nova_vloga'];

    $sql = "UPDATE uporabniki SET vloga_id = ? WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "ii", $nova_vloga, $id_u);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Vloga uporabnika je bila uspešno spremenjena.</p>";
        header("Location: admin_upor.php");
        exit();
    } else {
        echo "<p>Napaka pri spreminjanju vloge: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
}
?>