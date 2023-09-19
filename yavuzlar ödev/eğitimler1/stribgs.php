<?php

$urunAdi = "elma";
$urunFiyat = 30;
$KvdOrani = 0.18;

$kdvFiyat = $urunFiyat + ($urunFiyat * $KvdOrani);

$sonuc = $urunAdi . " isimli ürünün fiyatı " . $kdvFiyat . " TL.";

echo $sonuc."<br>";
echo $sonuc[0]."<br>";
echo $sonuc[20]."<br>";


// string fonksiyonları


echo strlen($sonuc)."<br>";
echo str_word_count($KvdOrani)."<br>";
echo strtolower($sonuc)."<br>"; //  sonuc yazısını kücük harflerde yazar
echo strtoupper($sonuc)."<br>"; // sonuc yazısnı büyük harflerde yazar


?>
