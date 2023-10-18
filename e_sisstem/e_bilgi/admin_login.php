<?php
session_start();

if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
    // Admin girişi yapılmışsa, öğrenci listesini gösteren sayfaya yönlendir.
    header("Location: student_list.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "admin"; // Admin kullanıcı adı
    $admin_password = "admin_password"; // Admin şifresi

    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    if ($entered_username === $admin_username && $entered_password === $admin_password) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin.php");
        exit;
    } else {
        $login_error = "Yanlış kullanıcı adı veya şifre.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Girişi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<label for="teacher_class">Sınıf:</label>
<input type="text" name="teacher_class" required><br>
<body>
    <div class="container">
        <h2>Admin Girişi</h2>
        <form method="post" action="">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" name="username" required><br>
            <label for="password">Şifre:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Giriş">
        </form>
        <?php if (isset($login_error)): ?>
            <div class="error">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
