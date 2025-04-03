<?php require_once("baglan.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet Tutarı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        h1 {
            color: #333;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }

        .address-box {
            border: 3px solid #ccc;
            /* Kalın border */
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
        }

        .address-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type=submit] {
            background-color: #333;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .address-box:hover {
            border-color: #7bed9f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Adres Tercihi</h1>
        <?php
        session_start();
        $user_id = $_SESSION['user_id'];
        $user = $_SESSION['isim'];


        if (isset($_POST['sepet_tutari'])) {
            $sepet_tutari = $_POST['sepet_tutari'];
            echo "<div class='result'>Merhaba $user ! <br> <br> Sepet tutarınız: $sepet_tutari <br> </div>";
        } else {
            echo "<div class='result'>Sepet tutarı bulunamadı.</div>";
        }
        $sql = "SELECT il, baslik FROM adres WHERE k_id = $user_id";
        $result = $baglanti->query($sql);

        if ($result->num_rows > 0) {
            echo '<div id="addressContainer">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="address-box" onclick="selectAddress(this)">';
                echo '<div class="address-title">' . $row["baslik"] . '</div>';
                echo '<div>' . $row["il"] . '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "Hiç adres bulunamadı.";
        }
        ?>

        <input class="add-address-button" type="submit" value="Yeni Adres Ekle">
        <button id="continueToPaymentButton" type="button" onclick="continueToPayment()">Ödemeye Devam Et</button>

        <div id="newAddressForm" style="display: none;margin-top:20%">
            <h2>Yeni Adres Ekle</h2>
            <form id="addAddressForm">

                <label for="baslik">Adres Başlığı:</label>
                <input type="text" id="baslik" name="baslik" required><br>

                <label for="il">İl:</label>
                <input type="text" id="il" name="il" required><br>

                <label for="ilce">İlçe:</label>
                <input type="text" id="ilce" name="ilce" required><br>

                <label for="sokak">Sokak:</label>
                <input type="text" id="sokak" name="sokak" required><br>

                <label for="no">No:</label>
                <input type="text" id="no" name="no"><br>

                <label for="daire">Daire:</label>
                <input type="text" id="daire" name="daire"><br>

                <label for="adresTarifi">Adres Tarifi:</label>
                <textarea id="adresTarifi" name="adresTarifi"></textarea><br>

                <button type="button" onclick="saveAddress()">Kaydet</button>
            </form>
        </div>
    </div>

    <script>
        const addAddressButton = document.querySelector(".add-address-button");
        if (addAddressButton) {
            addAddressButton.addEventListener("click", function() {
                addNewAddress();
            });
        }

        function addNewAddress() {
            document.getElementById('newAddressForm').style.display = 'block';
        }

        function selectAddress(element) {

            var addressBoxes = document.getElementsByClassName('address-box');
            for (var i = 0; i < addressBoxes.length; i++) {
                addressBoxes[i].style.borderColor = '#ccc';
            }

            element.style.borderColor = '#7bed9f';
        }

        function saveAddress() {
            var baslik = document.getElementById('baslik').value;
            var il = document.getElementById('il').value;
            var ilce = document.getElementById('ilce').value;
            var sokak = document.getElementById('sokak').value;
            var no = document.getElementById('no').value;
            var daire = document.getElementById('daire').value;
            var adresTarifi = document.getElementById('adresTarifi').value;

            // AJAX isteği oluşturma
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "adres_ekle.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // İsteğin tamamlanması durumunda gerçekleştirilecek işlemler
                    console.log(xhr.responseText); // Sunucudan gelen yanıtı konsola yazdırma
                    updateAddressList(baslik, il, ilce);
                }
            };

            var data = "baslik=" + encodeURIComponent(baslik) +
                "&il=" + encodeURIComponent(il) +
                "&ilce=" + encodeURIComponent(ilce) +
                "&sokak=" + encodeURIComponent(sokak) +
                "&no=" + encodeURIComponent(no) +
                "&daire=" + encodeURIComponent(daire) +
                "&adresTarifi=" + encodeURIComponent(adresTarifi);

            xhr.send(data);
            document.getElementById('newAddressForm').style.display = 'none';

        }

        function updateAddressList(baslik, il, ilce) {
            // Yeni adres bilgilerini içeren HTML oluşturma
            var newAddressHTML = '<div class="address-box" onclick="selectAddress(this)">';
            newAddressHTML += '<div class="address-title">' + baslik + '</div>';
            newAddressHTML += '<div>' + ilce + ' / ' + il + '</div>';
            newAddressHTML += '</div>';

            // Yeni adresi adres listesine ekleyerek güncelleme
            var addressContainer = document.getElementById('addressContainer');
            addressContainer.innerHTML += newAddressHTML;
        }

        function continueToPayment() {
            // Seçilen adresin bilgilerini al
            var selectedAddress = document.querySelector('.address-box[style*="border-color: rgb(123, 237, 159)"]');
            if (selectedAddress) {
                var addressTitle = selectedAddress.querySelector('.address-title').innerText;
                var addressDetails = selectedAddress.lastElementChild.innerText;

                // Sepet tutarını al
                var sepetTutari = "<?php echo $sepet_tutari; ?>";

                // AJAX isteği oluşturma
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "odeme.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // İsteğin tamamlanması durumunda gerçekleştirilecek işlemler
                        console.log(xhr.responseText); // Sunucudan gelen yanıtı konsola yazdırma
                        // Ödeme sayfasına yönlendirme ya da gereken işlemleri yapma
                        // Örnek olarak:
                        // window.location.href = "odeme.php";
                    }
                };

                var data = "addressTitle=" + encodeURIComponent(addressTitle) +
                    "&addressDetails=" + encodeURIComponent(addressDetails) +
                    "&sepetTutari=" + encodeURIComponent(sepetTutari);

                xhr.send(data);
            } else {
                alert("Lütfen bir adres seçiniz.");
            }
        }
    </script>
</body>

</html>

<style>
    #addAddressForm label {
        display: block;
        margin-bottom: 5px;
        text-align: start !important;

    }

    #addAddressForm input[type="text"],
    #addAddressForm textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #addAddressForm button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
    }

    #addAddressForm button:hover {
        background-color: #0056b3;
    }

    #continueToPaymentButton {
        float: inline-end;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
</style>