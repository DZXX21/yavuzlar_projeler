<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

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

// Öğrenci listesi
$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);

// Öğretmen kaydı yapma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_username = $_POST["teacher_username"];
    $teacher_password = $_POST["teacher_password"];
    $teacher_class = $_POST["teacher_class"];

    // Sadece admin öğretmen kaydı yapabilir
    if ($_SESSION["admin_role"] === "admin") {
        // Öğretmen verilerini veritabanına kaydet
        $sql_teacher = "INSERT INTO teachers (username, password, class) VALUES ('$teacher_username', '$teacher_password', '$teacher_class')";
        
        if ($conn->query($sql_teacher) === TRUE) {
            echo "Öğretmen kaydı başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql_teacher . "<br>" . $conn->error;
        }
    } else {
        echo "Sadece admin öğretmen kaydı yapabilir.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Listesi</h2>
        <!-- Öğrenci listesini görüntüle -->
        <table>
            <!-- Öğrenci tablosu burada listelensin -->
        </table>

        <!-- Öğretmen kaydı yapma formu -->
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
        
        <!-- Öğretmen eklemek için bir bağlantı -->
        <a href="teacher_registration.php">Öğretmen Ekle</a>

        <a href="admin_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>
