<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcıdan gelen kullanıcı adı ve şifre
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Veritabanı bağlantısı
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "ecrt";

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Kullanıcı adı ile veritabanında kayıt arama
    $stmt = $conn->prepare("SELECT username, password FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        // Kullanıcıdan gelen şifreyi doğrula
        if (password_verify($password, $stored_password)) {
            // Giriş başarılı, oturumu başlat
            $_SESSION['user'] = $username;
            header('Location: adm2in_paneli.php'); // Kullanıcıyı "denem21.html" sayfasına yönlendir
            exit;
        } else {
            // Şifre yanlış
            echo "Kullanıcı adı veya şifre yanlış!";
        }
    } else {
        // Kullanıcı adı bulunamadı
        echo "Kullanıcı adı veya şifre yanlış!";
    }

    // Veritabanı bağlantısını kapat
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giriş Sayfası</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Giriş Yap">
    </form>
</body>
</html>
