<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_sistem";

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $database);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $teacher_username = $_POST["teacher_username"];
    $teacher_password = $_POST["teacher_password"];
    $teacher_class = $_POST["teacher_class"];

    // Şifreyi hashleyerek sakla
    $hashed_password = password_hash($teacher_password, PASSWORD_DEFAULT);

    // Veritabanına öğretmen verilerini ekleyin
    $sql = "INSERT INTO teachers (username, teacher_username, teacher_password, teacher_class) VALUES ('$teacher_username', '$teacher_username', '$hashed_password', '$teacher_class')";

    if ($conn->query($sql) === TRUE) {
        echo "Öğretmen kaydı başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğretmen Kayıt</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğretmen Kayıt</h2>
        <form method="post" action="">
            <label for="teacher_username">Kullanıcı Adı:</label>
            <input type="text" name="teacher_username" required><br>
            <label for="teacher_password">Şifre:</label>
            <input type="password" name="teacher_password" required><br>
            <label for="teacher_class">Sınıf:</label>
            <input type="text" name="teacher_class" required><br>
            <input type="submit" value="Kaydet">
        </form>
        <a href="admin_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>
