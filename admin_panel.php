<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
</head>
<body>
    <h2>Admin Paneli</h2>
    <nav>
        <ul>
            <li><a href="urun_ekle.php">Ürün Ekle</a></li>
            <li><a href="urun_listesi.php">Ürün Listesi</a></li>
        </ul>
    </nav>
</body>
</html>
