<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

// Kategorileri veritabanından çekme
$category_sql = "SELECT name FROM categories";
$category_result = $conn->query($category_sql);

// Kategori ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $new_category = $_POST['new_category'];

    // Veritabanına yeni kategori ekleme sorgusu
    $category_stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $category_stmt->bind_param("s", $new_category);

    if ($category_stmt->execute()) {
        echo "Yeni kategori başarıyla eklendi!";
    } else {
        echo "Hata: " . $category_stmt->error;
    }

    $category_stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    // Formdan gelen bilgileri al
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category = $_POST['category'];

    // Resim dosyasını kontrol et ve BLOB olarak işle
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Dosyayı geçici yerden al
        $image = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $image = null; // Eğer resim yüklenmezse, null olarak kaydedilir
    }

    // Veritabanına ürün ekleme sorgusu (resim BLOB formatında kaydediliyor)
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock_quantity, category, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $stock_quantity, $category, $image);

    if ($stmt->execute()) {
        echo "Ürün başarıyla eklendi!";
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
}

include 'admin_navbar.php';
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
<!-- Resim yükleme için enctype eklenmeli -->
<form method="post" action="Urun_Ekle.php" enctype="multipart/form-data">
    <label for="name">Ürün Adı:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="price">Fiyat:</label><br>
    <input type="text" id="price" name="price" required><br><br>
    
    <label for="stock_quantity">Stok Miktarı:</label><br>
    <input type="text" id="stock_quantity" name="stock_quantity" required><br><br>
    
    <label for="category">Kategori:</label><br>
    <select id="category" name="category" required>
        <option value="">Kategori Seçin</option>
        <?php
        if ($category_result->num_rows > 0) {
            while ($row = $category_result->fetch_assoc()) {
                echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
        }
        ?>
    </select><br><br>

    <!-- Resim yükleme alanı -->
    <label for="image">Ürün Resmi:</label><br>
    <input type="file" id="image" name="image" accept="image/*"><br><br>
    
    <input type="submit" name="add_product" value="Ürün Ekle">
</form>

<h2>Yeni Kategori Ekle</h2>
<form method="post" action="Urun_Ekle.php">
    <label for="new_category">Yeni Kategori Adı:</label><br>
    <input type="text" id="new_category" name="new_category" required><br><br>
    
    <input type="submit" name="add_category" value="Kategori Ekle">
</form>

</body>
</html>
