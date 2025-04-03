

// function toggleDropdown() {
//     document.getElementById("kategoriDropdown").classList.toggle("show");
// }

// window.onclick = function (event) {
//     if (!event.target.matches('.dropbtn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         var i;
//         for (i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }

// function filtre_toggleDropdown() {
//     document.getElementById("filtreDropdown").classList.toggle("show");
// }

// window.onclick = function (event) {
//     if (!event.target.matches('.dropbtn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         var i;
//         for (i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }

// var subcategoryLists = document.querySelectorAll('.subcategories');
// subcategoryLists.forEach(function (subcategory) {
//     subcategory.parentNode.addEventListener('click', function () {
//         subcategory.style.display = (subcategory.style.display === 'none' || subcategory.style.display === '') ? 'block' : 'none';
//     });
// });

function login() {
    window.location.href = "giris.php";
}

//FİLTRELEME SIRALAMA İŞLEMLERİ
document.addEventListener("DOMContentLoaded", function () {
    var headings = document.querySelectorAll('.sidebar h5');

    headings.forEach(function (heading) {
        heading.addEventListener('click', function () {
            var icon = this.querySelector('i');
            var content = this.nextElementSibling;

            if (content.classList.contains('show')) {
                content.classList.remove('show');
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-right');
            } else {
                document.querySelectorAll('.toggle-content').forEach(function (item) {
                    item.classList.remove('show');
                });

                content.classList.add('show');
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-down');
            }

            headings.forEach(function (otherHeading) {
                if (otherHeading !== heading) {
                    otherHeading.querySelector('i').classList.remove('bi-chevron-down');
                    otherHeading.querySelector('i').classList.add('bi-chevron-right');
                }
            });
        });
    });
});

//SİDEBARI SABİTLEME
document.addEventListener("DOMContentLoaded", function () {
    var sidebar = document.querySelector('.sidebar');
    var sectionRow = document.querySelector('.sectionRow');
    var scrollThreshold = sectionRow.offsetTop - 60;
    var scrollThresholdMax = sectionRow.offsetTop + sectionRow.offsetHeight - 450;

    window.addEventListener('scroll', function () {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > scrollThreshold && scrollTop < scrollThresholdMax) {
            sidebar.classList.add('fixed');
        } else {
            sidebar.classList.remove('fixed');
        }
    });
});

//ALT KATEGORİ GETİRME FONKSİYONU
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.toggle-content input[name="kategori"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            var categoryId = this.value;
            var currentUrl = 'index.php?category_id=' + categoryId;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        var subCategorySelect = document.getElementById('alt_kategori');
                        subCategorySelect.innerHTML = xhr.responseText;
                    } else {
                        console.log('Sunucudan veri alınamadı.');
                    }
                }
            };
            xhr.open('GET', currentUrl, true);
            xhr.send();
        });
    });
});

//ÜRÜN BEĞENME VERİ TABANINA GÖNDERME İŞLEMLERİ
$(document).ready(function() {
    $(document).on('click', '.like_icon', function (event) {
        event.stopPropagation(); // Olayın diğer elementlere yayılmasını engelle
        
        var isLiked = $(this).hasClass('fas');

        if (isLiked) {
            $(this).removeClass('fas').addClass('far');
        } else {
            $(this).removeClass('far').addClass('fas');
        }

        var action = isLiked ? 'dislike' : 'like';
        var productId = $(this).attr('id');

        $.ajax({
            url: 'urun_begeni.php',
            method: 'POST',
            data: { product_id: productId, action: action },
            success: function(response) {
                if (response === 'login') {
                    window.location.href = "giris.php";
                } else if (response === 'like') {
                    console.log('Ürün veri tabanına kaydedildi.');
                } else if (response === 'dislike') {
                    console.log('Ürün veri tabanından çıkarıldı.');
                } else {
                    console.log('Ürün beğenilirken bir hata oluştu.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

});



//ALT KATEGORİ GETİRME FONKSİYONU MOBİL

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.toggle-content input[name="kategori_mobil"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            var categoryAd = this.value;
            var currentUrl = 'index.php?category_ad=' + categoryAd;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        var subCategorySelectMobil = document.getElementById('alt_kategori_mobil');
                        subCategorySelectMobil.innerHTML = xhr.responseText;
                    } else {
                        console.log('Sunucudan veri alınamadı.');
                    }
                }
            };
            xhr.open('GET', currentUrl, true);
            xhr.send();
        });
    });
});

// Sıralama seçeneklerine tıklama olaylarını dinleyin

$(document).ready(function() {
    $('input[name="siralamalar"]').change(function() {
        var siralama = $('input[name="siralamalar"]:checked').siblings('label').text();
        var kategori = $('input[name="kategori"]:checked').val();
        kategori_turu = kategori ? kategori : '0';

        $.ajax({
            url: 'urun_getir.php', 
            method: 'POST', 
            data: { siralama: siralama, kategori_turu:kategori_turu }, 
            success: function(response) {
                $('#urunler').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    $('input[name="kategori"]').change(function() {
        var kategori = $('input[name="kategori"]:checked').val();
        var siralama = $('input[name="siralamalar"]:checked').siblings('label').text();
        $.ajax({
            url: 'urun_getir.php', 
            method: 'POST', 
            data: { kategori:kategori,siralama_turu:siralama }, 
            success: function(response) {
                $('#urunler').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
 
});

// ürün.php ye yönlendirme
$(document).ready(function() {
    $(document).on('click', '.card', function() {
        var urunKodu = $(this).attr('id');
        window.location = 'urun.php?urunKodu=' + urunKodu;
    });
});

    // Index.php yüklendiğinde aşağı kaydır
    // if (window.location.href.includes("index.php")) {
    //     // index.php için özel davranışlar
    //     window.onload = function() {
    //         var vitrinElement = document.getElementById("vitrin");
    //         if (vitrinElement) {
    //             var extraPadding = 90; // Ekstra 20 piksel boşluk bırak
    //             var yPosition = vitrinElement.getBoundingClientRect().top + window.pageYOffset - extraPadding;
    //             window.scrollTo({ top: yPosition, behavior: 'smooth' });
    //         }
    //     };
    // }