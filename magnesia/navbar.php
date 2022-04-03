<div id="nav">
    <nav class="navbar navbar-expand-lg navbar-light mb-3">
        <div class="container-fluid">
            <a href="#" class="navbar-brand" style="font-size: 25px;">MAGNESIA</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link">Anasayfa</a>
                    <a href="urunler.php" class="nav-item nav-link">Ürünler</a>
                    <a href="about.php" class="nav-item nav-link">Hakkımızda</a>
                    <a href="contact.php" class="nav-item nav-link">İletişim</a>
                    <?php if (isset($_SESSION['Kullanici']) && $_SESSION['Kullanici'] == "admin@hazirodev.cf") { ?>
                        <a href="urun_ekle.php" class="nav-item nav-link">Ürün Ekle</a>
                    <?php } ?>
                </div>
                <div class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['Kullanici'])) { ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profil</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"><?php echo $_SESSION['Kullanici'] ?></a>
                                <a href="#" class="dropdown-item">Ayarlar</a>
                            </div>
                        </div>
                        <a href="logout.php" class="nav-item nav-link">Çıkış Yap</a>
                    <?php } else { ?>
                        <a href="login.php" class="nav-item nav-link">Giriş Yap</a>
                        <a href="register.php" class="nav-item nav-link">Kayıt Ol</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</div>