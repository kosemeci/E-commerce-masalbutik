<?php
// Bağlantı dosyasını dahil et
require_once("baglan.php");

// POST isteği üzerinden ürün kodunu al
$urun_kodu = $_POST['urun_kodu'];

// Veritabanından ilgili ürünü sil
$sql = "DELETE FROM sepet WHERE urun_kodu = '$urun_kodu'";
if ($baglanti->query($sql) === TRUE) {
    // Başarılı bir şekilde silindiğini belirtmek için "success" yanıtı gönder
    echo "success";
} else {
    // Bir hata oluştuğunda hata mesajını gönder
    echo "Error: " . $sql . "<br>" . $baglanti->error;
}

// Bağlantıyı kapat
$baglanti->close();
?>
