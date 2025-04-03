<?php
require_once("baglan.php");
session_start();

$user_id = 0;

//AKTİF KULLANICI VARMI DİYE KONTROL
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql_aktif_kullanici = "SELECT k_id FROM kullanici WHERE mail = '$user'";
    $result = $baglanti->query($sql_aktif_kullanici);

    // SQL sorgusunun başarıyla çalışıp çalışmadığını kontrol et
    if ($result) {
        // Sorgudan dönen satır sayısını kontrol et
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["k_id"];
        } else {
            echo "Belirtilen e-posta adresine sahip kullanıcı bulunamadı.";
        }
    } else {
        echo "SQL sorgusu hatası: " . $baglanti->error;
    }
}

if (isset($_POST['kategori'])) {
    $kategori_ad = $_POST['kategori'];
    $siralama = $_POST['siralama_turu'];

    $sql = "SELECT urun_kodu,urun_baslik, ana_resim,urun_fiyati,urun_eski_fiyat,tarih FROM urun WHERE kategori_id = '$kategori_ad'";
    switch ($siralama) {
        case 'Artan Fiyat':
            $sql .= " ORDER BY urun_fiyati ASC";
            break;
        case 'Azalan Fiyat':
            $sql .= " ORDER BY urun_fiyati DESC";
            break;
        case 'Eskiden Yeniye':
            $sql .= " ORDER BY tarih ASC";
            break;
        case 'Yeniden Eskiye':
            $sql .= " ORDER BY tarih DESC";
            break;
        default:
            break;
    }
} else {
    $sql = "SELECT urun_kodu,urun_baslik, ana_resim,urun_fiyati,urun_eski_fiyat,tarih FROM urun";
}

if (isset($_POST['siralama'])) {
    $siralama_turu = $_POST['siralama'];
    $kategori_ad = $_POST['kategori_turu'];

    if($kategori_ad>0){
        $sql = "SELECT urun_kodu,urun_baslik, ana_resim,urun_fiyati,urun_eski_fiyat,tarih FROM urun WHERE kategori_id = '$kategori_ad'";

    }
    switch ($siralama_turu) {
        case 'Artan Fiyat':
            $sql .= " ORDER BY urun_fiyati ASC";
            break;
        case 'Azalan Fiyat':
            $sql .= " ORDER BY urun_fiyati DESC";
            break;
        case 'Eskiden Yeniye':
            $sql .= " ORDER BY tarih ASC";
            break;
        case 'Yeniden Eskiye':
            $sql .= " ORDER BY tarih DESC";
            break;
        default:
            break;
    }
}

// if (isset($_POST['alt_kategori'])) {

//     $siralama_turu = $_POST['siralama_turu_alt'];
//     $kategori_ad = $_POST['kategori_turu_alt'];
//     $alt_kategori_ad = $_POST['alt_kategori'];


//     $sql = "SELECT urun_kodu,urun_baslik, ana_resim,urun_fiyati,urun_eski_fiyat,tarih FROM urun WHERE alt_kategori_id = 1";

    
//     switch ($siralama_turu) {
//         case 'Artan Fiyat':
//             $sql .= " ORDER BY urun_fiyati ASC";
//             break;
//         case 'Azalan Fiyat':
//             $sql .= " ORDER BY urun_fiyati DESC";
//             break;
//         case 'Eskiden Yeniye':
//             $sql .= " ORDER BY tarih ASC";
//             break;
//         case 'Yeniden Eskiye':
//             $sql .= " ORDER BY tarih DESC";
//             break;
//         default:
//             break;
//     }
// }




$result = $baglanti->query($sql);

while ($row = $result->fetch_assoc()) {
    $urunBaslik = $row['urun_baslik'];
    $urunFiyat = $row['urun_fiyati'];
    $urunResim = $row['ana_resim'];
    $urunFiyatEski = $row['urun_eski_fiyat'];
    $urunKodu = $row['urun_kodu'];
?>
    <div class="col-lg-3 mb-4">
        <div class="card" id='<?php echo $urunKodu; ?>'>
            <div class="card-img" style="position: relative;">
                <img src="<?php echo $urunResim; ?>" class="card-img-top" alt="<?php echo $urunBaslik; ?>">
                <?php
                $sql_like = "SELECT * FROM urun_kaydet WHERE urun_kodu = '$urunKodu' AND kullanici_id = '$user_id'";
                $result_like = $baglanti->query($sql_like);

                if ($result_like && $result_like->num_rows > 0) {
                ?>
                    <i class="fas fa-heart like_icon" id='<?php echo $urunKodu; ?>'></i>
                <?php
                } else {
                ?>
                    <i class="far fa-heart like_icon" id='<?php echo $urunKodu; ?>'></i>
                <?php
                }

                ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $urunBaslik; ?>
                </h5>

                <div class="card-text">
                    <?php if ($urunFiyatEski && $urunFiyatEski != 0) : ?>
                        <span class="old_price" style="text-decoration: line-through;font-size: smaller;"><?php echo $urunFiyatEski; ?> TL</span>
                    <?php endif; ?>
                    <?php echo $urunFiyat; ?> TL
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

