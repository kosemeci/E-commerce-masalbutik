<?php require_once("baglan.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masal Butik</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


    <div class="navbar-ust pc-navbar">
        <div class="logo"><a href="index.php">Masal Butik <img src="img/logo/logo.png" alt="masal-butik" width="85px" height="55px"></a></div>
        <input type="text" class="search-bar" placeholder="Ürün ara...">
        <a href="https://api.whatsapp.com/send/?phone=905380209916&text&app_absent=0" target="_blank" rel="nofollow noopener" class="wp-icon">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <!-- <i class="like-icon fa-regular fa-heart" onclick="likeProduct()"></i> -->
        <i class="sepet-icon fa-solid fa-basket-shopping" onclick="<?php if ($user_id == 0) { echo 'login()'; } else { echo 'addToCart()'; } ?>"></i>
        <div class="dropdown">
            <i id="userr-icon" class="userr-icon fa-regular fa-user"></i>
            <div class="dropdown-content-giris" id="myDropdown">
                <?php if (isset($_SESSION['username'])) { ?>
                    <a href="settings.php">Hesap Ayarları</a>
                    <a href="my_likes.php">Beğenildi</a>
                    <a href="orders.php">Siparişlerim</a>
                    <a href="addresses.php">Kayıtlı Adreslerim</a>
                    <a href="payment_methods.php">Ödeme Yöntemlerim</a>
                    <button onclick="logout()">Çıkış yap</button>
                <?php } else { ?>
                    
                    <a href="giris.php">Giriş Yap</a>
                    <a href="register.php">Kayıt Ol</a>
                <?php } ?>
            </div>
        </div>

    </div>

    <div class="navbar-ust mobil-navbar">
        <div class="row">

            <div class="logo"> <a href="index.php">Masal Butik</a> </div>
            <i class="sepet-icon fa-solid fa-basket-shopping" onclick="addToCart()"></i>
            <i id="user-icon" class="user-icon fa-regular fa-user" onclick="login()"></i>

        </div>
        <div class="row mobil-search mt-2">
            <col-3><img src="img/logo/logo.png" alt="" width="85px" height="50px"></col-3>
            <col-9><input type="text" class="search-bar" placeholder="Ürün ara..."></col-9>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send/?phone=905380209916&text&app_absent=0" target="_blank" rel="nofollow noopener" class="fix-wp-icon">
        <i class="fa-brands fa-whatsapp"></i>
    </a>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>

<script>
    function logout() {
        // AJAX kullanarak oturumu sonlandır
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "logout.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.location.href = "index.php"; // Çıkış yapıldıktan sonra yönlendirilecek sayfa
            }
        };
        xhr.send();
    }

    function addToCart() {
        window.location.href = "sepet.php"; // Çıkış yapıldıktan sonra yönlendirilecek sayfa
    }
</script>