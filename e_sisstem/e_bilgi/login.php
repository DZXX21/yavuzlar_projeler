<?php
session_start();


if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "admin"; // Yönetici kullanıcı adı
    $admin_password = "password"; // Yönetici şifresi

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
    <title>Yönetici Girişi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Yönetici Girişi</h2>
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
