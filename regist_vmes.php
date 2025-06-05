<?php
require_once 'baza.php';
session_start();

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$tel = $_POST['telefon'];
$email = $_POST['email'];
$geslo = $_POST['password'];
$vloga_id = 2;

$geslo1 = sha1($geslo);

$sql = "SELECT * FROM uporabniki WHERE email = '$email'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['reg_error'] = "Email je že v uporabi.";
    header("Location: regist.php");
    exit;
} else {
    $sql = "INSERT INTO uporabniki (ime, priimek, email, geslo, tel, vloga_id) VALUES ('$ime', '$priimek', '$email', '$geslo1', '$tel', '$vloga_id')";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $sql = "SELECT * FROM uporabniki WHERE email = '$email' AND geslo = '$geslo1'";
        $result1 = mysqli_query($link, $sql);

        if (mysqli_num_rows($result1) == 1) {
            $row = mysqli_fetch_assoc($result1);
            $_SESSION['email'] = $email;
            $_SESSION['id_u'] = $row['id_u'];
            header("Location: index.php");
        } else {
            echo '<p style="color: red; text-align: center;">Napaka pri vnosu podatkov.</p>';
        }
    } else {
        echo '<p style="color: red; text-align: center;">Napaka pri registraciji. Prosimo, poskusite znova.</p>';
    }
}
?>