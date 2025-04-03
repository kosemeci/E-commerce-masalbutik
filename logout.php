<?php
// Oturumu başlat
session_start();

// Oturumu sonlandır
session_destroy();

// İsteğe bağlı olarak, oturuma ait tüm değişkenleri de silmek için:
$_SESSION = array();

// Oturumu sonlandırdıktan sonra, istenilen sayfaya yönlendirme yapabiliriz
// Örneğin, index.php sayfasına yönlendirme yapabiliriz
header("Location: index.php");
exit(); // Yönlendirme yapıldıktan sonra scriptin çalışmasını sonlandır
?>
