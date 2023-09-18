<?php
// key - value 

$plakalar = array("81", "41", "01");
$sehirler = array("düzce", "istanbul", "adana");

$plaka_bilgileri = array(
    "81" => "düzce",
    "34" => "istanbul",
    "01" => "adana"
);

echo $plaka_bilgileri["81"] . "<br>";
echo $plaka_bilgileri["34"] . "<br>";
echo $plaka_bilgileri["01"] . "<br>";

$telefon_rehberi = [
    "ali" => "444444444",
    "efe" => "22222",
    "mete" => "12345"
];

echo $telefon_rehberi["ali"] . "<br>";

$urun = [
    "Urun Adi" => "Iphone 15 MAX mex pro zıkkımmmm falan filan",
    "fiyat" => 300000000,
    "satistami" => true
];

echo $urun["Urun Adi"] . " " . $urun["fiyat"] . "<br>";

$urunler = [
    [
        "Urun Adi" => "Iphone 15 MAX mex pro zıkkımmmm falan filan",
        "fiyat" => 300000000,
        "satistami" => true
    ],
    [
        "Urun Adi" => "Iphone 18 MAX mex pro zıkkımmmm falan filan",
        "fiyat" => 300000000,
        "satistami" => true
    ],
    [
        "Urun Adi" => "Iphone 19 MAX mex pro zıkkımmmm falan filan",
        "fiyat" => 300000000,
        "satistami" => true
    ]
];

echo $urunler[0]["Urun Adi"] . "<br>";
echo $urunler[1]["Urun Adi"] . "<br>";
echo $urunler[2]["Urun Adi"] . "<br>";
?>
