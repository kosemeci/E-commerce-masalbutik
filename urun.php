<?php require_once("baglan.php");

if (isset($_GET['urunKodu'])) {
    $urun_id = $_GET['urunKodu'];
}

session_start();
$user_id = 0;

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql_aktif_kullanici = "SELECT k_id FROM kullanici WHERE mail = '$user'";
    $result = $baglanti->query($sql_aktif_kullanici);

    if ($result) {
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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Masal Butik</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/urun.css">


</head>

<body>

    <?php require_once("navbar.php") ?>

    <div class=" urun_container">
        <div class="row anim_kargo">
            <p style="padding-left: 20px;"> 400 TL ÜZERİ KARGO BEDAVA </p>
        </div>
        <div class="row urun_row">
            <?php

            $sql_urun = "SELECT urun_kodu,urun_baslik,ana_resim,resimler,urun_beden,urun_fiyati,urun_eski_fiyat,urun_metin,kategori_id FROM urun WHERE urun_kodu = ?";
            $stmt = $baglanti->prepare($sql_urun);
            $stmt->bind_param("s", $urun_id);
            $stmt->execute();
            $stmt->bind_result($urun_kodu, $urun_baslik, $ana_resim, $resimler, $urun_beden, $urun_fiyati, $urun_eski_fiyat, $urun_metin, $kategori_id);
            $stmt->fetch();
            $stmt->close();

            ?>
            <div class="col-md-4 order-md-1 order-1">
                <div class="urun-card">
                    <div class="urun-card-img">
                        <img src="<?php echo $ana_resim; ?>" class="card-img-top" alt="<?php echo $urun_baslik; ?>">
                    </div>
                </div>
                <div class="row diger_resimler">
                    <?php
                    $kucuk_resimler = explode(",", $resimler);
                    echo '<div class="col-2-5 mt-3 ">';
                    echo '<img src="' . $ana_resim . '" class="img-fluid kucuk-fotograf " alt="Küçük Fotoğraf">';
                    echo '</div>';

                    foreach ($kucuk_resimler as $kucuk_resim) {
                        echo '<div class="col-2-5 mt-3">';
                        echo '<img src="' . $kucuk_resim . '" class="img-fluid kucuk-fotograf" alt="Küçük Fotoğraf">';
                        echo '</div>';
                    }
                    ?>
                </div>

            </div>
            <div class="col-md-7 order-md-2 order-2">
                <h1 class="urun_baslik"> <?php echo $urun_baslik; ?> </h1>
                <hr>
                <h2> <?php echo $urun_fiyati . " TL"; ?></h2>
                <div class="urun_beden">
                    <div class="beden_baslik">
                        <h4>Beden :</h4>
                    </div>
                    <div class="row beden_secenekler">
                        <?php
                        $bedenler = explode(",", $urun_beden);
                        foreach ($bedenler as $beden) {
                            echo '<div class="col-auto">';
                            echo '<button class="beden_buton">' . trim($beden) . '</button>';
                            echo '</div>';
                        }
                        ?>

                    </div>

                </div>
                <div id="urun_kodu" style="display: none;"><?php echo $urun_kodu; ?></div>

                <div class="whatsapp-butonu">
                    <a href="https://api.whatsapp.com/send?phone=905555555555&amp;text=Merhaba! Ürün hakkında bilgi almak istiyorum." target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-whatsapp"></i>
                        Ürün Hakkında Soru Sor
                    </a>
                </div>

                <div class="sepet_row">
                    <?php if ($user_id == 0) : ?>
                        <button class="buton__sepet" onclick="login()">Sepete Ekle</button>
                    <?php else : ?>
                        <button class="buton_sepet">Sepete Ekle</button>
                    <?php endif; ?>
                </div>

                <div class="urun_bilgileri mt-5">
                    <ul>
                        <h2 class="urun_ozellikleri">Ürün Özellikleri</h2>
                        <?php
                        $metinler = explode("$", $urun_metin);
                        foreach ($metinler as $metin) {
                            $metin = trim($metin);
                            echo '<li>' . $metin . '</li>';
                        }

                        ?>
                    </ul>
                </div>

            </div>

        </div>

    </div>

    <section id="tranding">
        <div class="container">
            <h1 class="section-heading">Benzer Ürünler</h1>
        </div>
        <div class="container">
            <div class="swiper tranding-slider">
                <div class="swiper-wrapper">
                    <?php
                    $sql_urun = "SELECT urun_kodu, urun_baslik, ana_resim, urun_fiyati FROM urun WHERE kategori_id = ?";
                    $stmt = $baglanti->prepare($sql_urun);
                    $stmt->bind_param("i", $kategori_id);
                    $stmt->execute();
                    $stmt->bind_result($urun_kodu, $urun_baslik, $ana_resim, $urun_fiyati);

                    while ($stmt->fetch()) {
                    ?>
                        <div class="swiper-slide tranding-slide" id="<?php echo $urun_kodu; ?>">
                            <div class="tranding-slide-img">
                                <img src="<?php echo $ana_resim; ?>" alt="<?php echo $urun_baslik; ?>">
                            </div>
                            <div class="tranding-slide-content">
                                <h1 class="food-price"><?php echo $urun_fiyati . " ₺"; ?></h1>
                                <div class="tranding-slide-content-bottom">
                                    <h2 class="food-name">
                                        <?php echo $urun_baslik; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    $stmt->close();
                    ?>

                </div>

                <div class="tranding-slider-control">
                    <div class="swiper-button-prev slider-arrow">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </div>
                    <div class="swiper-button-next slider-arrow">
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </section>

    <div id="custom-alert" class="custom-alert">
        <div class="alert-content">
            <span class="close-btn">&times;</span>
            <p>Ürün sepete eklendi.</p>
            <button id="go-to-cart">Sepete Git</button>
        </div>
    </div>

    <div id="size-alert" class="custom-alert">
        <div class="alert-content">
            <p>Lütfen beden seçiniz..</p>
        </div>
    </div>

    <?php require_once("footer.php") ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    // slider için ürün.php de yerini açma 
    $(document).ready(function() {
        $(document).on('click', '.tranding-slide', function() {
            var urunKodu = $(this).attr('id');
            window.location = 'urun.php?urunKodu=' + urunKodu;
        });
    });

    function login() {
        window.location.href = "giris.php";
    }


    document.addEventListener('DOMContentLoaded', function() {
        var bedenButonlar = document.querySelectorAll('.beden_buton');
        var sepetButonu = document.querySelector('.buton_sepet');

        bedenButonlar.forEach(function(button) {
            button.addEventListener('click', function() {
                bedenButonlar.forEach(function(btn) {
                    btn.classList.remove('clicked');
                    sepetButonu.innerText = "Sepete ekle";
                });
                this.classList.add('clicked');
                sepetButonu.disabled = false;
            });
        });

        sepetButonu.addEventListener('click', function() {
            var bedenSecildiMi = false;
            var secilenBeden = '';

            bedenButonlar.forEach(function(button) {
                if (button.classList.contains('clicked')) {
                    bedenSecildiMi = true;
                    secilenBeden = button.innerText;
                }
            });
            if (!bedenSecildiMi) {
                var sizeAlert = document.getElementById('size-alert');
                sizeAlert.style.display = 'block';
                setTimeout(function() {
                    sizeAlert.style.display = 'none';
                }, 1200);
                return;
            } else {

                sepetButonu.innerText = "Sepete eklendi";
                var customAlert = document.getElementById('custom-alert');
                customAlert.style.display = 'block';
                urun_kodu = document.getElementById('urun_kodu').innerText;
                addToCart(urun_kodu, secilenBeden);
                setTimeout(function() {
                    customAlert.style.display = 'none';
                }, 2200);
                return;
            }

        });


        function addToCart(urunKodu, secilenBeden) {
            $.ajax({
                type: "POST",
                url: "sepete_ekle.php",
                data: {
                    urun_kodu: urunKodu,
                    beden: secilenBeden
                },
                success: function(response) {
                    if (response == "success") {

                        console.log('Ürün başarıyla sepete eklendi');
                    }
                    else{
                        console.log('unsuccess');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ürün sepete eklenirken bir hata oluştu:', error);
                }
            });
        }
    });




    document.querySelector('.close-btn').addEventListener('click', function() {
        var customAlert = document.getElementById('custom-alert');
        customAlert.style.display = 'none';
    });


    document.querySelector('#go-to-cart').addEventListener('click', function() {
        window.location.href = 'sepet.php';
    });



    var TrandingSlider = new Swiper('.tranding-slider', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2.5,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });


    var kucukFotograflar = document.querySelectorAll('.kucuk-fotograf');

    // Her bir fotoğraf için tıklama olayını ekle
    kucukFotograflar.forEach(function(foto) {
        foto.addEventListener('click', function() {
            // Tıklanan fotoğrafın src özelliğini al
            var src = foto.getAttribute('src');
            // Büyük fotoğrafı seç ve src özelliğini değiştir
            var buyukFoto = document.querySelector('.card-img-top');
            buyukFoto.setAttribute('src', src);
        });
    });
</script>