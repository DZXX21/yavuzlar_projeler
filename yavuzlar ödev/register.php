<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Sayfası</title>
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST" action="register_process.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Kayıt Ol">
    </form>
</body>
</html>
