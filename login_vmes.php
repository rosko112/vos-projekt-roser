<?php
require_once 'baza.php';
session_start();

if (isset($_POST['email']) && isset($_POST['geslo'])) {
    $mail = $_POST['email'];
    $spremenjen_mail = htmlspecialchars($mail);
    $geslo = $_POST['geslo'];
    $spremenjeno_geslo = htmlspecialchars($geslo);

    $geslo1 = sha1($spremenjeno_geslo);

    $sql = "SELECT id_u, vloga_id FROM uporabniki WHERE email = ? AND geslo = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $mail, $geslo1);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['email'] = $mail;
            $_SESSION['id_u'] = $row['id_u'];
            $_SESSION['vloga_id'] = $row['vloga_id'];

            header("Location: index.php");
            exit;
    } else {
        $_SESSION['login_error'] = "Napačen email ali geslo.";
        header("Location: login.php");
        exit;
    }

    mysqli_stmt_close($stmt);
}
}
?>
