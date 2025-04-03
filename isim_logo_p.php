<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tempFile = $_FILES['new_logo']['tmp_name'];
    $targetPath = 'img/logo/';
    $targetFile = $targetPath . 'logo.png';

    // Yeni dosyayı hedef konuma taşı
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo 'success';
    } else {
        echo 'unsuccess';
    }

} else {
    echo 'error';
}
?>
