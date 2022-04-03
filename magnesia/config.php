<?php
session_start();
ob_start();
try {
    $dsn = "mysql:hostname=localhost;dbname=urundb;charset=utf8";
    $username = "root";
    $password = "";
    $db = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    die($e->getMessage());
}

//kulannıcının diğer bilgilerini veritabanından cekme
if (isset($_SESSION['Kullanici'])) {
    $kullaniciBilgileri = $db->prepare("SELECT * FROM users WHERE Email=? limit 1");
    $kullaniciBilgileriSayisi = $kullaniciBilgileri->rowCount();
    $kullaniciBilgi = $kullaniciBilgileri->fetch(PDO::FETCH_ASSOC);
    if ($kullaniciBilgileri > 0) {
        $kullaniciAdi = $kullaniciBilgi['AdiSoyadi'];
        $kullaniciEmail = $kullaniciBilgi['Email'];
    }
}
