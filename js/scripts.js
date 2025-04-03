document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');
    

    
    const showLoginFromRegister = document.getElementById('showLoginFromRegister');
    const showRegisterFromRegister = document.getElementById('showRegisterFromRegister');
    const showLoginFromLogin = document.getElementById('showLoginFromLogin');
    const showRegisterFromLogin = document.getElementById('showRegisterFromLogin');
    var defaultGiris=document.getElementById('g_girisYap');
    

    showLoginFromRegister.addEventListener('click', function() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        
    });

    showRegisterFromRegister.addEventListener('click', function() {
        registerForm.style.display = 'block';
        loginForm.style.display = 'none';
        
    });

    showLoginFromLogin.addEventListener('click', function() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        
    });

    showRegisterFromLogin.addEventListener('click', function() {
        registerForm.style.display = 'block';
        loginForm.style.display = 'none';
    });

    defaultGiris.addEventListener('click',function(){
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    })

    
   
});

//Şifremi unuttum butonuna tıklandığında
document.getElementById("sifremiUnuttumButton").addEventListener("click", function() {
    // Giriş yap butonunu ve şifre alanını gizle
    document.getElementById("sifremiUnuttumButton").style.display = "none";
    document.getElementById("sifreResetButton").style.display = "block";
    document.getElementById("g_sifre").style.display = "none";
    document.getElementById("g_girisYap").style.display = "none";
    document.getElementById("g_sifreLabel").style.display = "none";
  });

    function telControl() {
    var telNo = document.getElementById("telefon").value;
    var telText = document.getElementById("telText");

    // Telefon numarasının uzunluğunu kontrol et
    if (telNo.length != 11) {
        telText.textContent = "Telefon numarası 11 karakter  olmalıdır.";
        telText.style.color = "red";
    } else {
        telText.textContent = ""; // Hata mesajını temizle
    }

    // Telefon numarasının sadece rakamlardan oluştuğunu kontrol et
    var numbers = /^[0-9]+$/;
    if (!telNo.match(numbers)) {
        telText.textContent = "Telefon numarası sadece rakamlardan oluşmalıdır.";
        telText.style.color = "red";
    } else {
        // Başka bir hata mesajı yoksa, mesaj alanını temizle
        if (telText.textContent === "") {
            telText.textContent = "";
        }
    }
    }
    
    function epostacontrol() {
        
        var email = document.getElementById("email").value;
        var text = document.getElementById("text");

        var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if(email.match(pattern)) {
            
            text.innerHTML = "Geçerli e-posta";
            text.style.color = "green";
        } else {
            
            text.innerHTML = "Geçersiz e-posta!";
            text.style.color = "red";

        }
        if (email == "") {
            text.innerHTML = "";
            
        }
    }

    function sifreControl() {
        var sifre = document.getElementById("sifre").value;
        var sifre_tekrar = document.getElementById("sifre_tekrar").value;
        var sifreText = document.getElementById("sifreText");
        var sifre_tekrarText = document.getElementById("sifre_tekrarText");
        
        var hasUppercase = /[A-Z]/.test(sifre);
        var hasNumber = /\d/.test(sifre);
        var hasMinLength = sifre.length >= 8;
    
        if (hasUppercase && hasNumber && hasMinLength) {
            sifreText.innerHTML = "Güçlü şifre";
            sifreText.style.color = "green";
            
        } else {
            sifreText.innerHTML = "Şifre zayıf! En az bir büyük harf, bir sayı ve sekiz karakter içermelidir.";
            sifreText.style.color = "red";
            
            
            }
    
        if (sifre === sifre_tekrar && sifre_tekrar !== "") {
            sifre_tekrarText.innerHTML = "Şifreler eşleşiyor";
            sifre_tekrarText.style.color = "green";
            
            
            
        } else {
            sifre_tekrarText.innerHTML = "Şifreler eşleşmiyor";
            sifre_tekrarText.style.color = "red";
            
            
        }
    }

    function validateForm() {
        
        epostacontrol();
        sifreControl();
    
        
        var emailIsValid = document.getElementById("text").style.color === "green";
        var passwordIsValid = document.getElementById("sifreText").style.color === "green" &&
                              document.getElementById("sifre_tekrarText").style.color === "green";

    
        return emailIsValid && passwordIsValid;
    }

    
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName('close')[0];
    var aydinlatmaMetni = document.getElementById('aydinlatma-metni');

    aydinlatmaMetni.onclick = function () {
        modal.style.display = 'block';
    };

    span.onclick = function () {
        modal.style.display = 'none';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };


    $(document).ready(function() {
        // Üye Ol formunu gönderme
        $("#registerForm").submit(function(event) {
            // Formun normal submit işlemini engelliyoruz
            event.preventDefault();

            // Form verilerini FormData nesnesine alıyoruz
            var formData = new FormData($(this)[0]);

            if (document.getElementById('registerForm').onsubmit() === true) {
                $.ajax({
                    url: "uyelik_olustur.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'success') {
                            document.getElementById('register_error').style.color = "green";
                            $('#register_error').text('Sisteme başarıyla kayıt oldunuz.');
                            document.getElementById('isim').value = '';
                            document.getElementById('email').value = '';
                            document.getElementById('telefon').value = '';
                            document.getElementById('sifre_tekrar').value = '';
                            document.getElementById('sifre').value = '';
                            document.getElementById('onay1').checked = false;
                            document.getElementById('onay2').checked = false;
                            document.getElementById('onay3').checked = false;
                            document.getElementById('text').style.display = 'none';
                            document.getElementById('sifreText').style.display = 'none';
                            document.getElementById('sifre_tekrarText').style.display = 'none';


                        } else if (response === 'mail') {
                            document.getElementById('register_error').style.color = "red";
                            $('#register_error').text('Mail adresi sisteme kayıtlı.');
                        } else {
                            document.getElementById('register_error').style.color = "red";
                            $('#register_error').text('başarısız');
                        }
                    },
                    error: function(error) {

                        document.getElementById('register_error').style.color = "red";
                        document.getElementById('register_error').innerText = "Bilinmeyen bir hata oluştu";
                    }
                });
            }
        });

        // Giriş Yap formunu gönderme
        $("#loginForm").submit(function(event) {

            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "giris_kullanici.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response === 'success') {
                        window.location.href = "index.php";
                        
                    }else if (response === 'admin') {
                        window.location.href = "admin.php";
                    }else if (response === 'password') {
                        $('#login_error').text('Şifre hatalı.');
                    } else {
                        $('#login_error').text('Mail adresi kayıtlı değil.');
                    }
                },
                error: function(error) {
                    document.getElementById('login_error').innerText = "Bilinmeyen bir hata oluştu.";
                }
            });
        });
    });
    




    
