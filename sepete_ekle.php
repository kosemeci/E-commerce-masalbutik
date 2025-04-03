<?php
require_once("baglan.php");
session_start();
$user_id = 0;

// Kullanıcı oturumu varsa kullanıcı kimliğini al
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql_aktif_kullanici = "SELECT k_id FROM kullanici WHERE mail = '$user' OR telefon='$user'";
    $result = $baglanti->query($sql_aktif_kullanici);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["k_id"];
        } else {
            echo "success";
        }
    } else {
        echo "SQL sorgusu hatası: " . $baglanti->error;
    }
}

// POST isteğiyle gönderilen verileri kontrol et
if (isset($_POST['beden']) && isset($_POST['urun_kodu'])) {
    $urun_beden = $_POST['beden'];
    $urun_kodu = $_POST['urun_kodu'];

    // Kullanıcının sepette aynı ürün ve bedenle ilgili siparişi var mı kontrol et
    $sql_kontrol = "SELECT siparis_id, adet FROM sepet WHERE kullanici_id = ? AND urun_kodu = ? AND urun_beden = ?";
    $stmt_kontrol = $baglanti->prepare($sql_kontrol);
    $stmt_kontrol->bind_param("iss", $user_id, $urun_kodu, $urun_beden);
    $stmt_kontrol->execute();
    $stmt_kontrol->store_result();


    if ($stmt_kontrol->num_rows > 0) {

        // Eğer varsa, sipariş adedini artır
        $stmt_kontrol->bind_result($siparis_id, $adet);
        $stmt_kontrol->fetch();
        if(isset($_POST['adet'])){
            $adet=$_POST['adet'];
        }
        else{
            $adet++;
        }

        // Adeti güncelle
        $sql_artir = "UPDATE sepet SET adet = ? WHERE siparis_id = ?";
        $stmt_artir = $baglanti->prepare($sql_artir);
        $stmt_artir->bind_param("ii", $adet, $siparis_id);

        if ($stmt_artir->execute()) {
            echo "success";
        } else {
            echo "unsuccess";
        }

        $stmt_artir->close();
    } else {
        // Eğer sipariş yoksa, yeni bir sipariş oluştur
        $sql_sepet_ekle = "INSERT INTO sepet (kullanici_id, urun_kodu, urun_beden, adet, durum) VALUES (?, ?, ?, 1, 0)";
        $stmt_ekle = $baglanti->prepare($sql_sepet_ekle);
        $stmt_ekle->bind_param("iss", $user_id, $urun_kodu, $urun_beden);

        if ($stmt_ekle->execute()) {
            echo "success";
        } 
        else {
            echo "unsuccess";
        }

        $stmt_ekle->close();
    }

    $stmt_kontrol->close();
} else {
    echo "unsuccess";
}
?>
