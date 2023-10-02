<!DOCTYPE html>
<html>
<head>
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Giriş Formu</h2>
        <form action="giris.php" method="POST">
            <label for="eposta">E-Posta:</label>
            <input type="email" name="eposta" required><br>

            <label for="sifre">Şifre:</label>
            <input type="password" name="sifre" required><br>

            <input type="submit" value="Giriş Yap">
        </form>
    </div>
</body>
</html>
