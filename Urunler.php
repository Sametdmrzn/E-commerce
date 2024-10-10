<?php
// Veritabanı bağlantısını sağlayın
include 'db.php'; // Veritabanı bağlantı dosyanızı ekleyin

// Kategori sorgusunu yapın
$category_sql = "SELECT * FROM categories"; // Kategori tablonuzun adı "categories" olduğunu varsayıyorum
$category_result = $conn->query($category_sql);

// HTML kısmı
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
    <link rel="stylesheet" href="style.css">

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
                                    echo '<li><a class="dropdown-item" href="Urunler.php?category=' . urlencode($row['name']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">Kategori Bulunamadı</a></li>'; // Kategori yoksa mesaj
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim.html">İletişim</a>
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

    <div class="container mt-5">
        <?php
        // Veritabanı bağlantısı
        include 'db.php'; // Veritabanı bağlantı dosyanı ekle

        // URL'den kategori bilgisini al
        if (isset($_GET['category'])) {
            $category = $_GET['category'];

            // Veritabanından bu kategoriye ait ürünleri getir
            $sql = "SELECT * FROM products WHERE category = '$category'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="row justify-content-center">';
                while ($row = $result->fetch_assoc()) {
                    // Resim verisi BLOB olarak geliyorsa, base64 formatına çeviriyoruz
                    if (!empty($row['image_url'])) {
                        $imageData = base64_encode($row['image_url']);
                        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                    } else {
                        $imageSrc = $row['image_url']; // Eğer resim BLOB değilse, image_url kullanılıyor
                    }

                    // Ürün kartını burada oluştur
                    echo '<div class="col-md-4">';
                    echo '<div class="card text-center mb-4 shadow-sm">';
                    echo '<img src="' . $imageSrc . '" class="card-img-top" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['desctription'] . '</p>'; // 'desctription' yerine 'description' olabilir, bunu kontrol edin.
                    echo '<div class="price">₺' . $row['price'] . '</div>';
                    echo '<a href="urun_detay.php?id=' . $row['id'] . '" class="btn btn-primary">Detay</a>'; // Detay linki
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo "<p>Bu kategoride ürün bulunamadı.</p>";
            }
        } else {
            echo "<p>Kategori seçilmedi.</p>";
        }
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
