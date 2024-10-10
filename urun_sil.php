<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepared statement ile güvenli silme sorgusu
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" integer tipinde bir parametre olduğunu belirtir
    if ($stmt->execute()) {
        echo "Ürün başarıyla silindi!";
    } else {
        echo "Hata: " . $stmt->error;
    }

    // Ürün silindikten sonra listeye yönlendir
    header("Location: urun_listesi.php");
    exit();
}
include 'admin_navbar.php';
?>
