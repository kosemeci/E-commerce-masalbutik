<?php
require("baglan.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $existingCategory = $_POST["existing_category"];
    $updatedCategory = $_POST["updated_category"];
    
    $query = "UPDATE kategori SET kategori_ad = '$updatedCategory' WHERE kategori_ad = '$existingCategory'";
    $result = mysqli_query($baglanti, $query);
    
    if ($result) {
        header("Location: kategori_guncelle.php");
        exit; 
    } else {
        echo "Kategori güncellenirken bir hata oluştu.";
    }
}
?>