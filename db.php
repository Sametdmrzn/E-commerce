<?php
// Veritabanı bağlantı ayarları
$servername = "localhost";  // genellikle localhost
$username = "root";         // phpMyAdmin'deki kullanıcı adın
$password = "";             // phpMyAdmin'deki şifren
$dbname = "bozkurt_toptan";  // veritabanı adın

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
