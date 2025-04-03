<?php
require("baglan.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen değerleri al
    $kategoriId = $_POST["existing_category"];
    $altKategoriAd = $_POST["new_sub_category"];
    
    // Ekleme sorgusunu hazırla ve çalıştır
    $query = "INSERT INTO alt_kategori (kategori_id, alt_kategori_ad) VALUES ('$kategoriId', '$altKategoriAd')";
    $result = mysqli_query($baglanti, $query);
    
    // Ekleme başarılıysa mesaj göster
    if ($result) {
        header("Location: kategori_guncelle.php");
        exit; 
    } else {
        echo "Alt kategori eklenirken bir hata oluştu.";
        header("Location: kategori_guncelle.php");
        exit; 
    }
}
?>