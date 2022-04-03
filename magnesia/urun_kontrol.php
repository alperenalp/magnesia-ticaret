<?php
require "config.php";

function guvenlikSagla($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}
$durum = "false";
$durum2 = "false";
$son_eleman = "Bilinmeyen";
$uisim_err = $uaciklama_err = $ufiyat_err = $ukategori_err = $urenk_err = $ureklam_err = $ufoto_err = $ureklam_str = "";
if (isset($_POST["submit"])) {
    if (empty($_POST["uisim"])) {
        $uisim_err = "Ürün isim alanı boş olamaz. <br>";
    } else if ($_POST["uisim"] != guvenlikSagla($_POST["uisim"])) {
        $uisim_err = "Lütfen yasaklı kelimeleri kullanmayınız. <br>";
    }
    if (empty($_POST["uaciklama"])) {
        $uaciklama_err = "Ürün açıklama alanı boş olamaz. <br>";
    } else if ($_POST["uaciklama"] != guvenlikSagla($_POST["uaciklama"])) {
        $uaciklama_err = "Lütfen yasaklı kelimeleri kullanmayınız. <br>";
    }
    if (empty($_POST["ufiyat"])) {
        $ufiyat_err = "Ürün fiyat alanı boş olamaz. <br>";
    }
    if (empty($_POST["ukategori"])) {
        $ukategori_err = "Ürün kategori alanı boş olamaz. <br>";
    }
    if (empty($_POST["urenk"])) {
        $urenk_err = "Ürün renk alanı boş olamaz. <br>";
    }
    if (!isset($_POST["ureklam"]) || empty($_POST["ureklam"])) {
        $ureklam_err = "Ürün reklam alanı boş olamaz. <br>";
    } else {
        $ureklam_str = implode(" ", $_POST["ureklam"]); //diziyi stringe çevirme
    }


    $uploadOK = 1;
    if (isset($_FILES["ufoto"]) && empty($_FILES["ufoto"])) {
        $check = getimagesize($_FILES["ufoto"]["tmp_name"]);
        if ($check !== false) {
            $ufoto = " Foto türü " . $check["mime"] . ".";
            $uploadOK = 1;
        } else {
            $ufoto_err = "Lütfen Bir fotoğraf seçiniz";
            $uploadOK = 0;
        }
    } else {
        $ufoto_err = "Lütfen Bir fotoğraf seçiniz";
        $uploadOK = 0;
    }

    $foto_name = "";
    if ($uploadOK == 1 || file_exists($_FILES["ufoto"]["tmp_name"]) || is_uploaded_file($_FILES["ufoto"]["tmp_name"])) {
        $fname = $_FILES["ufoto"]["name"];
        $tmpName = $_FILES["ufoto"]["tmp_name"];
        $ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));  //dosya uzantısı
        $yeni_isim = $fname . "_" . uniqid(rand(), true) . "." . $ext;
        $path = "img/" . $yeni_isim;
        if (move_uploaded_file($tmpName, $path)) {
            $foto_name = $yeni_isim;
        } else {
            $ufoto_err = "Dosya Yüklenirken bir hata oluştu.";
        }
    }

    $insert = "";
    //veritabanına kaydetme
    if (
        !empty($_POST["uisim"]) &&
        !empty($_POST["uaciklama"]) &&
        !empty($_POST["ufiyat"]) &&
        !empty($_POST["ukategori"]) &&
        !empty($_POST["urenk"]) &&
        !empty($_POST["ureklam"])
    ) {
        if (
            guvenlikSagla($_POST["uisim"]) == $_POST["uisim"] &&
            guvenlikSagla($_POST["uaciklama"]) == $_POST["uaciklama"] &&
            guvenlikSagla($_POST["ufiyat"]) == $_POST["ufiyat"]
        ) {
            //foto yoksa bisey gonderme veritabanı default sececek
            if (empty($foto_name)) {
                $sorgu = $db->prepare("insert into urunler(uisim,uaciklama,ufiyat,ukategori,urenk,ureklam) values(?,?,?,?,?,?)");
                $insert = $sorgu->execute(
                    [
                        $_POST["uisim"],
                        $_POST["uaciklama"],
                        $_POST["ufiyat"],
                        $_POST["ukategori"],
                        $_POST["urenk"],
                        $ureklam_str
                    ]
                );
            } else {
                $sorgu = $db->prepare("insert into urunler(uisim,uaciklama,ufiyat,ukategori,ufoto,urenk,ureklam) values(?,?,?,?,?,?,?)");
                $insert = $sorgu->execute(
                    [
                        $_POST["uisim"],
                        $_POST["uaciklama"],
                        $_POST["ufiyat"],
                        $_POST["ukategori"],
                        $foto_name,
                        $_POST["urenk"],
                        $ureklam_str
                    ]
                );
            }
        }


        if ($insert) {/*Kayıt Başarılı mı */
            $son_eleman = $db->lastInsertId();
            $durum = "true";
            $uisim_err = $uaciklama_err = $ufiyat_err = $ukategori_err = $urenk_err = $ureklam_err = $ufoto_err = $ureklam_str = "";
        } else {
            $durum2 = "true";
            //echo "Kayıtta bir sorun oluştu..!";
        }
    }
}
