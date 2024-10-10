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
    <!-- Header -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.html">
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
                        <a class="nav-link" href="index.html">Ana Sayfa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="Urunler.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ürünler
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="urunler.php?category=Bone">Bone</a></li>
                            <li><a class="dropdown-item" href="urunler.php?category=Eşarp">Eşarp</a></li>
                            <li><a class="dropdown-item" href="urunler.php?category=Tayt">Tayt</a></li>
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

        <!-- Banner -->
        <div class="banner" style="background-image: url('https://via.placeholder.com/1920x500'); height: 500px; background-size: cover; background-position: center;">
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Ürün 1">
                        <div class="card-body">
                            <h5 class="card-title">Ürün 1</h5>
                            <p class="card-text">Ürün açıklaması burada yer alacak.</p>
                            <div class="price">₺100</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Ürün 2">
                        <div class="card-body">
                            <h5 class="card-title">Ürün 2</h5>
                            <p class="card-text">Ürün açıklaması burada yer alacak.</p>
                            <div class="price">₺150</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Ürün 3">
                        <div class="card-body">
                            <h5 class="card-title">Ürün 3</h5>
                            <p class="card-text">Ürün açıklaması burada yer alacak.</p>
                            <div class="price">₺200</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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