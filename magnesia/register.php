<?php $title = "Kayıt Ol" ?>
<?php require "config.php" ?>
<?php require "header.php" ?>


<!-- Register Sayfası -->
<div class="container mt-md-5" style="font-size: 20px;">
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h4>Kayıt Ol</h4>
                </div>
                <div class="card-body">
                    <?php
                    function guvenlikSagla($text)
                    {
                        $text = trim($text);
                        $text = htmlspecialchars($text);
                        return $text;
                    }
                    if ($_POST) {
                        $gelenEmail = guvenlikSagla($_POST['email']);
                        $gelenSifre = guvenlikSagla($_POST['sifre']);
                        $gelenSifre2 = guvenlikSagla($_POST['sifre2']);
                        if (isset($_POST['onay'])) {/* üyelik sozlesmesi */
                            $gelenOnay = $_POST['onay'];
                        } else {
                            $gelenOnay = "";
                        }
                        if ($gelenSifre != "" and $gelenSifre2 != "" and $gelenEmail != "") {
                            if ($gelenOnay != "") {
                                if ($gelenSifre == $gelenSifre2) {
                                    $emailKontrolSorgusu = $db->prepare("select * from users where email=? limit 1");  /* aynı hesaptan mevcut mu kontrolu */
                                    $emailKontrolSorgusu->execute([$gelenEmail]);
                                    $emailKontrolSorgusuSayisi = $emailKontrolSorgusu->rowCount();
                                    if ($emailKontrolSorgusuSayisi > 0) {
                                        echo '<div class="alert alert-danger">Email Adresi Mevcuttur!</div>';
                                    } else {     // sıkıntı yok kayıt yapılabilir
                                        $gelenSifre = md5($gelenSifre);
                                        $kayitSorgusu = $db->prepare("insert into users (Email,Sifre,UyelikSozlesmesi) values (?,?,?)");
                                        $kayitSorgusu->execute([$gelenEmail, $gelenSifre, $gelenOnay]);
                                        $kayitSorgusuSayisi = $kayitSorgusu->rowCount();
                                        if ($kayitSorgusuSayisi > 0) {
                                            echo '<div class="alert alert-success">Kayıt Başarılı!</div>';
                                            header("refresh:2, url=index.php");
                                        } else {
                                            echo '<div class="alert alert-danger">Kayıt işlemi sırasında hata! Tekrar deneyiniz.</div>';
                                        }
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Şifreler Uyuşmuyor!</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">Üyelik Sözleşmesini Onaylamadınız!</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Lütfen Bütün Boşlukları doldurun !</div>';
                        }
                    }
                    ?>
                    <form method="post">
                        <div class="form-group mt-3">
                            <label for="Email">Email Adresi: </label> <?php  /*submite basıldıktan sonra yazının sabit kalması*/ ?>
                            <input type="email" name="email" value='<?php if (isset($_POST['email'])) echo guvenlikSagla($_POST['email']) ?>' class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="Sifre">Şifre: </label>
                            <input type="password" name="sifre" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="Sifre2">Şifre Tekrar: </label>
                            <input type="password" name="sifre2" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <input type="checkbox" name="onay" value="1" <?php if (isset($_POST['onay']) == 1) echo "checked";
                                                                            else echo "" ?>> <a href="#" class="text-warning"> Üyelik Sözleşmesini</a> Okudum Kabul Ediyorum.
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-outline-primary w-100" type="submit">Kayıt Ol</button>
                        </div>
                        <div class="form-group mt-3">
                            <a href="login.php" class="text-info float-right">Giriş Yap</a>
                            <a href="index.php" class="text-info m-2">Vazgeç</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

    </html>

    <?php ob_end_flush(); ?>