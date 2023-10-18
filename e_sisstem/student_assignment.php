<?php
session_start();

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

if (!isset($_SESSION["teacher_logged_in"]) || $_SESSION["teacher_logged_in"] !== true) {
    header("Location: teacher_login.php");
    exit;
}

$student_id = $_POST["student_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_assignment"])) {
    // Ödev gönderme formu gönderilmiş, bu formdan alınan bilgileri veritabanına ekleyebilirsiniz.
    $student_id = $_POST["student_id"];
    // Diğer ödev bilgilerini de almanız gerekecek, örneğin title, description, deadline.
    // Veritabanına ekleme işlemi burada yapılacak.
}

// Öğrenci bilgilerini sorgula
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

$student_name = "";  // Öğrenci adı için varsayılan değer
$student_surname = "";  // Öğrenci soyadı için varsayılan değer

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Öğrenci bilgilerini kullanabilirsiniz.
    $student_name = $row["isim"];
    $student_surname = $row["soyisim"];
    // ...
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenciye Ödev Gönder</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenciye Ödev Gönder</h2>

        <p>Öğrenci: <?php echo $student_name . " " . $student_surname; ?></p>

        <form method="post" action="">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <label for="title">Ödev Başlığı:</label>
            <input type="text" name="title" required>
            <label for="description">Ödev Açıklaması:</label>
            <textarea name="description" required></textarea>
            <label for="deadline">Teslim Tarihi:</label>
            <input type="date" name="deadline" required>
            <input type="submit" name="submit_assignment" value="Gönder">
        </form>

        <a href="teacher.php">Geri Dön</a>
    </div>
</body>
</html>
