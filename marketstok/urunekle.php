<?php

// baglan.php'den bağlantı çekiyoruz. 
require_once("baglan.php");
session_start();
// Postlama işlemleri
if (
    isset($_POST["urunadi"], $_POST["urunkodu"], $_POST["urunucreti"], $_POST["urunstok"], $_POST["urunfoto"]) &&
    $_POST["urunadi"] !== '' &&
    $_POST["urunkodu"] !== '' &&
    $_POST["urunucreti"] !== '' &&
    $_POST["urunstok"] !== '' &&
    $_POST["urunfoto"] !== ''
) {
    if (isset($_POST["ekle"])) {

        $sql = "INSERT INTO `urunler` (`urunkid`,`urunid`, `urunadi`, `urunkodu`, `urunucreti`, `urunstok`, `urunfoto`) VALUES (?,NULL, ?, ?, ?, ?, ?)";

        $dizi = [
            $_SESSION["user_id"], // This is where you are trying to access the user ID
            $_POST["urunadi"],
            $_POST["urunkodu"],
            $_POST["urunucreti"],
            $_POST["urunstok"],
            $_POST["urunfoto"],
        ];

        $sth = $baglan->prepare($sql);
        $sonuc = $sth->execute($dizi);

        header("Location: urunler.php");
    }
}       
$sql = "SELECT urunler.*, kullanicilar.kullanici_ad
FROM urunler
LEFT JOIN kullanicilar ON kullanicilar.kullanici_id = urunler.urunkid";
$sorgu = $baglan->prepare($sql);
$sorgu->execute();

$hatamsj = '';
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Stok Programı</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Navbar start -->
    <?php include "inc/header.php" ?>
    <!-- Navbar end -->
    <?php if (isset($_SESSION["user_mail"])) { ?>
        <div class="container mt-5 ">
            <?php echo $hatamsj; ?>
            <form class="row g-3" method="post">
                <div class="col-md-6">
                    <label for="urunadi" class="form-label">Ürün adı</label>
                    <input name="urunadi" type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                    <label for="urunkodu" class="form-label">Ürün Kodu</label>
                    <input name="urunkodu" type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-4">
                    <label for="urunucreti" class="form-label">Ürün Ücreti</label>
                    <input name="urunucreti" type="text" class="form-control" placeholder="Örnek: 128.00">
                </div>
                <div class="col-md-4">
                    <label for="urunstok" class="form-label">Ürün Stok</label>
                    <input name="urunstok" type="text" class="form-control" placeholder="Örnek: 68">
                </div>
                <div class="col-md-4">
                    <label for="urunfoto" class="form-label">Ürün Fotoğrafı</label>
                    <input name="urunfoto" type="file" class="form-control" placeholder="">
                </div>
                <div class="col-12">
                    <button name="ekle" type="submit" class="btn btn-primary w-100">Ekle</button>
                </div>
            </form>
        </div>
        <?php $kullanici_id ?>
    <?php } else {
        $hatamsj = "
    <div class=\"alert alert-danger mt-3 mx-3\" role=\"alert\">
    Üye Olmadığınız & Giriş Yapmadığınız için ürün ekleyemezsiniz.
    </div>";
    echo $hatamsj;
    }
    ?>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>