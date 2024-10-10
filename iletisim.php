<?php
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!-- Bootstrap Icons dahil edildi -->
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="https://via.placeholder.com/150x50" alt="Logo">
            </a>

            <!-- Toggler button (mobile view) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links & Arama -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ürünler
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if ($category_result->num_rows > 0) {
                                while ($row = $category_result->fetch_assoc()) {
                                    echo '<li><a class="dropdown-item" href="urunler.php?category=' . urlencode($row['name']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">Kategori Bulunamadı</a></li>'; // Kategori yoksa mesaj
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim.php">İletişim</a>
                    </li>
                </ul>

                <!-- Arama Çubuğu -->
                <form class="d-flex me-3">
                    <input class="form-control" type="search" placeholder="Ürün Ara" aria-label="Search">
                </form>

                <!-- WhatsApp, Instagram, Kullanıcı ve Sepet Simgeleri -->
                <div class="icons d-flex align-items-center">
                    <!-- WhatsApp -->
                    <a class="nav-link" href="https://wa.me/905469467889?text=Merhaba,%20Bozkurt%20Toptan%20ile%20ilgili%20bilgi%20almak%20istiyorum." target="_blank" aria-label="WhatsApp">
                        <i class="bi bi-whatsapp fs-3"></i> <!-- WhatsApp simgesi -->
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/zerrindemirezen/" target="_blank" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <!-- Hesabım -->
                    <a href="#" aria-label="Hesabım">
                        <i class="bi bi-person"></i>
                    </a>

                    <!-- Sepet -->
                    <a href="Sepet.html" aria-label="Sepet">
                        <i class="bi bi-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

   
    <script src="assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h5>Hakkımızda</h5>
                    <p>Bozkurt için iç giyim kolaylığı.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>İletişim</h5>
                    <p>info@bozkurt.com</p>
                    <p>(+90) 546 946 78 89</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Diğer</h5>
                    <p><a href="#">Hizmet Şartları</a></p>
                    <p><a href="#">Gizlilik Politikası</a></p>
                </div>
            </div>
            <p class="text-center mt-3">© 2024 Tüm Hakları Saklıdır.</p>
        </div>
    </footer>
</body>
</html>
