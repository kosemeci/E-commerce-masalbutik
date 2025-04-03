<?php
$productCode = $_GET['productCode'];
require_once("baglan.php");
$query = "SELECT urun_baslik,ana_resim,resimler, stok_sayisi,urun_beden, urun_fiyati, urun_eski_fiyat,kategori_id,alt_kategori_id, urun_metin FROM urun WHERE urun_kodu = ?";
$stmt = $baglanti->prepare($query);
$stmt->bind_param("s", $productCode);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($urunAdi, $anaResim, $resimler, $stokSayisi, $urunBeden, $urunFiyat, $urunEskiFiyat, $kategoriId, $alt_id, $urunMetin);
    $stmt->fetch();
    $resimlerArray = explode(",", $resimler);
    $bedenArray = explode(",", $urunBeden);
    $query2 = "SELECT alt_kategori_ad from alt_kategori where alt_kategori_id=?";
    $stmt2 = $baglanti->prepare($query2);
    $stmt2->bind_param("i", $alt_id);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($alt_k_id);
    $stmt2->fetch();


    $response = array(
        "urunAdi" => $urunAdi,
        "urunAnaResim" => $anaResim,
        "urunResimler" => $resimlerArray,
        "urunStok" => $stokSayisi,
        "urunBeden" => $bedenArray,
        "urunFiyat" => $urunFiyat,
        "urunEskiFiyat" => $urunEskiFiyat,
        "urunKat" => $kategoriId,
        "altKat" => $alt_k_id,
        "altKatId" => $alt_id,
        "urunMetin" => $urunMetin
    );
    $jsonResponse = json_encode($response);
    echo $jsonResponse;
} else {

    $errorResponse = array("error" => "Ürün bulunamadı.");
    $jsonErrorResponse = json_encode($errorResponse);
    echo $jsonErrorResponse;
}
$stmt->close();
