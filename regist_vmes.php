<?php
require_once 'baza.php';

    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $tel = $_POST['telefon'];
    $email = $_POST['email'];
    $geslo = $_POST['password'];
   
    $vloga_id = 1;

    $geslo1 = sha1($geslo);

    $sql = "INSERT INTO uporabniki (ime, priimek, email, geslo, tel, vloga_id) VALUES ('$ime', '$priimek', '$email', '$geslo1', '$tel', '$vloga_id');";
    $result = mysqli_query($link, $sql);
    
    if($result){
        echo "$ime, $priimek, $email, $geslo1, $tel, $vloga_id";
        header("Location: index.php");
        exit();
    } else {
        echo 'Napaka pri vnosu podatkov.';
    }
?>