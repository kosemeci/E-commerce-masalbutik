<?php require_once("baglan.php"); ?>

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
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Show notifications"><i class="bi bi-bell fs-5"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">You have 4 new notifications.</li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><i class="bi bi-envelope fs-4 text-primary"></i></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><i class="bi bi-exclamation-triangle fs-4 text-warning"></i></span>
                  <div>
                    <p class="app-notification__message">Mail server not working</p>
                    <p class="app-notification__meta">5 min ago</p>
                  </div></a></li>
              
            </div>
            <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Profile</a></li>
            <li><a class="dropdown-item" onclick="logout()"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
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
            <li><a class="treeview-item" href="kategori_guncelle.php"><i class="icon bi bi-circle-fill"></i> Kategori Ekle/Çıkar</a></li>
        </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Site Ayarları</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="table-basic.html"><i class="icon bi bi-circle-fill"></i> İsim-Logo</a></li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Carousel Fotoğraf</a></li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Renkler</a></li>
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
          <h1><i class="bi bi-speedometer"></i> İstatistik</h1>
          <p>Sayılarla Masal Butik..</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">İstatistik</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon bi bi-people fs-1"></i>
            <div class="info">
              <h4>Kullanıcı Sayısı</h4>
              <p><b>5</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon bi-clipboard-data fs-1"></i>
            <div class="info">
              <h4>Aktif Ürün Sayısı</h4>
              <p><b>25</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small success coloured-icon"><i class="icon bi bi-bag-check fs-1"></i>
            <div class="info">
              <h4>Gerçekleşen Sipariş </h4>
              <p><b>10</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon bi bi-cart fs-1"></i>
            <div class="info">
              <h4>Bekleyen Sipariş </h4>
              <p><b>10</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon bi bi-database fs-1"></i>
            <div class="info">
              <h4>Toplam Stok </h4>
              <p><b>500</b></p>
            </div>
          </div>
        </div>
      </div>
      
    </main>
    <script src="js/admin.js"></script>

    
  </body>
</html>