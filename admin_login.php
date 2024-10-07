<?php
session_start();

$admin_username = 'admin';  // Sabit kullanıcı adı
$admin_password = '12345';  // Sabit şifre

if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
    $_SESSION['admin_logged_in'] = true;  // Oturum başlat
    header("Location: admin_panel.php");  // Admin paneline yönlendir
} else {
    echo "Geçersiz kullanıcı adı veya şifre!";
}
?>
