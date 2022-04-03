<?php $title = "Ürün Ekle" ?>
<?php require "header.php" ?>
<?php require "urun_kontrol.php" ?>
<?php require "navbar.php" ?>


<div id="container">
    <div id="content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h2>Ürün Ekle</h2>
                        </div>
                        <div class="card-body">
                            <form action="urun_ekle.php" method="POST" enctype="multipart/form-data">
                                <?php if ($durum == "true") echo '<div class="alert alert-success">' . $son_eleman . ' Nolu Ürünü Ekleme Başarılı!</div>'; ?>
                                <?php if ($durum2 == "true") echo '<div class="alert alert-danger">' . $son_eleman . ' Nolu Ürünü Ekleme Başarısız!</div>'; ?>
                                <div class="form-group mt-3">
                                    <div><label for="uisim">Ürün ismi: </label></div>
                                    <input type="text" name="uisim" id="uisim" value='<?php if (isset($_POST["uisim"])) echo $_POST["uisim"] ?>'>
                                    <span class="text-danger m-5"> <?php echo $uisim_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="uaciklama">Ürün Açıklama: </label></div>
                                    <textarea name="uaciklama" id="uaciklama"><?php if (isset($_POST["uaciklama"])) echo $_POST["uaciklama"] ?></textarea>
                                    <span class="text-danger m-5"> <?php echo $uaciklama_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="ufiyat">Ürün Fiyat: </label></div>
                                    <input type="number" name="ufiyat" id="ufiyat" min="0" value='<?php if (isset($_POST["ufiyat"])) echo $_POST["ufiyat"] ?>'>
                                    <span class="text-danger m-5"> <?php echo $ufiyat_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="ukategori">Ürün Kategori: </label></div>
                                    <select name="ukategori" id="ukategori">
                                        <option value="0" disabled selected>Kategori Seçin</option>
                                        <option value="1" <?php if (isset($_POST["ukategori"]) && $_POST["ukategori"] == 1) echo "selected" ?>>Ana Yemek</option>
                                        <option value="2" <?php if (isset($_POST["ukategori"]) && $_POST["ukategori"] == 2) echo "selected" ?>>Çorba</option>
                                        <option value="3" <?php if (isset($_POST["ukategori"]) && $_POST["ukategori"] == 3) echo "selected" ?>>İçecek</option>
                                        <option value="4" <?php if (isset($_POST["ukategori"]) && $_POST["ukategori"] == 4) echo "selected" ?>>Tatlı</option>
                                    </select>
                                    <span class="text-danger m-5"> <?php echo $ukategori_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="ufoto">Ürün foto: </label></div>
                                    <input type="file" name="ufoto" id="ufoto">
                                    <span class="text-danger"> <?php echo $ufoto_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="urenk">Ödeme Yöntemi: </label></div>
                                    <input type="radio" name="urenk" id="urenk" value="pesin"> Peşin
                                    <input type="radio" name="urenk" id="urenk" value="taksit"> Taksit
                                    <span class="text-danger m-5"> <?php echo $urenk_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <div><label for="urenk">Promosyon: </label></div>
                                    <input type="checkbox" name="ureklam[]" id="ureklam" value="Sos"> Sos
                                    <input type="checkbox" name="ureklam[]" id="ureklam" value="Tatlı"> Tatlı
                                    <input type="checkbox" name="ureklam[]" id="ureklam" value="Tursu"> Turşu
                                    <span class="text-danger m-5"> <?php echo $ureklam_err ?> </span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="submit" name="submit" value="Ürün Kaydet" class="btn btn-outline-info w-100 mt-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php" ?>