<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ürünü veritabanından silme sorgusu
    $sql = "DELETE FROM products WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Ürün başarıyla silindi!";
    } else {
        echo "Hata: " . $conn->error;
    }

    // Ürün silindikten sonra listeye yönlendir
    header("Location: list_products.php");
    exit();
}
?>
