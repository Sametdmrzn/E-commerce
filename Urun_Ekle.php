<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen bilgileri al
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category = $_POST['category'];

    // Veritabanına ürün ekleme sorgusu
    $sql = "INSERT INTO products (name, price, stock_quantity, category) 
            VALUES ('$name', '$price', '$stock_quantity', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "Ürün başarıyla eklendi!";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
</head>
<body>

<h2>Ürün Ekleme Formu</h2>
<form method="post" action="add_product.php">
    <label for="name">Ürün Adı:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="price">Fiyat:</label><br>
    <input type="text" id="price" name="price" required><br><br>
    
    <label for="stock_quantity">Stok Miktarı:</label><br>
    <input type="text" id="stock_quantity" name="stock_quantity" required><br><br>
    
    <label for="category">Kategori:</label><br>
    <input type="text" id="category" name="category" required><br><br>
    
    <input type="submit" value="Ürün Ekle">
</form>

</body>
</html>
