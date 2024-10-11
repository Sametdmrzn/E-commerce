<?php
// Veritabanı bağlantısını sağlayın
include 'db.php'; // Veritabanı bağlantı dosyanızı ekleyin

session_start(); // Session başlat

// Sepete ürün ekleme işlemi
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id']; // Ürün id'si
    $product_name = $_POST['product_name']; // Ürün adı
    $product_price = $_POST['product_price']; // Ürün fiyatı
    $product_quantity = $_POST['product_quantity']; // Ürün adedi

    // Ürün detaylarını bir dizi olarak kaydediyoruz
    $cart_item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $product_quantity
    );

    // Eğer sepet yoksa, yeni bir sepet oluştur
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Ürünü sepete ekle
    array_push($_SESSION['cart'], $cart_item);

    // Kullanıcıya bir başarı mesajı gösterin (isteğe bağlı)
    echo "<div class='alert alert-success'>Ürün sepete eklendi!</div>";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bozkurt Toptan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!-- Bootstrap Icons dahil edildi -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Üst Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Bozkurt Toptan</a>
            <div class="search-container">
                <form class="d-flex" style="width: 60%;">
                    <input class="form-control me-2" type="search" placeholder="Ne aramıştınız?" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Ara</button>
                </form>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" href="Sepet.php"><i class="bi bi-cart"></i> Sepet</a>
                <a class="nav-link" href="#"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a class="nav-link" href="hesap.php"><i class="bi bi-person"></i> Hesap</a>
            </div>
        </div>
    </nav>

    <!-- Alt Navbar -->
    <nav class="second-navbar navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto">
                <?php
                $category_sql = "SELECT * FROM categories"; 
                $category_result = $conn->query($category_sql);
                if ($category_result->num_rows > 0) {
                    // Kategorileri veritabanından çekip listeye ekleme
                    while ($row = $category_result->fetch_assoc()) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="Urunler.php?category=' . urlencode($row['name']) . '">' . htmlspecialchars($row['name']) . '</a>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="#">Kategori bulunamadı</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="row justify-content-center">
    <?php
    // Ürünleri veritabanından çekme işlemi
    $result = $conn->query("SELECT * FROM products"); // Örnek ürün sorgusu
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['image_url'])) {
            $imageData = base64_encode($row['image_url']);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
        } else {
            $imageSrc = $row['image_url']; 
        }

        echo '<div class="col-md-4">';
        echo '<div class="card text-center mb-4 shadow-sm">';
        echo '<img src="' . $imageSrc . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($row['desctription']) . '</p>';
        echo '<div class="price">₺' . htmlspecialchars($row['price']) . '</div>';
        
        // Sepete ekle formu
        echo '<form method="POST" action="">';
        echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
        echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($row['name']) . '">';
        echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($row['price']) . '">';
        echo '<input type="number" name="product_quantity" value="1" min="1" class="form-control mb-2">';
        echo '<button type="submit" name="add_to_cart" class="btn btn-success">Sepete Ekle</button>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h5>Hakkımızda</h5>
                    <p>Bozkurt için iç giyim kolaylığı.</p>
                </div>
                <div class="col-md-4">
                    <h5>İletişim</h5>
                    <p>Email: <a href="mailto:info@bozkurt.com">info@bozkurt.com</a></p>
                    <p>Telefon: <a href="tel:+905469467889">(+90) 546 946 78 89</a></p>
                </div>
                <div class="col-md-4">
                    <h5>Diğer</h5>
                    <p><a href="#">Hizmet Şartları</a></p>
                    <p><a href="#">Gizlilik Politikası</a></p>
                </div>
            </div>
            <hr class="my-4">
            <p class="text-center mb-0">© 2024 Tüm Hakları Saklıdır.</p>
        </div>
    </footer>

    <script src="assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
