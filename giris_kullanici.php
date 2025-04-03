<?php
require("baglan.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["g_email"];
    $sifre = $_POST["g_sifre"];

    $sql = "SELECT * FROM kullanici WHERE mail = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("s",$email);

    if ($stmt->execute()) {

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row>0){
           if (password_verify($sifre, $row['sifre'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $email;
            $_SESSION['user_id'] = $row['k_id'];
            $_SESSION['isim'] = $row['ad'];
            if($row['durum']==2){
                echo 'admin';    
            }else{
                echo 'success';
            }

        } else {
            echo 'password';
        } 
        }
        else{
            echo 'mail';
        }

        
    }
    $stmt->close();
} 
?>
