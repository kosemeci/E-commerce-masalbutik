    (function () {
    "use strict";

    var treeviewMenu = document.querySelector('.app-menu');

    document.querySelector('[data-toggle="sidebar"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.app').classList.toggle('sidenav-toggled');
    });

    var treeviewToggles = document.querySelectorAll("[data-toggle='treeview']");
    treeviewToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            var parent = this.parentElement;
            if (!parent.classList.contains('is-expanded')) {
                var expandedItems = treeviewMenu.querySelectorAll(".is-expanded");
                expandedItems.forEach(function(item) {
                    item.classList.remove('is-expanded');
                });
            }
            parent.classList.toggle('is-expanded');
        });
    });
})();

document.getElementById('productUptCategory').addEventListener('change', function() {
    var categoryId = this.value;
    var currentUrl = 'urun_ekleme.php?category_id=' + categoryId;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                var subCategorySelect = document.getElementById('productUpSubCategory');
                subCategorySelect.innerHTML = xhr.responseText;
            } else {
                console.log('Sunucudan veri alınamadı.');
            }
        }
    };
    xhr.open('GET', currentUrl, true);
    xhr.send();
});


function logout() {
    // AJAX kullanarak oturumu sonlandır
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Oturum başarıyla sonlandırıldıktan sonra kullanıcıyı yönlendir
            window.location.href = "index.php"; // Çıkış yapıldıktan sonra yönlendirilecek sayfa
        }
    };
    xhr.send();
}


