<?php
session_start();
require_once 'baza.php';
include 'header.php';

if (!isset($_SESSION['id_u']) || $_SESSION['vloga_id'] != 1) {
    echo "Dostop zavrnjen.";
    exit();
}

// Brisanje uporabnika
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id_u = $_POST['id_u'];

    // Brisanje povezanih rezervacij v rezervacije_leti
    $sql = "DELETE rl FROM rezervacije_leti rl
            INNER JOIN rezervacije r ON rl.id_r = r.id_r
            WHERE r.uporabnik_id = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (!mysqli_stmt_execute($stmt)) {
        echo "<p>Napaka pri brisanju rezervacij v rezervacije_leti: " . mysqli_stmt_error($stmt) . "</p>";
        mysqli_stmt_close($stmt);
        exit();
    }

    mysqli_stmt_close($stmt);

    // Brisanje rezervacij v rezervacije
    $sql = "DELETE FROM rezervacije WHERE uporabnik_id = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (!mysqli_stmt_execute($stmt)) {
        echo "<p>Napaka pri brisanju rezervacij: " . mysqli_stmt_error($stmt) . "</p>";
        mysqli_stmt_close($stmt);
        exit();
    }

    mysqli_stmt_close($stmt);

    // Brisanje uporabnika
    $sql = "DELETE FROM uporabniki WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "i", $id_u);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Uporabnik je bil uspešno izbrisan.</p>";
        header("Location: admin_upor.php");
        exit();
    } else {
        echo "<p>Napaka pri brisanju uporabnika: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
}

// Spreminjanje vloge uporabnika
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_role'])) {
    $id_u = $_POST['id_u'];
    $new_role = $_POST['new_role'];

    $sql = "UPDATE uporabniki SET vloga_id = ? WHERE id_u = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        die('Napaka pri pripravi stavka: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "ii", $new_role, $id_u);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Vloga uporabnika je bila uspešno spremenjena.</p>";
        header("Location: admin_upor.php");
        exit();
    } else {
        echo "<p>Napaka pri spreminjanju vloge: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
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
                    <td><?php echo htmlspecialchars($row['ime']); ?></td>
                    <td><?php echo htmlspecialchars($row['priimek']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['tel']); ?></td>
                    <td><?php echo $row['vloga_id'] == 1 ? 'Admin' : 'Uporabnik'; ?></td>
                    <td>
                        <!-- Brisanje uporabnika -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="id_u" value="<?php echo $row['id_u']; ?>">
                            <button type="submit" name="delete_user" class="delete-button">Izbriši</button>
                        </form>
                        <!-- Spreminjanje vloge -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="id_u" value="<?php echo $row['id_u']; ?>">
                            <select name="new_role">
                                <option value="1" <?php echo $row['vloga_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                <option value="2" <?php echo $row['vloga_id'] == 2 ? 'selected' : ''; ?>>Uporabnik</option>
                            </select>
                            <button type="submit" name="change_role" class="role-button">Spremeni vlogo</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <div class="footer">
            <p>Vse pravice pridržane &copy; 2023</p>
            <div class="social-media">
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                <a href="o_nas.php"> O nas </a>
                <a href="https://www.twitter.com/" target="_blank">Twitter</a>
            </div>
        </div>
    </footer>
</body>
</html>