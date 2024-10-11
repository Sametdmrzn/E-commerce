<?php
session_start(); // Oturumu başlat
include 'db.php'; // Veritabanı bağlantısını ekledik

// Kategorileri veritabanından çekme
$category_sql = "SELECT name FROM categories";
$category_result = $conn->query($category_sql);
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

    <div class="container mt-5">
        <h1 class="mb-4">Sepetim</h1>
        <div class="row">
            <?php
            // Eğer sepet doluysa ürünleri göster
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    $total_item_price = $item['price'] * $item['quantity'];
                    echo '<div class="col-md-4 mb-3">'; // Her ürünü 4 kolonlu yap
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($item['name']) . '</h5>';
                    echo '<p class="card-text">Fiyat: ' . number_format($item['price'], 2) . ' TL</p>';
                    echo '<p class="card-text">Adet: ' . htmlspecialchars($item['quantity']) . '</p>';
                    echo '<p class="card-text">Toplam: ' . number_format($total_item_price, 2) . ' TL</p>';
                    echo '<form method="POST" action="sepet.php">';
                    echo '<input type="hidden" name="remove_key" value="' . $key . '">';
                    echo '<button type="submit" name="remove_item" class="btn btn-danger">Sil</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Sepetiniz boş.</p>';
            }
            ?>
        </div>

        <?php
        // Sepetten ürün silme işlemi
        if (isset($_POST['remove_item'])) {
            $remove_key = $_POST['remove_key'];
            unset($_SESSION['cart'][$remove_key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Diziyi yeniden düzenle
            header('Location: sepet.php'); // Sayfayı yenile
            exit;
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
