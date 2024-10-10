<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($product) ? htmlspecialchars($product['name']) : 'Ürün Detay'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        include 'db.php';

        // Hata raporlamasını etkinleştir
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                echo '<h1>' . htmlspecialchars($product['name']) . '</h1>'; // Ürün ismi
                echo '<p>' . htmlspecialchars($product['desctription']) . '</p>'; // Ürün açıklaması
                echo '<div class="price">₺' . htmlspecialchars($product['price']) . '</div>'; // Ürün fiyatı
                
                // Resmi base64 formatına çevir ve görüntüle
                $imageData = base64_encode($product['image_url']); // Resim binary verisi base64 formatına çevriliyor
                $src = 'data:image/jpeg;base64,' . $imageData; // Resmin data URI'si oluşturuluyor
                echo '<img src="' . $src . '" class="img-fluid" alt="' . htmlspecialchars($product['name']) . '">';

                // Sepete ekleme butonu
                echo '<form action="sepet.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                echo '<button type="submit" class="btn btn-success mt-3">Sepete Ekle</button>';
                echo '</form>';
                
                // Geri dön butonu
                echo '<a href="Urunler.php" class="btn btn-secondary mt-3">Geri Dön</a>';
            } else {
                echo 'Ürün bulunamadı.';
            }
        } else {
            echo 'Geçersiz ürün ID.';
        }
        ?>
    </div>
</body>
</html>
