<?php
session_start();

if (isset($_SESSION["student_logged_in"]) && $_SESSION["student_logged_in"] === true) {
    header("Location: student_dashboard.php");
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

    $entered_username = $_POST["student_username"];
    $entered_password = $_POST["student_password"];

    $sql = "SELECT * FROM students WHERE student_username = '$entered_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["student_password"];
        if (password_verify($entered_password, $hashed_password)) {
            $_SESSION["student_logged_in"] = true;
            $_SESSION["student_username"] = $entered_username;
            header("Location: student_dashboard.php");
            exit;
        } else {
            $login_error = "Yanlış kullanıcı adı veya şifre.";
        }
    } else {
        $login_error = "Yanlış kullanıcı adı veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Girişi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Girişi</h2>
        <form method="post" action="">
            <label for="student_username">Kullanıcı Adı:</label>
            <input type="text" name="student_username" required><br>
            <label for="student_password">Şifre:</label>
            <input type="password" name="student_password" required><br>
            <input type="submit" value="Giriş">
        </form>
        <?php if (isset($login_error)): ?>
            <div class="error">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?>
        
        <!-- Kayıt olma butonu -->
        <p>Hesabınız yoksa <a href="kayıt.php">kayıt olun</a>.</p>
    </div>
</body>
</html>
