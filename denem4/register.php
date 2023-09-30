<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Sayfası</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Kayıt Ol</h1>
                <form action="kayit.php" method="POST">
                    <div class="form-group">
                        <label for="kullanici_adi">Kullanıcı Adı:</label>
                        <input type="text" class="form-control" name="kullanici_adi" required>
                    </div>
                    <div class="form-group">
                        <label for="sifre">Şifre:</label>
                        <input type="password" class="form-control" name="sifre" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kayıt Ol</button>
                </form>
            </div>
            <div class="mt-3 text-center">
                    <p>Hesabınız varmı Giris Yapın !</p> 
                    <a href="login.php" class="btn btn-success">Kayıt Ol</a>
                </div>
        </div>
    </div>

    <script>
        // Kayıt işlemi başarıyla tamamlandığında kullanıcıyı yönlendirme
        function redirectToIndex() {
            window.location.href = "index.html";
        }
    </script>
</body>
</html>
