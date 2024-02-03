<?php

// baglan.php'den bağlantı çekiyoruz. 
require_once("../baglan.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kullanici_ad = $_POST["kullanici_ad"];
    $kullanici_soyad = $_POST["kullanici_soyad"];
    $kullanici_sifre = $_POST["kullanici_sifre"];
    $tekrar_sifre = $_POST["tekrar_sifre"];
    $kullanici_mail = $_POST["kullanici_mail"];

    if ($kullanici_ad != ""  && $kullanici_soyad != "" && $kullanici_sifre != "" && $tekrar_sifre != "" && $kullanici_mail != "") {
        if ($kullanici_sifre != $tekrar_sifre) {
            echo "Şifreler eşleşmiyor";
            exit;
        }

        // Şifreyi hashle
        $hashed_kullanici_sifre = hash('sha256', $kullanici_sifre);

        $email_check_sql = "SELECT * FROM kullanicilar WHERE kullanici_mail = :mail";
        $email_check_stmt = $baglan->prepare($email_check_sql);
        $email_check_stmt->bindParam(':mail', $kullanici_mail);
        $email_check_stmt->execute();

        if ($email_check_stmt->rowCount() > 0) {
            echo "Bu e-postayla açılmış bir hesap zaten bulunuyor";
            exit;
        }

        try {
            $register_sql = "INSERT INTO kullanicilar (kullanici_ad, kullanici_soyad, kullanici_mail, kullanici_sifre) VALUES (:kullanici_ad, :kullanici_soyad, :kullanici_mail, :kullanici_sifre)";

            $register_stmt = $baglan->prepare($register_sql);

            $register_stmt->bindParam(':kullanici_ad', $kullanici_ad);
            $register_stmt->bindParam(':kullanici_soyad', $kullanici_soyad);
            $register_stmt->bindParam(':kullanici_mail', $kullanici_mail);
            // Hashlenmiş şifreyi veritabanına kaydet
            $register_stmt->bindParam(':kullanici_sifre', $hashed_kullanici_sifre);

            $register_stmt->execute();

            echo "Kayıt başarılı, hoşgeldin!";
        } catch (PDOException $e) {
            echo "Kayıt olurken bir hata oluştu. Lütfen tekrar dene";
            exit;
        }
    } else {
        echo "Lütfen boş bir yer bırakmayın";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Stok Programı - Kayıt Ol</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Navbar start -->
    <?php include "../inc/header.php" ?>
    <!-- Navbar end -->

    <div class="container mt-5">
        <form class="row g-3" method="post">
            <div class="col-md-6">
                <label for="kullanici_ad" class="form-label">Adınız</label>
                <input name="kullanici_ad" type="text" class="form-control" value="">
            </div>
            <div class="col-md-6">
                <label for="kullanici_soyad" class="form-label">Soyadınız</label>
                <input name="kullanici_soyad" type="text" class="form-control" value="">
            </div>
            <div class="col-md-12">
                <label for="kullanici_mail" class="form-label">E-Posta adresiniz</label>
                <input name="kullanici_mail" type="email" class="form-control" value="">
            </div>
            <div class="col-md-6">
                <label for="kullanici_sifre" class="form-label">Şifreniz</label>
                <input name="kullanici_sifre" type="password" class="form-control" value="">
            </div>
            <div class="col-md-6">
                <label for="tekrar_sifre" class="form-label">Tekrar Şifreniz</label>
                <input name="tekrar_sifre" type="password" class="form-control" value="">
            </div>
            <div class="col-12">
                <button name="kaydet" type="submit" class="btn btn-primary w-100">Kaydet</button>
            </div>
        </form>
    </div>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>