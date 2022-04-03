<?php $title = "Giriş Yap" ?>
<?php require "config.php" ?>
<?php require "header.php" ?>


<div class="container mt-5" style="font-size: 20px;">
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h4>Giriş Yap</h4>
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
                        $gelenSifre = md5(guvenlikSagla($_POST['sifre']));

                        if ($gelenEmail != "" and $gelenSifre != "") {
                            $kullaniciKontrol = $db->prepare("SELECT * FROM users WHERE Email=? and Sifre=?");
                            $kullaniciKontrol->execute([$gelenEmail, $gelenSifre]);
                            $kullaniciKontrolSayisi = $kullaniciKontrol->rowCount();
                            if ($kullaniciKontrolSayisi > 0) {
                                $_SESSION['Kullanici'] = $gelenEmail;
                                echo '<div class="alert alert-success">Giriş İşlemi Başarılı.</div>';
                                header("refresh:2, url=index.php");
                            } else {
                                echo '<div class="alert alert-danger">Bu Bilgilere ait kullanıcı bulunamadı!</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Lütfen Email ve Şifrenizi giriniz!</div>';
                        }
                    }
                    ?>
                    <form method="post">
                        <div class="form-group mt-3">
                            <label for="Email">Email Adresiniz:</label>
                            <input type="email" class="form-control" name="email" value='<?php if (isset($_POST['email'])) echo guvenlikSagla($_POST['email']) ?>'>
                        </div>
                        <div class="form-group mt-3">
                            <label for="Sifre">Şifreniz:</label>
                            <input type="password" class="form-control" name="sifre">
                        </div>
                        <div class="form-group mt-3">
                            <a href="#" class="text-info">Şifremi Unuttum</a>
                            <a href="register.php" class="text-info m-2">Kayıt Ol</a>
                            <a href="index.php" class="text-info m-2">Vazgeç</a>
                        </div>
                        <button type="submit" class="btn btn-outline-info w-100 mt-3">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

    </html>

    <?php ob_end_flush(); ?>