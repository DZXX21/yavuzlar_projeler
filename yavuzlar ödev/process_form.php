<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your variables based on form submission
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $ogrenci_no = $_POST["ogrenci_no"];
    $telefon = $_POST["telefon"];
    $bolum = $_POST["bolum"];
    $email = $_POST["email"];
    $deneyim = $_POST["deneyim"];
    $ilgi = $_POST["ilgi"];
    $ilgi_alanlari = $_POST["ilgi_alanlari"];
    $kulup_deneyim = $_POST["kulup_deneyim"];
    $haftalik_calisma_saatleri = $_POST["haftalik_calisma_saatleri"];
    $isbirligi_deneyim = $_POST["isbirligi_deneyim"];
    $programlama_dilleri = $_POST["programlama_dilleri"];
    $ozgecmis = $_POST["ozgecmis"];
    $bilgi_paylasimi = $_POST["bilgi_paylasimi"];
    $kendini_gelistirme = $_POST["kendini_gelistirme"];


    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

    // Insert data into the database
    // SQL query to insert data into the "kullanici" table
    $sql = "INSERT INTO kullanici (ad, soyad, ogrenci_no, telefon, bolum, email, deneyim, ilgi, ilgi_alanlari, kulup_deneyim, haftalik_calisma_saatleri, isbirligi_deneyim, programlama_dilleri, ozgecmis, bilgi_paylasimi, kendini_gelistirme)
    VALUES ('$ad', '$soyad', '$ogrenci_no', '$telefon', '$bolum', '$email', '$deneyim', '$ilgi', '$ilgi_alanlari', '$kulup_deneyim', '$haftalik_calisma_saatleri', '$isbirligi_deneyim', '$programlama_dilleri', '$ozgecmis', '$bilgi_paylasimi', '$kendini_gelistirme')";


    if ($conn->query($sql) === TRUE) {
        header("Location: https://ereglicyberredteam.com/");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
