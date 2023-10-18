<!-- admin_login_process.php -->
<?php
session_start();

$admin_username = "admin";
$admin_password = "admin_password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
