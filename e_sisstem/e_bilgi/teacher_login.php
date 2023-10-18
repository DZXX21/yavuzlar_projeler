<?php
session_start();

if (isset($_SESSION["teacher_logged_in"]) && $_SESSION["teacher_logged_in"] === true) {
    header("Location: teacher.php");
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

    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    $sql = "SELECT * FROM teachers WHERE teacher_username = '$entered_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["teacher_password"];
        if (password_verify($entered_password, $hashed_password)) {
            $_SESSION["teacher_logged_in"] = true;
            $_SESSION["teacher_username"] = $entered_username;
            header("Location: teacher.php");
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
    <title>Öğretmen Girişi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğretmen Girişi</h2>
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
