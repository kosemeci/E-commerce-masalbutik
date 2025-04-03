<?php require_once("baglan.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giris</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    


</head>

<body>

    <?php require_once("navbar.php") ?>
    <!-- Kayıt Ol formu -->
    <div class="register-form">
        <div class="d-flex justify-content-center mt-0">
            <button type="button" id="showLoginFromRegister" class="btn btn-primary">Giriş Yap</button>
            <button type="button" id="showRegisterFromRegister" class="btn btn-secondary ">Üye Ol</button>
        </div>
        <div class="form-container">


            <form id="registerForm" onsubmit="return validateForm()">


                <p class="text-center" style="margin-top: 10px;">Merhaba ,<br> Hemen giriş yap ya da hesap oluştur,alışverişe başla!</p>
                <div class="row justify-content-center">

                    <div class="col-md-6">


                        <div class="form-group">
                            <p style="color:red" id="register_error"></p>
                            <label for="isim">İsim-Soyisim:</label>
                            <input type="text" class="form-control" name="isim" id="isim" placeholder="İsminizi giriniz" required>
                        </div>

                        <div class="form-group">
                            <p style="color:red" id="telefon_error"></p>
                            <label for="telefon">Telefon Numarası:</label>
                            <input type="tel" class="form-control" name="telefon" id="telefon" onkeyup="telControl()" placeholder="Telefon numaranızı giriniz" required>
                            <span id="telText"></span>
                        </div>


                        <div class="form-group">

                            <label for="email">E-posta:</label>
                            <input type="text" class="form-control" name="email" id="email" onkeyup="epostacontrol()" placeholder="E-posta adresinizi giriniz" required>
                            <span id="text"></span>

                        </div>


                        <div class="form-group">

                            <label for="sifre">Şifre:</label>
                            <input type="password" class="form-control" name="sifre" id="sifre" onkeyup="sifreControl()" placeholder="Şifrenizi giriniz" required>
                            <span id="sifreText"></span>

                        </div>
                        <div class="form-group">

                            <label for="sifre_tekrar">Tekrar Şifre:</label>
                            <input type="password" class="form-control" name="sifre_tekrar" id="sifre_tekrar" onkeyup="sifreControl()" placeholder="Şifrenizi tekrar giriniz" required>
                            <span id="sifre_tekrarText"></span>

                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="onay1" required>
                            <label class="form-check-label" for="onay1">Tarafıma avantajlı tekliflerin sunulabilmesi
                                amacıyla kişisel verilerimin işlenmesine ve paylaşılmasına açık rıza
                                veriyorum.</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="onay2" required>
                            <label class="form-check-label" for="onay2">Tarafıma elektronik ileti gönderilmesini
                                kabul ediyorum.</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="onay3" required>
                            <label class="form-check-label" for="onay3">
                                Kişisel verilerimin işlenmesine yönelik
                                <span id="aydinlatma-metni" style="color: gray; cursor: pointer;  text-decoration: underline;">aydınlatma metnini </span>
                                okudum ve anladım.
                            </label>
                        </div>

                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Kullanım Şartları ve Gizlilik Politikası <br>

                                    Bu uygulamayı kullanmadan önce lütfen aşağıdaki şartları ve politikaları dikkatlice okuyun. <br>

                                    Kullanım Şartları:<br>

                                    1.Hesap Oluşturma ve Güvenlik:<br>

                                    • Uygulamayı kullanmak için bir hesap oluşturmalısınız.<br> Hesap bilgilerinizin güvenliği sizin sorumluluğunuzdadır.<br>
                                    • Hesap bilgilerinizi paylaşmaktan kaçının ve şifrenizi güvenli tutun.
                                    2.İçerik Kullanımı:<br>

                                    • Uygulama içindeki rehberlik ve bilgilendirme içeriğini kişisel kullanımınız için kullanabilirsiniz.<br>
                                    • İçeriklerin ticari amaçla kullanımı ve başka platformlarda paylaşılması yasaktır.<br>
                                    3.Kullanıcı Sorumluluğu:<br>

                                    • Uygulama içindeki bilgiler genel rehberlik amaçlıdır. Gerçek zamanlı güncellemeler için yerel kaynaklara başvurun.<br>
                                    • Gizlilik Politikası:<br>

                                    1.Kişisel Bilgiler:<br>

                                    • Hesap oluştururken verdiğiniz kişisel bilgiler (ad, e-posta vb.) gizli tutulacaktır.<br>
                                    • Bilgileriniz asla üçüncü şahıslarla paylaşılmayacaktır.<br>
                                    2.Konum ve İzinler:<br>

                                    • Uygulama, konum bilgilerinizi sadece gezginlik amaçlı kullanacaktır.<br>
                                    • Diğer izinler sadece uygulama içindeki işlevselliği artırmak için kullanılacaktır.<br>
                                    3.Çerezler ve Analitik Veriler:<br>

                                    • Uygulama, kullanım istatistikleri ve performans analizi için çerezleri kullanabilir.<br>
                                    •Bu veriler, uygulamayı geliştirmek ve size daha iyi bir deneyim sunmak için kullanılacaktır.<br>
                                    4.Güvenlik:<br>

                                    • Uygulama, güvenlik önlemleri alarak bilgilerinizi koruma amacını taşır.<br>
                                    • Güvenlik ihlali durumunda derhal bildirimde bulunulacaktır.<br>
                                    Bu şartlar ve politikalar zaman zaman güncellenebilir. Güncellemeler hakkında size bildirim yapılacaktır. Uygulamayı kullanarak bu şartları ve politikaları kabul etmiş sayılırsınız.<br>

                                    Seyahat etmeye hazır mısınız? Keyifli geziler dileriz!</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-third" id="uye_ol_button" onclick="validateForm()">Üye Ol</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div>


    <!-- Giriş yap formu-->
    <div class="login-form" style="display: none;">
        <div class="d-flex justify-content-center mt-0">
            <button type="button" id="showLoginFromLogin" class="btn btn-secondary ">Giriş Yap</button>
            <button type="button" id="showRegisterFromLogin" class="btn btn-primary ">Üye Ol</button>
        </div>
        <div class="form-container">
            <form id="loginForm" action="giris_yap.php" method="post">
                <!-- Form alanları -->

                <p class="text-center" style="margin-top:10px;">Merhaba gezgin,<br> Hemen giriş yap ya da hesap oluştur, rotanı belirleyelim
                    seyahate başla!</p>
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <div class="form-group">
                            <p style="color: red;" id="login_error"></p>
                            <label for="g_email">E-posta: </label>
                            <input type="email" class="form-control" name="g_email" id="g_email" placeholder="E-posta adresinizi girin" required>
                        </div>

                        <div class="form-group">
                            <label for="g_sifre" id="g_sifreLabel">Şifre:</label>
                            <input type="password" class="form-control" name="g_sifre" id="g_sifre" placeholder="Şifrenizi girin" required>
                        </div>
                        <div class="sifremiUnuttum">
                            <button id="sifremiUnuttumButton" class="sifremiUnuttumButton">Şifremi unuttum</button>
                            <button id="sifreResetButton" class="center" style="display: none;">Şifreyi Resetle</button>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-third" id="g_girisYap">Giriş Yap</button>
                        </div>



                    </div>
                </div>

            </form>

        </div>

    </div>


    
    <?php require_once("footer.php") ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/login.css">
    <script src="js/scripts.js"></script>


</body>

</html>