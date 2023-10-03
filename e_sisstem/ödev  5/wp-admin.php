<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form action="admin.php" method="POST">
        <label for="kullaniciAdi">Kullanıcı Adı:</label>
        <input type="text" name="kullaniciAdi" required><br>

        <label for="sifre">Şifre:</label>
        <input type="password" name="sifre" required><br>

        <input type="submit" value="Giriş Yap">
    </form>
</body>
</html>
