<?php
require_once 'baza.php';
session_start();

if (isset($_POST['email']) && isset($_POST['geslo'])) {
    $mail = $_POST['email'];
    $spremenjen_mail = ($mail);
    $geslo = $_POST['geslo'];
    $spremenjeno_geslo = ($geslo);

    $geslo1 = sha1($spremenjeno_geslo);

    $stmt = mysqli_prepare($link, "SELECT id_u, vloga_id FROM uporabniki WHERE email = ? AND geslo = ?");
    mysqli_stmt_bind_param($stmt, "ss", $mail, $geslo1);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id_u, $vloga_id);
        mysqli_stmt_fetch($stmt);

        $_SESSION['email'] = $mail;
        $_SESSION['id_u'] = $id_u;
        $_SESSION['vloga_id'] = $vloga_id; 

        header("Location: index.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Napačen email ali geslo.";
        header("Location: login.php");
        exit;
    }

    mysqli_stmt_close($stmt);
}
?>
