<?php
require("baglan.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isim = $_POST["isim"];
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];
    $tel_no = $_POST["telefon"];
    $sifre_tekrar = $_POST["sifre_tekrar"];
    $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);

    $premium_kontrol=0;
    

    $sql = "INSERT INTO kullanici (ad,mail,telefon, sifre,durum) 
    VALUES ( '$isim','$email', '$tel_no','$hashed_password','$premium_kontrol')";

    try{
        
        if ($baglanti->query($sql) === TRUE) {
            echo 'success';
        } 
        else {
            echo 'unsuccess';

        }
    }
    catch (mysqli_sql_exception $e){
            echo 'mail';
    }
}
