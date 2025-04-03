<?php require_once("baglan.php");


if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_alt_kategori = "SELECT alt_kategori_id,alt_kategori_ad, kategori_id FROM alt_kategori WHERE kategori_id = ?";
    $stmt = $baglanti->prepare($sql_alt_kategori);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count=0;
    echo '<option value="">Alt kategori seçiniz...</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $count . '">' . $row['alt_kategori_ad'] . '</option>';
        $count++;
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
                    <li><a class="treeview-item" href="urun_guncelle.php"><i class="icon bi bi-circle-fill"></i> Ürün Güncelle</a></li>
                    <li><a class="treeview-item" href="kategori_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kategoriler</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Site Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="table-basic.html"><i class="icon bi bi-circle-fill"></i> İsim-Logo</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-people"></i><span class="app-menu__label">Kullanıcı Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="blank-page.html"><i class="icon bi bi-circle-fill"></i> Kullanıcı Güncelle</a></li>>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-folder-plus"></i> Kategori Ekle/Güncelle</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Kategori Ekle/Güncelle</a></li>
            </ul>
        </div>
        <div class="category-list">
            <h3>Mevcut Kategoriler</h3>
            <?php
            $query = "SELECT kategori_ad FROM kategori";
            $result = mysqli_query($baglanti, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . $row["kategori_ad"] . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>

        <div class="subcategory-list">
            <h3>Mevcut Alt Kategoriler</h3>
            <?php
            $query_kategori = "SELECT alt_kategori.alt_kategori_ad, kategori.kategori_ad 
            FROM alt_kategori 
            JOIN kategori ON alt_kategori.kategori_id = kategori.kategori_id
            ORDER BY kategori.kategori_ad ASC";
            $result_kategori = mysqli_query($baglanti, $query_kategori);

            if (mysqli_num_rows($result_kategori) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result_kategori)) {
                    echo "<li>" . $row["kategori_ad"] . " - " . $row["alt_kategori_ad"] . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
        <div class="category-container">
            <div class="category-form">
                <h3>Kategori Ekle</h3>
                <form method="POST" action="kategori_ekle_p.php">
                    <input type="text" name="new_category" placeholder="Yeni Kategori Adı">
                    <button type="submit">Ekle</button>
                </form>
            </div>

            <div class="category-form">
                <h3>Kategori Güncelle</h3>
                <form method="POST" action="kategori_degistir_p.php">
                    <select name="existing_category">
                        <?php
                        $query = "SELECT kategori_ad FROM kategori";
                        $result = mysqli_query($baglanti, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["kategori_ad"] . "'>" . $row["kategori_ad"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="text" name="updated_category" placeholder="Yeni Adı">
                    <button type="submit">Güncelle</button>
                </form>
            </div>

        </div>
        <div class="category-container">
            <div class="category-form">
                <h3>Alt Kategori Ekle</h3>
                <form method="POST" action="kategori_alt_ekle_p.php">
                    <select name="existing_category">
                        <option value="">Kategori seçiniz...</option>
                        <?php
                        $query = "SELECT kategori_id,kategori_ad FROM kategori";
                        $result = mysqli_query($baglanti, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["kategori_id"] . "'>" . $row["kategori_ad"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="text" name="new_sub_category" placeholder="Yeni Alt Kategori Adı">
                    <button type="submit">Ekle</button>
                </form>
            </div>

            <div class="category-form">
                <h3>Alt Kategori Güncelle</h3>
                <form method="POST" action="kategori_alt_degistir_p.php">
                    <select id="productUptCategory" name="productUptCategory" required>
                        <option value="">Kategori seçiniz...</option>
                        <?php
                        $sql_kategori = "SELECT kategori_id, kategori_ad FROM kategori";
                        $sql_kategoriler = $baglanti->query($sql_kategori);
                        while ($row = $sql_kategoriler->fetch_assoc()) {
                            echo "<option value='" . $row['kategori_id'] . "'>" . $row['kategori_ad'] . "</option>";
                        }
                        ?>
                    </select>
                    <select id="productUpSubCategory" name="productUpSubCategory">
                        <option value="">Alt kategori seçiniz...</option>
                    </select>
                    <input type="text" name="updated_sub_category" placeholder="Yeni Adı">
                    <button type="submit">Güncelle</button>
                </form>
            </div>
        </div>



    </main>

    <script src="js/admin.js"></script>

</body>

</html>
