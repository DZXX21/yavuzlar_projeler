<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div class="container">
        <h2>Kayıt Formu</h2>
        <form action="kayit.php" method="POST" onsubmit="return validateForm();">
            <label for="isim">İsim:</label>
            <input type="text" name="isim" required><br>

            <label for="soyisim">Soyisim:</label>
            <input type="text" name="soyisim" required><br>

            <label for="tc">TC Kimlik:</label>
            <input type="text" id="tc" name="tc" required><br>

            <label for="eposta">E-Posta:</label>
            <input type="email" name="eposta" required><br>

            <label for="ogretmen">Öğretmen mi?</label>
            <input type="radio" name="ogretmen" value="Evet"> Evet
            <input type="radio" name="ogretmen" value="Hayir"> Hayır<br>

            <label for="sifre">Şifre:</label>
            <input type="password" name="sifre" required><br>

            <input type="submit" value="Kayıt Ol">
        </form>
    </div>
</body>
<script>
    function validateForm() {
        var tcKimlik = document.getElementById("tc").value;
        
        if (tcKimlik.length !== 11) {
            alert("TC Kimlik numarası 11 haneli olmalıdır. Lütfen 11 haneli giriniz.");
            return false;
        }
        
        if (!/^\d+$/.test(tcKimlik)) {
            alert("TC Kimlik numarası sadece rakamlardan oluşmalıdır. Lütfen sadece rakam giriniz.");
            return false;
        }
        
        // Formun post edilmesine izin ver
        return true;
    }
</script>
</html>
