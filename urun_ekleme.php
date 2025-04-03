<?php require_once("baglan.php");


if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_alt_kategori = "SELECT alt_kategori_id,alt_kategori_ad, kategori_id FROM alt_kategori WHERE kategori_id = ?";
    $stmt = $baglanti->prepare($sql_alt_kategori);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Alt kategorilerin seçeneklerini oluşturma
    echo '<option value="">Alt kategori seçiniz...</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['alt_kategori_id'] . '">' . $row['alt_kategori_ad'] . '</option>';
    }

    $stmt->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Masal Kids Admin Paneli</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Masal Butik</a>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Show notifications"><i class="bi bi-bell fs-5"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
                    <div class="app-notification__content">
                        <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><i class="bi bi-envelope fs-4 text-primary"></i></span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a></li>
                        <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><i class="bi bi-exclamation-triangle fs-4 text-warning"></i></span>
                                <div>
                                    <p class="app-notification__message">Mail server not working</p>
                                    <p class="app-notification__meta">5 min ago</p>
                                </div>
                            </a></li>

                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                </ul>
            </li>
            <li class="dropdown"><a class="app-nav__item" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    
    
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <div>
                <p class="app-sidebar__user-name">Buse Yıldız</p>
                <p class="app-sidebar__user-designation">Yönetici</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="admin.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Veriler</span></a></li>
            <li class="treeview"><a class="app-menu__item"  data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Siparişler</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon bi bi-circle-fill"></i> Gerçekleşen Siparişler</a></li>
                    <li><a class="treeview-item" href="https://icons.getbootstrap.com/" target="_blank" rel="noopener"><i class="icon bi bi-circle-fill"></i> Bekleyen Siparişler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item"  data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Ürün Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="urun_ekleme.php"><i class="icon bi bi-circle-fill"></i> Ürün Ekle</a></li>
                    <li><a class="treeview-item" href="urun_guncelle.php"><i class="icon bi bi-circle-fill"></i> Ürün Güncelle</a></li>
                    <li><a class="treeview-item" href="kategori_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kategoriler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item"  data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Site Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="table-basic.html"><i class="icon bi bi-circle-fill"></i> İsim-Logo</a></li>
                    <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Carousel Fotoğraf</a></li>
                    <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Renkler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item"  data-toggle="treeview"><i class="app-menu__icon bi bi-people"></i><span class="app-menu__label">Kullanıcı Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="kullanici_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kullanıcı Güncelle</a></li>>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-folder-plus"></i> Ürün Ekle</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Ürün Ekle</a></li>
            </ul>
        </div>
        <h2>Ürün Ekleme Formu</h2>

        <form id="form_urun_ekle" action="urun_olustur_p.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Ürün Adı:</label>
                <input type="text" id="productName" name="productName" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Ürün Fiyatı:</label>
                <input type="number" id="productPrice" name="productPrice" min="0" required>
            </div>
            <div class="form-group">
                <label for="productOldPrice">Ürün Eski Fiyatı: (Zorunlu değil)</label>
                <input type="number" id="productOldPrice" name="productOldPrice" min="0">
            </div>
            <!-- <div class="form-group">
                <label for="productColor">Ürün Rengi: (Tek renk girilmeli) </label>
                <input type="text" id="productColor" name="productColor" required>
            </div> -->
            <div class="form-group">
                <label for="productSize">Beden Seçimi: </label>
                <div class="row productSize">
                    <div>
                        <input type="checkBox" id="size_12ay" name="size_12ay" value="12-18 ay">
                        <label for="size_12ay">12-18 ay</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_18ay" name="size_18ay" value="18-24 ay">
                        <label for="size_18ay">18-24 ay</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_10" name="size_10" value="10-11 yaş">
                        <label for="size_10">10-11 yaş</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_11" name="size_11" value="11-12 yaş">
                        <label for="size_11">11-12 yaş</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_12" name="size_12" value="12-13 yaş">
                        <label for="size_12">12-13 yaş</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_13" name="size_13" value="13-14 yaş">
                        <label for="size_13">13-14 yaş</label>
                    </div>
                    <div>
                        <input type="checkBox" id="size_14" name="size_14" value="14-15 yaş">
                        <label for="size_14">14-15 yaş</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="productCount">Stok Sayısı</label>
                <input type="number" id="productCount" name="productCount" min="0" step="1" required>
            </div>

            <div class="form-group">
                <label for="productCategory">Kategori: </label>
                <select id="productCategory" name="productCategory" required>
                    <option value="">Kategori seçiniz...</option>
                    <?php
                    $sql_kategori = "SELECT kategori_id, kategori_ad FROM kategori";
                    $sql_kategoriler = $baglanti->query($sql_kategori);
                    while ($row = $sql_kategoriler->fetch_assoc()) {
                        echo "<option value='" . $row['kategori_id'] . "'>" . $row['kategori_ad'] . "</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="form-group">
                <label for="productSubCategory">Alt Kategori: </label>
                <select id="productSubCategory" name="productSubCategory" required>
                    <option value="">Alt kategori seçiniz...</option>


                </select>

            </div>
            <div class="form-group">
                <label for="productDescription">Ürün Açıklaması:</label>
                <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="productImage">Ürün Resmi:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="productOtherImages">Diğer Ürün Resimleri:</label>
                <input type="file" id="productOtherImages" name="productOtherImages[]"  accept="image/*" multiple>
                <p id="yaz"></p>
            </div>



            <button type="submit">Ürün Ekle</button>
        </form>

    </main>
    <script>
        document.getElementById('productCategory').addEventListener('change', function() {
            var categoryId = this.value;
            var currentUrl = 'urun_ekleme.php?category_id=' + categoryId;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        var subCategorySelect = document.getElementById('productSubCategory');
                        subCategorySelect.innerHTML = xhr.responseText;
                    } else {
                        console.log('Sunucudan veri alınamadı.');
                    }
                }
            };
            xhr.open('GET', currentUrl, true);
            xhr.send();
        });


        document.addEventListener("DOMContentLoaded", function() {
            var fileInput = document.getElementById("productOtherImages");

            fileInput.addEventListener("change", function(event) {
                var files = event.target.files;

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var yaz = document.getElementById("yaz");
                    yaz.innerHTML += '<p id="' + file.name + '">' + file.name + ' <i class="bi bi-house-door" onclick="removeFile(this)"></i></p>';

                }
            });
        });

        function removeFile(element) {
            var parentElement = element.parentElement;
            parentElement.remove();
        }
        $(document).ready(function() {

            $("#form_urun_ekle").submit(function(event) {

                event.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: "urun_olustur_p.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response === 'success') {
                            window.location.href = "urun_ekleme.php";
                        } else if (response === 'unsuccess') {
                            window.location.href = "urun_ekleme.php";
                        } else {
                            window.location.href = "urun_ekleme.php";
                        }
                    },
                    error: function(error) {
                        window.location.href = "urun_ekleme.php";
                    }
                });
            });
        });
    </script>
    <script src="js/admin.js"></script>

</body>

</html>

<style>

    h2 {
        text-align: center;
    }
</style>