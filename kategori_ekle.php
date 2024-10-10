<?php
include 'db.php'; // Veritabanı bağlantısını ekle

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen bilgileri al
    $name = $_POST['name'];

    // Veritabanına kategori ekleme sorgusu
    $sql = "INSERT INTO categories (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Kategori başarıyla eklendi!";
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
    <title>Kategori Ekle</title>
</head>
<body>

<h2>Kategori Ekleme Formu</h2>
<form method="post" action="kategori_ekle.php">
    <label for="name">Kategori Adı:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <input type="submit" value="Kategori Ekle">
</form>

</body>
</html>
