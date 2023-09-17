<?php
$servername = "localhost"; // MySQL sunucusunun adresi
$username = "kullanici_adi"; // MySQL kullanıcı adı
$password = "parola"; // MySQL kullanıcı parolası
$database = "veritabani_adi"; // Kullanılacak veritabanının adı

// MySQL veritabanına bağlanma işlemi
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Üye eklemek için POST verilerini al
if (isset($_POST['ekle'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    // Veritabanına yeni üye ekleme
    $sql = "INSERT INTO uyeler (ad, soyad, email, sifre) VALUES ('$ad', '$soyad', '$email', '$sifre')";

    if ($conn->query($sql) === TRUE) {
        echo "Yeni üye başarıyla eklendi.";
    } else {
        echo "Üye eklenirken hata oluştu: " . $conn->error;
    }
}

// Diğer işlemler için gerekli kodları buraya ekleyebilirsiniz.

// Bağlantıyı kapat
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Üye Yönetimi</title>
    <!-- CSS ve diğer HTML kodları buraya gelebilir -->
</head>
<body>
    <form method="POST" action="">
        <h2>Üye Ekle</h2>
        <input type="text" name="ad" placeholder="Adınız" required>
        <input type="text" name="soyad" placeholder="Soyadınız" required>
        <input type="email" name="email" placeholder="E-posta Adresiniz" required>
        <input type="password" name="sifre" placeholder="Şifreniz" required>
        <input type="submit" name="ekle" value="Üye Ekle">
    </form>
    
    <h2>Üyeler</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Soyad</th>
            <th>E-posta</th>
            <th>İşlemler</th>
        </tr>
        <!-- Üyeleri listelemek için gerekli PHP kodunu buraya ekleyebilirsiniz -->
    </table>
</body>
</html>
