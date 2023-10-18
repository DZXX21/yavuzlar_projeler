<!DOCTYPE html>
<html>
<head>
    <title>Yönetici Kayıt</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Yönetici Kayıt Formu</h2>
        <form method="post" action="admin_register_process.php">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" name="username" required><br>
            <label for="password">Şifre:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Kaydet">
        </form>
    </div>
</body>
</html>
