<?php
require("baglan.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alt_kategori_id = $_POST["productUpSubCategory"];
    $updated_sub_category = $_POST["updated_sub_category"];
    
    $query = "UPDATE alt_kategori SET alt_kategori_ad = '$updated_sub_category' WHERE alt_kategori_id = $alt_kategori_id";
    $result = mysqli_query($baglanti, $query);
    
    if ($result) {
        header("Location: kategori_guncelle.php");
        exit; 
    } else {
        echo "Alt kategori güncellenirken bir hata oluştu.";
    }
}
?>