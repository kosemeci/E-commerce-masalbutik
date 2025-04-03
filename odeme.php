<?php
session_start();
$user = $_SESSION['isim'];
$addressTitle = $_POST['addressTitle'];
$addressDetails = $_POST['addressDetails'];
$sepetTutari = $_POST['sepetTutari'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        h1 {
            color: #333;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ödeme Bilgileri</h1>
        <div class="result">
            <p>Merhaba <?php echo $user; ?>!</p>
            <p>Ödeme yapacağınız adres:</p>
            <p><strong><?php echo $addressTitle; ?></strong></p>
            <p><?php echo $addressDetails; ?></p>
            <p>Ödenecek tutar: <?php echo $sepetTutari; ?></p>
        </div>
    </div>
</body>
</html>
