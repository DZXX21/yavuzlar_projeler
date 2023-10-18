<?php
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

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $isim = $_POST["isim"];
    $soyisim = $_POST["soyisim"];
    $numara = $_POST["numara"];
    $sinif = $_POST["sinif"];
    $tc_kimlik = $_POST["tc_kimlik"];
    $student_username = $_POST["student_username"];
    $student_password = $_POST["student_password"];

    // Öğrenci şifresini hashle
    $hashed_password = password_hash($student_password, PASSWORD_DEFAULT);

    // Veritabanına verileri ekle
    $sql = "INSERT INTO students (isim, soyisim, numara, sinif, tc_kimlik, student_username, student_password) 
            VALUES ('$isim', '$soyisim', '$numara', '$sinif', '$tc_kimlik', '$student_username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Kayıt başarıyla eklendi.";
        $messageClass = "success";
    } else {
        $message = "Hata: " . $sql . "<br>" . $conn->error;
        $messageClass = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Kayıt Formu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Kayıt Formu</h2>
        <?php if (!empty($message)): ?>
        <div class="message <?php echo $messageClass; ?>">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
        <form method="post" action="">
            <label for="isim">İsim:</label>
            <input type="text" name="isim" required><br>
            <label for="soyisim">Soyisim:</label>
            <input type="text" name="soyisim" required><br>
            <label for="numara">Öğrenci Numarası:</label>
            <input type="text" name="numara" required><br>
            <label for="sinif">Sınıf:</label>
            <input type="text" name="sinif" required><br>
            <label for="tc_kimlik">TC Kimlik:</label>
            <input type="text" name="tc_kimlik" required><br>
            <label for="student_username">Kullanıcı Adı:</label>
            <input type="text" name="student_username" required><br>
            <label for="student_password">Şifre:</label>
            <input type="password" name="student_password" required><br>
            <input type="submit" value="Kaydet">
        </form>
    </div>
</body>
</html>
