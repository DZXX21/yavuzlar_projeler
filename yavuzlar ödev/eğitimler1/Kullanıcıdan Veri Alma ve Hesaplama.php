<!DOCTYPE html>
<html>
<head>
    <title>Hesap Makinesi</title>
</head>
<body>
    <form method="POST" action="">
        Sayı 1: <input type="text" name="sayi1">
        Sayı 2: <input type="text" name="sayi2">
        <input type="submit" value="Topla">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sayi1 = $_POST["sayi1"];
        $sayi2 = $_POST["sayi2"];
        $toplam = $sayi1 + $sayi2;
        echo "Toplam: " . $toplam;
    }
    ?>
</body>
</html>
