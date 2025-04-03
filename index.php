<?php require_once("baglan.php");
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

//ALT KATEGORİLERİ GETİRME
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_alt_kategori = "SELECT alt_kategori_id,alt_kategori_ad, kategori_id FROM alt_kategori WHERE kategori_id = ?";
    $stmt = $baglanti->prepare($sql_alt_kategori);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<input type='radio' id='" . $row['alt_kategori_ad'] . "' name='alt_kategori' value='" . $row['alt_kategori_id'] . "'>
            <label for='" . $row['alt_kategori_ad'] . "'>" . $row['alt_kategori_ad'] . "</label><br>";
    }

    $stmt->close();
    exit;
}

//ALT KATEGORİLERİ GETİRME MOBİL 
if (isset($_GET['category_ad'])) {
    $category_ad = $_GET['category_ad'];

    $sql_kat_id = "SELECT kategori_id FROM kategori WHERE kategori_ad=?";
    $stmt2 = $baglanti->prepare($sql_kat_id);
    $stmt2->bind_param("s", $category_ad); 
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $category_id = $row["kategori_id"];
    }
    $stmt2->close();


    $sql_alt_kategori = "SELECT alt_kategori_id,alt_kategori_ad, kategori_id FROM alt_kategori WHERE kategori_id = ?";
    $stmt = $baglanti->prepare($sql_alt_kategori);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<input type='radio' id='" . $row['alt_kategori_ad'] . "' name='alt_kategori' value='" . $row['alt_kategori_id'] . "'>
            <label for='" . $row['alt_kategori_ad'] . "'>" . $row['alt_kategori_ad'] . "</label><br>";
    }

    $stmt->close();
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masal Kids Butik</title>
    <link rel="icon" href="img/logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <script src="js/index.js"></script>
</head>

<body>

    <div class="navbar-fixed">
        <?php require_once('navbar.php') ?>
    </div>
    <div class="trend_urun">
        <img src="img/home/trend.jpg" alt="Trend Ürünler">
        <div class="overlay">
            Trend Ürünler
        </div>
    </div>


    <div class="kiz_cocuk">
        <img src="img/home/kiz_cocuk.jpg" alt="Kız Cocuk">
        <div class="overlay">
            Kız Çocuk
        </div>
    </div>

    <div class="erkek_cocuk">
        <img src="img/home/erkek_cocuk.jpg" alt="Erkek Cocuk">
        <div class="overlay">
            Erkek Çocuk
        </div>
    </div>


    <section class="section">


        <h1 id="vitrin" class="sectionBaslik" style="color:#2f3542">Vitrin</h1>
        <hr>

        <div class="row sectionRow">
            <div class="col-7 col-lg-2">

                <div class="sidebar">

                    <h5>Sıralama <i class=" bi bi-chevron-right"></i></h5>
                    <ul class="toggle-content show">
                        <li><input type="radio" name="siralamalar" id="varsayilan" checked><label for="varsayilan">Varsayılan</label></li>
                        <li><input type="radio" name="siralamalar" id="artanfiyat"><label for="artanfiyat">Artan Fiyat</label></li>
                        <li><input type="radio" name="siralamalar" id="azalanfiyat"><label for="azalanfiyat">Azalan Fiyat</label></li>
                        <li><input type="radio" name="siralamalar" id="eskidenyeniye"><label for="eskidenyeniye">Eskiden Yeniye</label></li>
                        <li><input type="radio" name="siralamalar" id="yenideneskiye"><label for="yenideneskiye">Yeniden Eskiye</label></li>

                    </ul>
                    <h5>Kategori <i class=" bi bi-chevron-right"></i></h5>
                    <ul class="toggle-content">
                        <?php
                        $sql_kategori = "SELECT kategori_id, kategori_ad FROM kategori";
                        $sql_kategoriler = $baglanti->query($sql_kategori);
                        while ($row = $sql_kategoriler->fetch_assoc()) {
                            echo "<input type='radio' id='" . $row['kategori_ad'] . "' name='kategori' value='" . $row['kategori_id'] . "'>
                            <label for='" . $row['kategori_ad'] . "'>" . $row['kategori_ad'] . "</label><br>";
                        }
                        ?>

                    </ul>
                    <h5>Alt Kategori <i class=" bi bi-chevron-right"></i></h5>
                    <ul class="toggle-content" id="alt_kategori">

                    </ul>
                    <h5>Yaş Grubu <i class=" bi bi-chevron-right"></i></h5>
                    <ul class="toggle-content">
                        <li><input type="radio" name="yasgrubu" id="2-3yas"><label for="2-3yas">2-3 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="3-4yas"><label for="3-4yas">3-4 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="4-5yas"><label for="4-5yas">4-5 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="5-6yas"><label for="5-6yas">5-6 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="6-7yas"><label for="6-7yas">6-7 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="7-8yas"><label for="7-8yas">7-8 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="8-9yas"><label for="8-9yas">8-9 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="9-10yas"><label for="9-10yas">9-10 Yaş</label></li>
                        <li><input type="radio" name="yasgrubu" id="10-11yas"><label for="10-11yas">10-11 Yaş</label></li>


                    </ul>
                </div>
            </div>

            <div class="col-12 col-lg-10">
                <div class="row" id="urunler">

                    <?php


                    $sql = "SELECT urun_kodu,urun_baslik, urun_fiyati,urun_eski_fiyat, ana_resim FROM urun";
                    $result = $baglanti->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $urunBaslik = $row['urun_baslik'];
                        $urunFiyat = $row['urun_fiyati'];
                        $urunResim = $row['ana_resim'];
                        $urunFiyatEski = $row['urun_eski_fiyat'];
                        $urunKodu = $row['urun_kodu'];
                    ?>
                        <div class="col-lg-3 mb-4">
                            <div class="card" id="<?php echo $urunKodu; ?>">
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

                </div>

            </div>

        </div>


    </section>

    <section class="mobil-section">

        <div class="row">

            <div class="col-12 mt-2">
                <h2 class="mobilSectionBaslik">Vitrin</h2>
                <hr>
            </div>


            

            <div class="sidebar">

                <h5>Sıralama <i class=" bi bi-chevron-right"></i></h5>
                <ul class="toggle-content show">
                    <li><input type="radio" name="siralamala" id="varsayilanMobil"><label for="varsayilanMobil">Varsayılan</label></li>
                    <li><input type="radio" name="siralamala" id="artanfiyatMobil"><label for="artanfiyatMobil">Artan Fiyat</label></li>
                    <li><input type="radio" name="siralamala" id="azalanfiyatMobil"><label for="azalanfiyatMobil">Azalan Fiyat</label></li>
                    <li><input type="radio" name="siralamala" id="eskidenyeniyeMobil"><label for="eskidenyeniyeMobil">Eskiden Yeniye</label></li>
                    <li><input type="radio" name="siralamala" id="yenideneskiyeMobil"><label for="yenideneskiyeMobil">Yeniden Eskiye</label></li>
                </ul>
                <h5>Kategori <i class=" bi bi-chevron-right"></i></h5>
                <ul class="toggle-content">
                    <?php
                    $sql_kategori = "SELECT kategori_id, kategori_ad FROM kategori";
                    $sql_kategoriler = $baglanti->query($sql_kategori);
                    while ($row = $sql_kategoriler->fetch_assoc()) {
                        echo "<input type='radio' id='" . $row['kategori_id'] . "' name='kategori_mobil' value='" . $row['kategori_ad'] . "'>
                            <label for='" . $row['kategori_id'] . "'>" . $row['kategori_ad'] . "</label><br>";
                    }
                    ?>

                </ul>
                <h5>Alt Kategori <i class=" bi bi-chevron-right"></i></h5>
                <ul class="toggle-content" id="alt_kategori_mobil">

                </ul>
                <h5>Yaş Grubu <i class=" bi bi-chevron-right"></i></h5>
                <ul class="toggle-content">
                    <li><input type="radio" name="yasgrubu" id="2-3YAS"><label for="2-3YAS">2-3 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="3-4YAS"><label for="3-4YAS">3-4 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="4-5YAS"><label for="4-5YAS">4-5 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="5-6YAS"><label for="5-6YAS">5-6 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="6-7YAS"><label for="6-7YAS">6-7 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="7-8YAS"><label for="7-8YAS">7-8 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="8-9YAS"><label for="8-9YAS">8-9 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="9-10YAS"><label for="9-10YAS">9-10 Yaş</label></li>
                    <li><input type="radio" name="yasgrubu" id="10-11YAS"><label for="10-11YAS">10-11 Yaş</label></li>


                </ul>
            </div>

            <div class="row">

                <?php

                $sql = "SELECT urun_kodu,urun_baslik, urun_fiyati,urun_eski_fiyat, ana_resim FROM urun";
                $result = $baglanti->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $urunBaslik = $row['urun_baslik'];
                    $urunFiyat = $row['urun_fiyati'];
                    $urunResim = $row['ana_resim'];
                    $urunFiyatEski = $row['urun_eski_fiyat'];
                    $urunKodu = $row['urun_kodu'];
                ?>
                    <div class="col-6 mt-3">
                        <div class="card">
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

            </div>

        </div>
    </section>


    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php require_once('footer.php') ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>