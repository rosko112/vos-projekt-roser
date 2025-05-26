<?php
session_start();
if (isset($_SESSION['email'])) {
    echo '<div style="position: fixed; top: 10px; right: 10px; background: #f0f0f0; padding: 10px; border: 1px solid #ccc;">
            Prijavljeni ste kot: ' . ($_SESSION['email']) . '
            <a href="logout.php" style="margin-left: 10px; color: red;">Odjava</a>
          </div>';
}
?>