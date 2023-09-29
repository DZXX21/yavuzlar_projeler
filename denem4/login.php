<?php

// HTML kodunu değişkenlere atayın.
$html = 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Sayfası</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Giriş Yap</h1>
                <form action="giris.php" method="POST">
                    <div class="mb-3">
                        <label for="kullanici_adi" class="form-label">Kullanıcı Adı:</label>
                        <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi">
                    </div>
                    <div class="mb-3">
                        <label for="sifre" class="form-label">Şifre:</label>
                        <input type="password" class="form-control" id="sifre" name="sifre">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


// HTML kodunu ekrana yazdırın.
echo $html;

?>