<?php
require_once 'baza.php';

    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];
    $tel = $_POST['telefon'];

    $geslo1 = sha1($geslo);

    $sql = "INSERT INTO uporabniki (ime, priimek, email, geslo, tel) VALUES ('$ime', '$priimek', '$email', '$geslo1', '$tel');";
    $result = mysqli_query($link, $sql);
    
    if($result){
        echo "$ime, $priimek, $email, $geslo1, $kraj";
    } else {
        echo 'Napaka pri vnosu podatkov.';
    }
?>

<!doctype html>
 <html>
    <meta charset="UTF-8">
    <title>Vnos uporabnikov</title>
    <meta http-equiv="refresh" content="2;url=izpis_uporabnikov.php">
 </html>