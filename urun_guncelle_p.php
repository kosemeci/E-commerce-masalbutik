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
    $productCode = $_POST['productCode'];


    if(isset($_FILES["productImagee"]["name"]) && $_FILES["productImagee"]["name"] != ""){

        $targetDir = "img/urunler/";
        $targetFile = $targetDir . basename($_FILES["productImagee"]["name"]);
        move_uploaded_file($_FILES["productImagee"]["tmp_name"], $targetFile);
        $sql_resim = "UPDATE urun 
        SET ana_resim = '$targetFile'
        WHERE urun_kodu = '$productCode' ";
        $baglanti->query($sql_resim);

    }
    
    
    if (isset($_FILES['productOtherImagess']['name']) && $_FILES["productOtherImagess"]["name"][0] != "" ) {

        $hedef_dizisi = array();
        $dosya_sayisi = count($_FILES['productOtherImagess']['name']);
    
        for ($i = 0; $i < $dosya_sayisi; $i++) {

            $gecici_konum = $_FILES['productOtherImagess']['tmp_name'][$i];
            $dosya_adi = ($_FILES['productOtherImagess']['name'][$i]);
            $dosya_uzantisi = pathinfo($dosya_adi, PATHINFO_EXTENSION);
    
            $benzersiz_dosya_adi = time() . '_' . $i . '.' . $dosya_uzantisi;
    
            $hedef_konum = 'img/' . $benzersiz_dosya_adi;
            $hedef_dizisi[] = $hedef_konum;

            move_uploaded_file($gecici_konum, $hedef_konum);
        }
        $resimler = implode(",", $hedef_dizisi);
        $sql_resimler = "UPDATE urun 
        SET resimler = '$resimler'
        WHERE urun_kodu = '$productCode' ";
        $baglanti->query($sql_resimler);
    }
    
    
    $beden_dizisi = array();

    $bedenler = array("size_12ay", "size_18ay", "size_10", "size_11", "size_12", "size_13", "size_14");

    foreach ($bedenler as $beden) {
        if (isset($_POST[$beden])) {
            $beden_dizisi[] = $_POST[$beden];
        }
    }

    
    $urun_beden = implode(",", $beden_dizisi);


    $sql = "UPDATE urun 
    SET urun_baslik = '$ad',
        stok_sayisi = '$stok',
        urun_beden = '$urun_beden',
        urun_fiyati = '$fiyat',
        urun_eski_fiyat = '$eskiFiyat',
        kategori_id = '$kategori',
        alt_kategori_id ='$alt_kategori',
        urun_metin = '$aciklama',
        urun_aktif = 1
    WHERE urun_kodu = '$productCode' ";

    try {

        if ($baglanti->query($sql) === TRUE) {
            header("Location: urun_guncelle.php");
            exit;
        } else {
            header("Location: urun_guncelle.php");
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        echo 'error';
    }
}
