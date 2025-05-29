<?php
session_start();
if (isset($_SESSION['email'])) {
    echo '<div style="position: fixed; top: 35px; right: 10px; padding: 10px; color: #9bdfe4; font-size: 20px; font-weight: bold; background: white; border-radius: 10px;">
            ' . ($_SESSION['email']) . ' <br>
            <a href="logout.php" style="margin-left: 90px; margin-top: 10px; color: red;">Odjava</a>
          </div>';
}
?>