<?php
require_once 'baza.php';
include 'header.php';
session_start();

if (!isset($_SESSION['id_u'])) {
    header('Location: prijava.php');
    exit;
}

$id_uporabnika = ($_SESSION['id_u']);

$sql = "SELECT ime, priimek, email, geslo, tel FROM uporabniki WHERE id_u = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_uporabnika);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$uporabnik = mysqli_fetch_assoc($result);

$rezervacije_sql = "SELECT r.id_r, r.datum_rez, r.st_sed, r.st_vrste, r.cena, l.st_leta, l.dat_odhoda, l.cas_odhoda, l.dat_prihoda, l.cas_prihoda, 
                    k_od.ime AS kraj_odhod, k_pr.ime AS kraj_prihod, d_od.ime AS drzava_od, d_pr.ime AS drzava_pr
                    FROM rezervacije r
                    INNER JOIN rezervacije_leti rl ON r.id_r = rl.id_r
                    INNER JOIN leti l ON rl.id_f = l.id_f
                    INNER JOIN kraji_odhodov ko ON l.id_o = ko.id_o
                    INNER JOIN kraji_prihodov kp ON l.id_p = kp.id_p
                    INNER JOIN kraji k_od ON ko.id_k = k_od.id_k
                    INNER JOIN kraji k_pr ON kp.id_k = k_pr.id_k
                    INNER JOIN drzave d_od ON k_od.drzava_id = d_od.id_d
                    INNER JOIN drzave d_pr ON k_pr.drzava_id = d_pr.id_d
                    WHERE r.uporabnik_id = ?
                    ORDER BY r.datum_rez DESC";
$rezervacije_stmt = mysqli_prepare($link, $rezervacije_sql);
mysqli_stmt_bind_param($rezervacije_stmt, "i", $id_uporabnika);
mysqli_stmt_execute($rezervacije_stmt);
$rezervacije_result = mysqli_stmt_get_result($rezervacije_stmt);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8" />
    <title>Profil uporabnika</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="slike/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="header">
    <a href="index.php"><img src="slike/logo.png" alt="logo" class="logo" /></a>
    <h1 class="naslov">Profil uporabnika</h1>
</header>

<div class="podatki">
    <h2>Dobrodošli, <?php echo ($uporabnik['ime'] . ' ' . $uporabnik['priimek']); ?>!</h2>
    <p><strong>Telefonska številka:</strong> <?php echo ($uporabnik['tel']); ?></p>
    <p><strong>Email:</strong> <?php echo ($uporabnik['email']); ?></p>
    <a href="spremeni_geslo.php" class="gumb">Spremeni geslo</a> <br> <br>
    <a href="logout.php" class="gumb">Odjava</a>
</div>

<div class="rezervacije" style="background-color: white; padding-top: 10px; border-radius: 10px; padding-bottom: 10px;">
    <h2 style="text-align: center; color: #0077cc; background-color: white;">Vaše rezervacije</h2>
    <?php
            if (isset($_SESSION['napaca_message'])) {
                echo '<p style="color: red; font-weight: bold; text-align: center; background-color: white;">' . $_SESSION['napaca_message'] . '</p>';
                unset($_SESSION['napaca_error']);
            }

            if (isset($_SESSION['uspeh_message'])) {
                echo '<p style="color: green; font-weight: bold; text-align: center; background-color: white;">' . $_SESSION['uspeh_message'] . '</p>';
                unset($_SESSION['uspeh_message']);
            }
        ?>
    <?php if (mysqli_num_rows($rezervacije_result) > 0): ?>
        <table border="1">
            <tr>
                <th>Let št.</th>
                <th>Odhod</th>
                <th>Prihod</th>
                <th>Datum rezervacije</th>
                <th>Sedež</th>
                <th>Vrsta</th>
                <th>Cena</th>
                <th>Status</th>
                <th>Preklic</th>
            </tr>
            <?php while ($rezervacije = mysqli_fetch_assoc($rezervacije_result)): ?>
                <tr>
                    <td><?php echo $rezervacije['st_leta']; ?></td>
                    <td><?php echo $rezervacije['drzava_od'] . ' - ' . $rezervacije['kraj_odhod'] . '<br>' . $rezervacije['dat_odhoda'] . '<br>' . $rezervacije['cas_odhoda']; ?></td>
                    <td><?php echo $rezervacije['drzava_pr'] . ' - ' . $rezervacije['kraj_prihod'] . '<br>' . $rezervacije['dat_prihoda'] . '<br>' . $rezervacije['cas_prihoda']; ?></td>
                    <td><?php echo $rezervacije['datum_rez']; ?></td>
                    <td><?php echo $rezervacije['st_sed']; ?></td>
                    <td><?php echo $rezervacije['st_vrste']; ?></td>
                    <td><?php echo $rezervacije['cena']; ?> €</td>
                    <td>
                        <?php
                        $current_date = date('Y-m-d H:i:s');
                        $dat_leta = $rezervacije['dat_odhoda'] . ' ' . $rezervacije['cas_odhoda'];
                        if ($trenuten_dat > $dat_leta) {
                            echo '<span style="color: red; font-weight: bold;">Preteklo</span>';
                        } else {
                            echo '<span style="color: green; font-weight: bold;">Aktivno</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($trenuten_dat <= $dat_leta): ?>
                            <form action="preklic_rezervacije.php" method="post" style="margin: 0;">
                                <input type="hidden" name="id_r" value="<?php echo $rezervacije['id_r']; ?>">
                                <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;font-weight: bold;">Prekliči</button>
                            </form>
                        <?php else: ?>
                            <span style="color: gray;">Ni mogoče preklicati</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style = "text-align: center; color: #0077cc; font-weight: bold;">Trenutno nimate nobenih rezervacij.</p>
    <?php endif; ?>
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

<?php mysqli_close($link); ?>
