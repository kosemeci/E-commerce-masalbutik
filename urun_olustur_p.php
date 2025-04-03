<?php
require("baglan.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ad = $_POST["productName"];
    $fiyat = $_POST["productPrice"];
    $stok = $_POST["productCount"];
    $kategori = $_POST["productCategory"];
    $eskiFiyat = isset($_POST["productOldPrice"]) ? $_POST["productOldPrice"] : null;
    $alt_kategori = $_POST["productSubCategory"];
    $aciklama = $_POST["productDescription"];

    $targetDir = "img/urunler/";
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile);
    
    $hedef_dizisi = array();
    if (isset($_FILES['productOtherImages']['name'])) {
        // Dosyaların sayısını alın
        $dosya_sayisi = count($_FILES['productOtherImages']['name']);
    
        for ($i = 0; $i < $dosya_sayisi; $i++) {

            $gecici_konum = $_FILES['productOtherImages']['tmp_name'][$i];
            $dosya_adi = ($_FILES['productOtherImages']['name'][$i]);
            $dosya_uzantisi = pathinfo($dosya_adi, PATHINFO_EXTENSION);
    
            $benzersiz_dosya_adi = time() . '_' . $i . '.' . $dosya_uzantisi;
    
            $hedef_konum = 'img/' . $benzersiz_dosya_adi;
            $hedef_dizisi[] = $hedef_konum;

            move_uploaded_file($gecici_konum, $hedef_konum);
        }
    }
    
    
    $beden_dizisi = array();

    $bedenler = array("size_12ay", "size_18ay", "size_10", "size_11", "size_12", "size_13", "size_14");

    foreach ($bedenler as $beden) {
        if (isset($_POST[$beden])) {
            $beden_dizisi[] = $_POST[$beden];
        }
    }

    $resimler = implode(",", $hedef_dizisi);
    $urun_beden = implode(",", $beden_dizisi);

    date_default_timezone_set('Europe/Istanbul');
    $tarih = date('d.m.Y H:i');

    function generateProductCode($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $productCode = '';
        for ($i = 0; $i < $length; $i++) {
            $productCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $productCode;
    }
    function isProductCodeUnique($productCode, $connection) {
        $query = "SELECT COUNT(*) AS count FROM urun WHERE urun_kodu = '$productCode'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] == 0;
    }
    
    do {
        $urunKodu = generateProductCode();
    } while (!isProductCodeUnique($urunKodu, $baglanti));
    

    $sql = "INSERT INTO urun (urun_kodu,urun_baslik,ana_resim,resimler,stok_sayisi,urun_beden, urun_fiyati,urun_eski_fiyat,kategori_id,alt_kategori_id,urun_metin,tarih,urun_aktif) 
    VALUES ( '$urunKodu','$ad','$targetFile','$resimler','$stok', '$urun_beden','$fiyat','$eskiFiyat','$kategori','$alt_kategori','$aciklama','$tarih',1)";

    try {

        if ($baglanti->query($sql) === TRUE) {
            echo 'success';
        } else {
            echo 'unsuccess';
        }
    } catch (mysqli_sql_exception $e) {
        echo 'error';
    }
}
