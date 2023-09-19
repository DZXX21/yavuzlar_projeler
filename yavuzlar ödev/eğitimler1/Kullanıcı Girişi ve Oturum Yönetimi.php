<?php
session_start();


$dogru_kullanici_adi = "admin";
$dogru_sifre = "sifre123";

if (isset($_POST["giris"])) {
    $kullanici_adi = $_POST["kullanici_adi"];
    $sifre = $_POST["sifre"];

    if ($kullanici_adi == $dogru_kullanici_adi && $sifre == $dogru_sifre) {
        $_SESSION["kullanici_adi"] = $kullanici_adi;
        echo "Hoş geldiniz, $kullanici_adi!";
    } else {
        echo "Hatalı giriş!";
    }
}

if (isset($_SESSION["kullanici_adi"])) {
    echo "Oturum açık: " . $_SESSION["kullanici_adi"];
} else {

    ?>
    <form method="POST" action="">
        Kullanıcı Adı: <input type="text" name="kullanici_adi"><br>
        Şifre: <input type="password" name="sifre"><br>
        <input type="submit" name="giris" value="Giriş">
    </form>
    <?php
}
?>
