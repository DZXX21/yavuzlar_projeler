<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "todolist"; 

// Veritabanına bağlanma
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = mysqli_real_escape_string($conn, $_POST["kullanici_adi"]);
    $sifre = mysqli_real_escape_string($conn, $_POST["sifre"]);
    
    // Kullanıcı adının veritabanında varlığını kontrol et
    $check_sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$kullanici_adi'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Bu kullanıcı adı zaten kullanılıyor.";
    } else {
        // Şifreyi hashle
        $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);
        
        // Kullanıcıyı veritabanına ekle
        $insert_sql = "INSERT INTO kullanicilar (kullanici_adi, sifre) VALUES ('$kullanici_adi', '$hashed_password')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo "Kayıt başarıyla oluşturuldu. Şimdi giriş yapabilirsiniz.";
            // Burada JavaScript kullanarak bir yönlendirme yapabilirsiniz.
            echo '<script>window.location.href = "login.php";</script>';
        } else {
            echo "Kayıt oluşturulurken hata oluştu: " . $conn->error;
        }
    }
    
    // Veritabanı bağlantısını kapat
    $conn->close();
}
?>
