<?php
session_start();
include 'db.php';  // Veritabanı bağlantısını dahil et

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Form verilerini al
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock_quantity = $_POST['stock_quantity'];
$category = $_POST['category'];
$image_url = $_POST['image_url'];

// Veritabanına ekle
$sql = "INSERT INTO products (name, description, price, stock_quantity, category, image_url) 
        VALUES ('$name', '$description', $price, $stock_quantity, '$category', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "Ürün başarıyla eklendi!";
    echo "<br><a href='admin_panel.php'>Admin Paneline Dön</a>";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
