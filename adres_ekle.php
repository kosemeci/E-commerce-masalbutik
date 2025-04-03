<?php
require_once("baglan.php");

$baslik = $_POST['baslik'];
$il = $_POST['il'];
$ilce = $_POST['ilce'];
$sokak = $_POST['sokak'];
$no = $_POST['no'];
$daire = $_POST['daire'];
$adresTarifi = $_POST['adresTarifi'];

session_start();
$user_id = $_SESSION['user_id'];

// Veritabanına ekleme işlemi
$sql = "INSERT INTO adres (k_id, baslik, il,ilce,sokak,n_o,daire, adres_tarifi) VALUES ('$user_id', '$baslik', '$il','$ilce','$sokak','$no',$daire,'$adresTarifi')";
if ($baglanti->query($sql) === TRUE) {
    echo "Adres başarıyla eklendi!";
} else {
    echo "Hata: " . $sql . "<br>" . $baglanti->error;
}

// Veritabanı bağlantısının kapatılması
$baglanti->close();
?>
