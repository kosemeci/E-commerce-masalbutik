<?php require_once("baglan.php");
session_start();
$user_id = $_SESSION['user_id'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masal Kids Butik</title>
    <link rel="icon" href="img/logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/sepet.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="js/index.js"></script>
</head>

<body>

    <?php require_once("navbar.php") ?>

    <div class="sepet">
        <h2 class="sepetiniz">Sepetiniz</h2>
        <div id="sepet-icerik">
            <?php
            $sql = "SELECT urun_kodu, urun_beden, adet, durum FROM sepet WHERE kullanici_id = $user_id";
            $result = $baglanti->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $urun_kodu = $row["urun_kodu"];
                    $urun_query = "SELECT urun_baslik, ana_resim, urun_fiyati FROM urun WHERE urun_kodu = '$urun_kodu'";
                    $urun_result = $baglanti->query($urun_query);

                    if ($urun_result->num_rows > 0) {
                        $urun_row = $urun_result->fetch_assoc();
                        $urun_baslik = $urun_row["urun_baslik"];
                        $urun_beden = $row["urun_beden"];
                        $urun_fiyati = $urun_row["urun_fiyati"];
                        $ana_resim = $urun_row["ana_resim"];
                        $urun_adet = $row['adet'];
            ?>
                        <div class="urun">
                            <img src="<?php echo $ana_resim; ?>" alt="<?php echo $urun_baslik; ?>" class="urun-resim">
                            <div class="urun-aciklama">
                                <h3><?php echo $urun_baslik; ?></h3>
                                <p>Beden: <?php echo $urun_beden; ?></p>
                                <p>Fiyat: <?php echo $urun_fiyati; ?> TL</p>
                            </div>
                            <div class="urun-adet">
                                <input type="number" value="<?php echo $urun_adet; ?>" min="1">
                                <button class="urun-sil" data-urun-kodu="<?php echo $urun_kodu; ?>">Sil</button>
                            </div>
                        </div>
            <?php
                    } else {
                        echo "Ürün bulunamadı.";
                    }
                }
            } else {
                echo "Sepette herhangi bir ürün bulunamadı.";
            }
            ?>

        </div>
        <div class="sepet_onay">
            <div class="alisverise-devam">
                <button id="alisverise-devam-et">Alışverişe Devam Et</button>
            </div>
            <div id="toplam-tutar">
                Toplam Tutar: <span id="toplam-tutar-miktarı"></span>
            </div>
            <div class="indirim-kuponu">
                <input type="text" id="indirim-kodu" placeholder="İndirim Kodu Girin">
                <button id="indirim-uygula">Uygula</button>
            </div>
            <button id="sepeti-onayla">Sepeti Onayla</button>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php require_once('footer.php') ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Silme butonuna tıklandığında ürünü sil ve toplam tutarı güncelle
        $('.urun-sil').click(function() {
            var urunKodu = $(this).data('urun-kodu');
            var urunDiv = $(this).closest('.urun');

            // AJAX isteği gönder
            $.ajax({
                type: "POST",
                url: "sepet_sil.php",
                data: {
                    urun_kodu: urunKodu
                },
                success: function(response) {
                    if (response == "success") {
                        urunDiv.remove();
                        hesaplaVeGoster();
                    } else {
                        alert("Ürünü silerken bir hata oluştu.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });



        // Sayfa yüklendiğinde toplam tutarı hesapla ve göster
        hesaplaVeGoster();

        // Her bir ürün adedinde değişiklik olduğunda toplam tutarı güncelle
        $('.urun-adet input').change(function() {
            var urunKodu = $(this).closest('.urun').find('.urun-sil').data('urun-kodu');
            var urunBeden = $(this).closest('.urun').find('.urun-aciklama p:nth-child(2)').text().replace('Beden: ', '');
            var yeniAdet = $(this).val();


            $.ajax({
                type: "POST",
                url: "sepete_ekle.php",
                data: {
                    urun_kodu: urunKodu,
                    beden: urunBeden,
                    adet: yeniAdet
                },
                success: function(response) {
                    if (response == "success") {
                        hesaplaVeGoster();
                    } else {
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Sepeti onayla butonuna tıklandığında işlemi tamamla
        $('#sepeti-onayla').click(function() {
            var sepetTutari = document.getElementById("toplam-tutar-miktarı").innerText;

            // POST isteği için bir form oluştur
            var form = $('<form action="sepet_onayla.php" method="post">' +
                '<input type="hidden" name="sepet_tutari" value="' + sepetTutari + '">' +
                '</form>');

            // Formu sayfaya ekleyip otomatik olarak gönder
            $('body').append(form);
            form.submit();
        });

        // Toplam tutarı hesaplayıp gösteren fonksiyon
        function hesaplaVeGoster() {
            var toplam = 0;

            // Her bir ürün için fiyatı ve adedi alıp toplama ekle
            $('.urun').each(function() {
                var fiyat = parseFloat($(this).find('.urun-aciklama p:nth-child(3)').text().replace('Fiyat: ', '').replace('₺', '').replace('$', ''));
                var adet = parseInt($(this).find('.urun-adet input').val());
                toplam += fiyat * adet;
            });

            $('#toplam-tutar-miktarı').text(toplam.toFixed(2) + ' TL');
        }
    });


    document.getElementById("alisverise-devam-et").addEventListener("click", function() {
        window.location.href = "index.php";
    });
</script>