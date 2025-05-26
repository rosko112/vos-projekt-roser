<?php
require_once 'baza.php';
session_start();

    if(isset($_POST['email']) && isset($_POST['geslo'])){
        $mail = $_POST['email'];
        $geslo = $_POST['geslo'];

        //$geslo1 = sha1($geslo);
        
        $sql = "SELECT * FROM uporabniki WHERE email = '$mail' AND geslo = '$geslo';";
        $result = mysqli_query($link, $sql);
        
        if(mysqli_num_rows($result) == 1){
            $_SESSION['email'] = $mail;
            header("Location: index_php");
        } else {
            echo 'Napačen email ali geslo.';

        }
    }      
?>