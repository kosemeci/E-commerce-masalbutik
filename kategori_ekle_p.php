<?php
require("baglan.php");

$new_category = $_POST["new_category"];

if (!empty($new_category)) {
    // Ekleme sorgusunu hazırla
    $query = "INSERT INTO kategori (kategori_ad) VALUES ('$new_category')";

    if (mysqli_query($baglanti, $query)) {
        header("Location: kategori_guncelle.php");
        exit; // Kodun çalışmasını durdur
    } else {
        echo "Kategori eklenirken bir hata oluştu: " . mysqli_error($baglanti);
        header("Location: kategori.php");
        exit; // Kodun çalışmasını durdur
    }
} else {
    echo "Kategori adı boş olamaz.";
}
?>
