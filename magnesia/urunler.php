<?php $title = "Urunler" ?>
<?php require "config.php" ?>
<?php require "header.php" ?>
<?php require "navbar.php" ?>


<?php
/*Kategoriye göre listeleme*/
$uyari = "";
if (isset($_GET["clicked"])) {
    $gelenKategori = $_GET["clicked"];
    $sorgu = $db->prepare("select*from urunler where ukategori=? order by id desc");
    $sorgu->execute([$gelenKategori]);
    $sorguSayisi = $sorgu->rowCount();
    if ($sorguSayisi == 0) {
        $uyari = '<div class="alert alert-danger">Kategoriye Ait Kayıt Bulunamadı!</div>';
    }
} else {
    $sorgu = $db->query("select*from urunler order by id desc");
}
$data_tablosu = $sorgu->fetchAll();

?>

<div id="container">
    <div id="content">
        <div class="content-ayir">
            <div class="left-part">
                <div class="menu">
                    <ul>
                        <li onclick="window.location.href='urunler.php?clicked=1'">Ana Yemekler</li>
                        <li onclick="window.location.href='urunler.php?clicked=2'">Çorbalar</li>
                        <li onclick="window.location.href='urunler.php?clicked=3'">İçecekler</li>
                        <li onclick="window.location.href='urunler.php?clicked=4'">Tatlılar</li>
                    </ul>
                </div>
            </div>
            <div class="main-part">
                <div class="container">
                    <div class="row">
                        <div class="card-header bg-info text-center">
                            <h1>ÜRÜNLERİMİZ</h1>
                        </div>
                        <?php echo $uyari; ?>
                        <?php foreach ($data_tablosu as $satir) : ?>
                            <?php
                            if ($satir["ukategori"] == 1) {
                                $kategori = "Ana Yemek";
                            } else if ($satir["ukategori"] == 2) {
                                $kategori = "Çorba";
                            } else if ($satir["ukategori"] == 3) {
                                $kategori = "İçecek";
                            } else if ($satir["ukategori"] == 4) {
                                $kategori = "Tatlı";
                            } else {
                                $kategori = "";
                            }
                            ?>
                            <div class="card border-info mb-5 p-3" style="width: 30rem;">
                                <div class="img-body">
                                    <img class="card-img" width="300" height="300" src="img/<?php echo $satir["ufoto"] ?>" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $satir["uisim"] ?></h3>
                                    <p class="card-text"><?php echo $satir["uaciklama"] ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Fiyat: <?php echo "  " . $satir["ufiyat"] . " " ?>TL</li>
                                    <li class="list-group-item">Kategori: <?php echo $kategori ?></li>
                                    <li class="list-group-item">Ödeme: <?php echo $satir["urenk"] ?></li>
                                    <li class="list-group-item">Promosyon: <?php echo $satir["ureklam"] ?></li>
                                </ul>
                                <div class="card-body">
                                    <a href="detay.php?id=<?php echo $satir["id"] ?>" class="card-link">Ürün Sayfası</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php" ?>