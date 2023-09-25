<?php
$servername = "localhost"; // Veritabanı sunucusunun adı
$username = "root"; // MySQL kullanıcı adı
$password = ""; // MySQL şifresi
$dbname = "todolist"; // Veritabanı adı

// Veritabanına bağlanma
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = mysqli_real_escape_string($conn, $_POST["kullanici_adi"]);
    $sifre = mysqli_real_escape_string($conn, $_POST["sifre"]);
    
    // Kullanıcı adı mevcut mu kontrol et
    $check_sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$kullanici_adi'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Bu kullanıcı adı zaten kullanılıyor.";
    } else {
        // Yeni kullanıcıyı kaydet (güvenli bir şekilde hashlenmiş şifre kullanımı tavsiye edilir)
        $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO kullanicilar (kullanici_adi, sifre) VALUES ('$kullanici_adi', '$hashed_password')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo "Kayıt başarıyla oluşturuldu. Şimdi giriş yapabilirsiniz.";
        } else {
            echo "Kayıt oluşturulurken hata oluştu: " . $conn->error;
        }
    }
    
    $conn->close();
}
?>
