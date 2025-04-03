<?php require_once("baglan.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Sayfası</title>
</head>

<body>

  <?php require_once("navbar.php"); ?>

  <div class="container profilim">
    <div class="sidebar">
      <div class="profile-links">
        <a class="active" data-target="settings">Hesap Ayarları</a>
        <a data-target="my_like">Beğenildi</a>
        <a data-target="orders">Siparişlerim</a>
        <a data-target="addresses">Kayıtlı Adreslerim</a>
        <a data-target="payment_methods">Ödeme Yöntemlerim</a>
        <a onclick="logout()">Çıkış Yap</a>
      </div>
    </div>
    <div class="content">
      <div class="settings" style="display: block;">
        <h2>Hesap Ayarları</h2>
        <form id="accountSettingsForm">
          <label for="fullName">Ad Soyad:</label>
          <input type="text" id="fullName" name="fullName" readonly><br>

          <label for="email">E-posta:</label>
          <input type="email" id="email" name="email" readonly><br>

          <label for="phone">Telefon Numarası:</label>
          <input type="tel" id="phone" name="phone" readonly><br>

          <label for="accountStatus">Hesap Durumu:</label>
          <input type="text" id="accountStatus" name="accountStatus" readonly><br>

          <div class="button-container">
            <button id="sendCode" type="button" onclick="sendVerificationCode()">Onay Kodu Gönder</button><br>
            <button id="changePassword" type="button" onclick="changePassword()">Şifre Değiştir</button>
          </div>
        </form>
      </div>

      <div class="my_like" style="display: none;">
        <h2>Beğeni Ayarları</h2>
        <div class="product-container">
          <div class="product-row">
            <div class="product">
              <img src="img/e4.jpeg" alt="Ürün 1">
              <h3>Ürün Adı 1</h3>
              <p>Fiyat: $XX.XX</p>
            </div>
            <div class="product">
              <img src="img/e6.jpeg" alt="Ürün 2">
              <h3>Ürün Adı 2</h3>
              <p>Fiyat: $XX.XX</p>
            </div>
            <div class="product">
              <img src="img/e6.jpeg" alt="Ürün 2">
              <h3>Ürün Adı 2</h3>
              <p>Fiyat: $XX.XX</p>
            </div>
            <div class="product">
              <img src="img/e6.jpeg" alt="Ürün 2">
              <h3>Ürün Adı 2</h3>
              <p>Fiyat: $XX.XX</p>
            </div>
            <div class="product">
              <img src="img/e6.jpeg" alt="Ürün 2">
              <h3>Ürün Adı 2</h3>
              <p>Fiyat: $XX.XX</p>
            </div>
          </div>
        </div>
      </div>
      <div class="addresses" style="display: none;">
        <h2>Kayıtlı Adreslerim</h2>
        <div class="address-list" id="addressList">
          <div class="address">
            <h3>Yurt Adresim</h3>
            <p>İl: İstanbul</p>
            <p>İlçe: Kadıköy</p>
            <p>Sokak: Örnek Sokak</p>
            <p>No: 10</p>
            <p>Daire: 5</p>
            <p>Adres Tarifi: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis at facere dolores rem quo. </p>
            <button class="edit-button" onclick="editAddress(this)">
              <i class="fas fa-edit"></i>
            </button>
            <button class="remove-button" onclick="removeCard(this)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
          <div class="address">
            <h3>Ev Adresim</h3>
            <p>İl: Ankara</p>
            <p>İlçe: Çankaya</p>
            <p>Sokak: Söğütlü Çeşme Sokak Caddesi</p>
            <p>No: 10</p>
            <p>Daire: 5</p>
            <p>Adres Tarifi: Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sit vitae magni. </p>
            <button class="edit-button" onclick="editAddress(this)">
              <i class="fas fa-edit"></i>
            </button>
            <button class="remove-button" onclick="removeCard(this)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
          <div class="address">
            <h3>Ev Adresim</h3>
            <p>İl: Ankara</p>
            <p>İlçe: Çankaya</p>
            <p>Sokak: Söğütlü Çeşme Sokak Caddesi</p>
            <p>No: 10</p>
            <p>Daire: 5</p>
            <p>Adres Tarifi: Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, similique. </p>
            <button class="edit-button" onclick="editAddress(this)">
              <i class="fas fa-edit"></i>
            </button>
            <button class="remove-button" onclick="removeCard(this)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>

        <button class="add-address-button">Adres Ekle</button>

      </div>
      <div id="newAddressForm" style="display: none;">
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

      <div class="payment_methods" style="display: none;">
        <h2>Ödeme Yöntemlerim</h2>
        <div class="payment-list">
          <div class="payment-card">
            <h3>Ziraat Kartım</h3>
            <p>Ad Soyad: İsim Soyisim</p>
            <p>Kart Numarası: **** **** **** 1234</p>
            <p>Son Kullanma Tarihi: 12/24</p>
            <button class="remove-button" onclick="removeCard(this)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
          <div class="payment-card">
            <h3>Kişisel Kartım</h3>
            <p>Ad Soyad: İsim Soyisim</p>
            <p>Kart Numarası: **** **** **** 5678</p>
            <p>Son Kullanma Tarihi: 06/25</p>
            <button class="remove-button" onclick="removeCard(this)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>
        <button class="add-payment-button">Kart Ekle</button>
      </div>

      <div class="orders" style="display: none;">
        <h2>Siparişlerim</h2>
        <div class="order-table">
          <table>
            <thead>
              <tr>
                <th>Sipariş No</th>
                <th>Sipariş Tarihi</th>
                <th>Sepet Tutarı</th>
                <th>Durum</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>123456</td>
                <td>2024-03-26</td>
                <td>450.00 TL</td>
                <td>Teslim Edildi</td>
              </tr>
              <!-- Buraya diğer siparişlerin bilgilerini ekleyebilirsiniz -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="logout" style="display: none;">
        <h2>Çıkış Yap</h2>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
  }

  /* Container Layout */
  .container {
    display: flex;
    margin: 80px auto;
    /* Add margin for better positioning */
    max-width: 1024px;
    /* Set a maximum width for responsiveness */
  }

  @media screen and (min-width: 768px) and (max-width: 998px) {
    .container {
      margin: 80px 2%;
      /* Margin 8% olacak */
    }
  }

  .order-table {
    margin-top: 20px;
  }

  .order-table table {
    width: 100%;
    border-collapse: collapse;
  }

  .order-table th,
  .order-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .order-table th {
    background-color: #f2f2f2;
  }

  .order-table tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .order-table tr:hover {
    background-color: #f2f2f2;
  }

  /* Sidebar Styling */
  .sidebar {
    width: 200px;
    background-color: #f4f4f4;
    margin-right: 20px;
  }

  .profile-links {
    list-style: none;
    /* Remove default bullet points */
    padding: 0;
  }

  .profile-links a {
    display: block;
    padding: 10px 15px;
    /* Consistent padding for boxy feel */
    margin-bottom: 5px;
    /* Add spacing between links */
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    /* Add subtle boxy effect */
    background-color: #f0f0f0;
    /* Lighter background for distinction */
    transition: background-color 0.2s ease-in-out;
    cursor: pointer;
  }

  .profile-links a.active {
    font-weight: bold;
    background-color: #ddd;
    /* Highlight active link */
  }

  .profile-links a:hover {
    background-color: #ccc;
    /* Adjust hover color for feedback */
  }

  /* Content Area Styling */
  .content {
    flex: 1;
    margin-left: 20px;
  }

  .product-container {
    display: flex;
    flex-wrap: wrap;
  }

  .product-row {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    justify-content: start;
    margin-top: 20px;

  }

  .product {
    width: 23%;
    /* Dört ürünü yan yana göstermek için genişliği ayarlayın */
    margin-right: 15px;
    /* Ürünler arası boşluk */
    margin-bottom: 30px;
    /* Satırlar arası boşluk */
    min-width: 150px;
  }


  .product img {
    width: 100%;
    height: auto;
    border-radius: 5px;
  }

  .product h3 {
    margin-top: 10px;
  }

  .product p {
    font-size: 14px;
    color: #666;
  }


  .addresses,
  .orders,
  .my_like,
  .payment_methods,
  .settings {
    margin-top: 20px;
  }

  .address-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 20px;
    margin-top: 20px;
  }

  .address {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .address h3 {
    margin-bottom: 10px;
  }

  .add-address-button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .add-address-button:hover {
    background-color: #0056b3;
  }

  #newAddressForm {
    display: none;
    /* Başlangıçta formu gizle */
  }

  #newAddressForm h2 {
    margin-bottom: 20px;
  }

  #addAddressForm label {
    display: block;
    margin-bottom: 5px;
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


  .payment_methods {
    margin-top: 20px;
  }

  .payment-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 20px;
    margin-top: 20px;
  }

  .payment-card {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .payment-card h3 {
    margin-bottom: 10px;
  }

  .add-payment-button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .add-payment-button:hover {
    background-color: #0056b3;
  }

  #accountSettingsForm {
    margin-top: 20px;
  }

  #accountSettingsForm label {
    display: block;
    margin-bottom: 5px;
  }

  #accountSettingsForm input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  #accountSettingsForm {
    margin-top: 20px;
  }

  #accountSettingsForm button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
    display: inline-block;
  }

  .button-container {
    text-align: right;
    /* Butonları sağa yasla */
  }

  #accountSettingsForm button:hover {
    background-color: #0056b3;
  }

  .remove-button {
    background: none;
    border: none;
    cursor: pointer;
    color: #f00;
    padding: 0;
    float: right;
  }

  .edit-button {
    background: none;
    border: none;
    cursor: pointer;
    color: #0f0;
    padding: 0;

  }

  .address-list input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
</style>

<script>
  const addAddressButton = document.querySelector(".add-address-button");
  if (addAddressButton) {
    addAddressButton.addEventListener("click", function() {
      addNewAddress();
    });
  }

  function addNewAddress() {
    // Kayıtlı adresler listesi gizlenir
    document.getElementById('addressList').style.display = 'none';
    // Yeni adres ekleme formu gösterilir
    document.getElementById('newAddressForm').style.display = 'block';
  }

  function saveAddress() {
    // Formdan bilgiler alınır
    var il = document.getElementById('il').value;
    var ilce = document.getElementById('ilce').value;
    var sokak = document.getElementById('sokak').value;
    var no = document.getElementById('no').value;
    var daire = document.getElementById('daire').value;
    var adresTarifi = document.getElementById('adresTarifi').value;

    // Yeni adres kartı oluşturulur
    var newAddressCard = document.createElement('div');
    newAddressCard.classList.add('address');

    // Adres bilgileri kart içine eklenir
    newAddressCard.innerHTML = `
    <h3>Yeni Adres</h3>
    <p>İl: ${il}</p>
    <p>İlçe: ${ilce}</p>
    <p>Sokak: ${sokak}</p>
    <p>No: ${no}</p>
    <p>Daire: ${daire}</p>
    <p>Adres Tarifi: ${adresTarifi}</p>
    <button class="edit-button" onclick="editAddress(this)">
      <i class="fas fa-edit"></i>
    </button>
    <button class="remove-button" onclick="removeCard(this)">
      <i class="fas fa-trash-alt"></i>
    </button>
  `;

    // Yeni adres kartı adres listesine eklenir
    document.getElementById('addressList').appendChild(newAddressCard);

    // Yeni adres ekleme formu gizlenir
    document.getElementById('newAddressForm').style.display = 'none';
    document.getElementById('addressList').style.display = 'grid';
  }

  document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll(".profile-links a");
    const contentSections = document.querySelectorAll(".content > div");

    links.forEach((link, index) => {
      link.addEventListener("click", function(e) {
        e.preventDefault();
        const target = link.getAttribute("data-target");
        switchContent(target);
      });
    });

    function switchContent(target) {
      contentSections.forEach((section) => {
        section.classList.remove("active");
        section.style.display = "none";

      });
      const contentSection = document.querySelector("." + target);
      contentSection.classList.add("active");
      contentSection.style.display = "block";

    }
  });

  function sendVerificationCode() {
    // Burada onay kodu gönderme işlemleri gerçekleştirilir
    alert("Onay kodu gönderildi!"); // Örnek: Onay kodu gönderildiğine dair bir mesaj göster
  }

  function changePassword() {
    // Burada şifre değiştirme işlemleri gerçekleştirilir
    alert("Şifreniz başarıyla değiştirildi!"); // Örnek: Şifrenin değiştirildiğine dair bir mesaj göster
  }


  function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        window.location.href = "index.php"; // Çıkış yapıldıktan sonra yönlendirilecek sayfa
      }
    };
    xhr.send();
  }

  function removeCard(button) {
    var card = button.parentNode; // Kaldır butonunun bulunduğu kart elementi
    card.parentNode.removeChild(card); // Kart elementini kaldır
  }

  function editAddress(button) {
    var card = button.parentNode; // Butonun bulunduğu kart elementi
    var contents = card.querySelectorAll("p"); // Kart içindeki tüm <p> elementleri

    // Sadece tıklanan kartın içeriği düzenlenebilir hale getirilir
    contents.forEach(function(content) {
      if (content.parentNode === card) { // Sadece tıklanan kartın içeriği değiştirilir
        var text = content.innerText.trim(); // Mevcut metni al
        var input = document.createElement("input"); // Yeni bir input alanı oluştur
        input.setAttribute("value", text); // Input alanına mevcut metni ata
        content.parentNode.replaceChild(input, content); // <p> elementini input alanı ile değiştir
      }
    });

    var editButton = card.querySelector(".edit-button");
    editButton.innerHTML = '<i class="fas fa-save"></i>'; // Kaydet butonunun içeriğini değiştir
    editButton.setAttribute("onclick", "saveCard(this)"); // Butonun tıklama olayını değiştir
  }

  function saveCard(button) {
    var card = button.parentNode; // Butonun bulunduğu kart elementi
    var inputs = card.querySelectorAll("input"); // Kart içindeki tüm input alanları

    // Sadece tıklanan kartın içeriği kaydedilir
    inputs.forEach(function(input) {
      var content = document.createElement("p"); // Yeni bir <p> elementi oluştur
      content.innerText = input.value.trim(); // Input alanından yeni metni al ve <p> elementine ata
      input.parentNode.replaceChild(content, input); // Input alanını <p> elementi ile değiştir
    });

    // Kaydet butonunu düzenleme butonu olarak geri değiştir
    var saveButton = card.querySelector(".edit-button");
    saveButton.innerHTML = '<i class="fas fa-edit"></i>'; // Düzenleme butonunun içeriğini değiştir
    saveButton.setAttribute("onclick", "editAddress(this)"); // Butonun tıklama olayını değiştir
  }
</script>