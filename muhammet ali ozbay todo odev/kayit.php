<?php
include("baglanti.php");

$kullaniciadiHata = $parolaHata = "";

if (isset($_POST["kaydet"])) {
    $name = $_POST["kullaniciadi"];
    $parola = password_hash($_POST["parola"], PASSWORD_DEFAULT);


    if (empty($name)) {
        $kullaniciadiHata = "Kullanıcı adını doldurunuz";
    }
    if (empty($_POST["parola"])) {
        $parolaHata = "Şifre'yi doldurunuz";
    }


    if (!empty($name) && !empty($_POST["parola"])) {
       
        $kontrolSorgusu = "SELECT kullanici_adi FROM kullanicilar WHERE kullanici_adi = '$name'";
        $sonuc = mysqli_query($baglanti, $kontrolSorgusu);


        if (mysqli_num_rows($sonuc) > 0) {
            echo '<div class="alert alert-danger" role="alert">
                Bu kullanıcı adı zaten kayıtlı.
            </div>';
        } else {
           

            $ekle = "INSERT INTO kullanicilar (kullanici_adi, parola) VALUES ('$name', '$parola')";
            $calistirekle = mysqli_query($baglanti, $ekle);


            if ($calistirekle) {
                echo '<div class="alert alert-success" role="alert">
                    Tebrikler Kayıt Oldun Giriş Yapabilirsin
                </div>';

              /*  session_start();
                $_SESSION['kullanici_adi'] = $name; */

            } else {
                echo '<div class="alert alert-danger" role="alert">
                    Kayıt Başarısız
                </div>';
            }
            mysqli_close($baglanti);
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Kayıt Ol</title>
</head>
<div class="container">
    <div class="row">

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--CSS-->
            <link rel="stylesheet" href="css\style.css">
            <!--Bootstrap-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <!--Fontawesome-->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                crossorigin="anonymous" />

            <title>Kayıt Ol</title>
        </head>

        <body>
    <div class="container-fluid d-flex justify-content-center align-content-center align-items-center">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 col-sm-12 col p-4">
            <div class="text-center userImg">
                <img src="bg.jpg" alt="" srcset="" class="rounded" width="300" height="150">
                <h4 class="pt-2">Kayıt Ol</h4>
            </div> 
            <form action="kayit.php" method="POST">
                <div class="form-group">
                    <input type="text" id="exampleInputEmail1" class="form-control;" placeholder="Kullanıcı adı" name="kullaniciadi" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php echo $kullaniciadiHata; ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" id="exampleInputPassword1" class="form-control" placeholder="Şifre" name="parola" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php echo $parolaHata; ?>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                </div>
                <div class="form-group text-center">
    <!--<a href="#" class="text-muted">Forget password?</a> or -->
    <a href="login.php" class="text-muted">Giriş Yap</a>
 </div>
         </form>
             </div>
             </div>
             </div>
            </div>
        </body>

        </html>

        <style>
            body {
                background-color: #ecf0f3 !important;
                padding: 0;
                margin: 0;
            }

            .container-fluid {

                width: 100%;
                height: 100vh;
            }

            .col {
                box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff !important;
                border-radius: 15px;
            }

            .form-group {
                margin: 30px 0px;
            }

            .form-group input {
                outline: none;
                background: #ecf0f3 !important;
                padding: 20px 10px 20px 5px;
                border: none;
                border-bottom: 2px solid white !important;
                border-radius: 5px;
            }

            .form-group .btn {
                width: 100%;
                background: #44A7BA !important;
                border-radius: 15px;
                color: #fff !important;
            }
        </style>


    </div>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

</body>

</html>