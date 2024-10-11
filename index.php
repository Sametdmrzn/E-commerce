<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

// Kategorileri veritabanından çekme
$category_sql = "SELECT name FROM categories";
$category_result = $conn->query($category_sql); 

$conn = new mysqli("localhost", "root", "", "bozkurt_toptan");

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
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

    <!-- Banner -->
    <div class="banner-container">
        <img src="assets/images/banner/banner.jpg" alt="banner" class="banner-image">
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
