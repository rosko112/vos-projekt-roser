<?php
session_start();
require_once 'baza.php';
include 'header.php';

if (!isset($_SESSION['id_u']) || $_SESSION['vloga_id'] != 1) {
    echo "Dostop zavrnjen.";
    exit();
}

$sql = "SELECT id_u, ime, priimek, email, tel, vloga_id FROM uporabniki";
$result = mysqli_query($link, $sql);

if (!$result) {
    die('Napaka pri pridobivanju uporabnikov: ' . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="slike/favicon.ico">
    <title>Upravljanje uporabnikov</title>
</head>
<body class="admin">
    <header class="header">
        <a href="index.php">
            <img src="slike/logo.png" alt="tukaj je slika" class="logo">
        </a>
        <h1 class="naslov">Upravljanje uporabnikov</h1>
    </header>

    <div class="uporabniki">
        <h2>Seznam uporabnikov</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Priimek</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Vloga</th>
                <th>Akcije</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id_u']; ?></td>
                    <td><?php echo ($row['ime']); ?></td>
                    <td><?php echo ($row['priimek']); ?></td>
                    <td><?php echo ($row['email']); ?></td>
                    <td><?php echo ($row['tel']); ?></td>
                    <td><?php echo $row['vloga_id'] == 1 ? 'Admin' : 'Uporabnik'; ?></td>
                    <td>
                        <form action="brisanje_upor.php" method="post" style="display: inline;">
                            <input type="hidden" name="id_u" value="<?php echo $row['id_u']; ?>">
                            <button type="submit" name="brisi_upor" class="delete-button">Izbriši</button>
                        </form>
                        <form action="sprem_vloge.php" method="post" style="display: inline;">
                            <input type="hidden" name="id_u" value="<?php echo $row['id_u']; ?>">
                            <select name="nova_vloga">
                                <option value="1" <?php echo $row['vloga_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                <option value="2" <?php echo $row['vloga_id'] == 2 ? 'selected' : ''; ?>>Uporabnik</option>
                            </select>
                            <button type="submit" name="sprem_vloge" class="role-button">Spremeni vlogo</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
