<?php
require_once("baglan.php");
session_start();
if (isset($_SESSION['username'])) {
    $kullaniciMail = $_SESSION['username'];
    $product_id = $_POST['product_id'];
    $sql_aktif_kullanici = "SELECT k_id FROM kullanici WHERE mail = '$kullaniciMail'";
    $result = $baglanti->query($sql_aktif_kullanici);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["k_id"];
        } else {
            echo "Belirtilen e-posta adresine sahip kullanıcı bulunamadı.";
        }
    } else {
        echo "SQL sorgusu hatası: " . $baglanti->error;
    }

    if ($_POST['action']=='like') {
        $sql = "INSERT INTO urun_kaydet (urun_kodu, kullanici_id) VALUES ('$product_id', '$user_id')";
        if ($baglanti->query($sql) === TRUE) {
            echo "like";
        }
        else {
            echo "Hata: " . $sql . "<br>" . $baglanti->error;
        }
    } else {
        $sql = "DELETE FROM urun_kaydet WHERE kullanici_id = '$user_id' AND urun_kodu = '$product_id'";
        if ($baglanti->query($sql) === TRUE) {
            echo "disslike";
        }
        else {
            echo "Hata: " . $sql . "<br>" . $baglanti->error;
        }
    }
} else {
    echo "login";
}
