<?php require_once("baglan.php");


if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_alt_kategori = "SELECT alt_kategori_ad, kategori_id FROM alt_kategori WHERE kategori_id = ?";
    $stmt = $baglanti->prepare($sql_alt_kategori);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Alt kategorilerin seçeneklerini oluşturma
    echo '<option value="">Alt kategori seçiniz...</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['kategori_id'] . '">' . $row['alt_kategori_ad'] . '</option>';
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

</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Masal Butik</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
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
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <div>
                <p class="app-sidebar__user-name">Buse Yıldız</p>
                <p class="app-sidebar__user-designation">Yönetici</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="admin.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Veriler</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Siparişler</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon bi bi-circle-fill"></i> Gerçekleşen Siparişler</a></li>
                    <li><a class="treeview-item" href="https://icons.getbootstrap.com/" target="_blank" rel="noopener"><i class="icon bi bi-circle-fill"></i> Bekleyen Siparişler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Ürün Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="urun_ekleme.php"><i class="icon bi bi-circle-fill"></i> Ürün Ekle</a></li>
                    <li><a class="treeview-item" href="urun_guncelle"><i class="icon bi bi-circle-fill"></i> Ürün Güncelle</a></li>
                    <li><a class="treeview-item" href="kategori_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kategoriler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Site Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="isim_logo.php"><i class="icon bi bi-circle-fill"></i> İsim-Logo</a></li>
                    <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Carousel Fotoğraf</a></li>
                    <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Renkler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-people"></i><span class="app-menu__label">Kullanıcı Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="kisi_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kullanıcı Güncelle</a></li>>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-folder-plus"></i> Sipariş Detayı</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Sipariş Detayı</a></li>
            </ul>
        </div>
        <h2>Sipariş Formu</h2>
        <div class="search-container" >
        <input type="text" id="searchOrder" placeholder="Mail, tel no yada sipariş kodu girin...">        
            <button type="button" onclick="searchOrder()">Ara</button>
        </div>
        <form>
            <table>
                <tr>
                    <td>Sipariş kodu:</td>
                    <td><textarea name="siparis_kodu" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Ad-Soyad:</td>
                    <td><textarea name="ad_soyad" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Telefon No:</td>
                    <td><textarea name="telefon_no" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Mail:</td>
                    <td><textarea name="mail" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td><textarea name="adres" rows="3" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Ürün Kodu</td>
                    <td><textarea name="urun_kodu" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Sipariş Tarihi</td>
                    <td><textarea name="siparis_tarihi" rows="1" readonly></textarea></td>
                </tr>
                <tr>
                    <td>Sipariş Tutarı</td>
                    <td><textarea name="siparis_tutari" rows="1" readonly></textarea></td>
                </tr>
            </table>
            <div style="text-align: center;">
                <button type="submit">Güncelle</button>
            </div>
            <hr>
        </form>





    </main>

    <script src="js/admin.js"></script>

</body>

</html>

<style>
    @media  (max-width:998px) {
    .search-container input[type=text] {
        padding: 5px !important;
        width: 65% !important;
    }
    }
    .search-container {
        text-align: center;
        margin-bottom: 20px;
        margin-top: 20px;

    }

    .search-container input[type=text] {
        padding: 10px;
        width: 40%;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        float: left;
    }

    .search-container button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: left;
    }

    .search-container button:hover {
        background: #45a049;
    }


    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    h2 {
        text-align: center;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
    }

    table td {
        padding: 10px;
    }

    input[type="text"],
    input[type="number"],
    select {
        width: calc(100% - 20px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>