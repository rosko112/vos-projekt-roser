<?php
$host = 'sql101.infinityfree.com';
$user = 'if0_38992307';
$password = 'Xbr4qq5v2U7';
$database = 'if0_38992307_projekt';

$link=mysqli_connect($host,$user,$password,$database)
        or die('napaka pri povezavi z bazo');

mysqli_set_charset($link, "utf8");
date_default_timezone_set('Europe/Ljubljana');
?>
