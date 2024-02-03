<?php

// baglan.php'den bağlantı çekiyoruz. 
require_once("../baglan.php");

// Postlama işlemleri

if (
    isset($_POST["urunadi"], $_POST["urunkodu"], $_POST["urunucreti"], $_POST["urunstok"], $_POST["urunfoto"]) &&
    $_POST["urunadi"] !== '' &&
    $_POST["urunkodu"] !== '' &&
    $_POST["urunucreti"] !== '' &&
    $_POST["urunstok"] !== '' &&
    $_POST["urunfoto"] !== ''
) {
    if (isset($_POST["kaydet"])) {

        $sql = "UPDATE `urunler` SET `urunadi` = ?, `urunkodu` = ?, `urunucreti` = ?, `urunstok` = ?, `urunfoto` = ? WHERE `urunler`.`urunid` = ?";

        $dizi = [
            $_POST["urunadi"],
            $_POST["urunkodu"],
            $_POST["urunucreti"],
            $_POST["urunstok"],
            $_POST["urunfoto"],
            $_POST["urunid"],
        ];
        $sth = $baglan->prepare($sql);
        $sonuc = $sth->execute($dizi);

        header("Location: http://localhost/marketstok/urunler.php");
    }
}

$sql = "SELECT * FROM urunler WHERE urunid = ?";
$sorgu = $baglan->prepare($sql);
$sorgu->execute([
    $_GET['urunid']
]);
$satir = $sorgu->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Stok Programı</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <!-- Navbar start -->
    <?php include "../inc/header.php" ?>
    <!-- Navbar end -->

    <div class="container mt-5 ">
        <form class="row g-3" method="post">
            <input type="hidden" name="urunid" value="<?= $satir["urunid"] ?>">
            <div class="col-md-6">
                <label for="urunadi" class="form-label">Ürün adı</label>
                <input name="urunadi" type="text" class="form-control" value="<?= $satir["urunadi"] ?>">
            </div>
            <div class="col-md-6">
                <label for="urunkodu" class="form-label">Ürün Kodu</label>
                <input name="urunkodu" type="text" class="form-control" value="<?= $satir["urunkodu"] ?>">
            </div>
            <div class="col-md-4">
                <label for="urunucreti" class="form-label">Ürün Ücreti</label>
                <input name="urunucreti" type="text" class="form-control" value="<?= $satir["urunucreti"] ?>">
            </div>
            <div class="col-md-4">
                <label for="urunstok" class="form-label">Ürün Stok</label>
                <input name="urunstok" type="text" class="form-control" value="<?= $satir["urunstok"] ?>">
            </div>
            <div class="col-md-4">
                <label for="urunfoto" class="form-label">Ürün Fotoğrafı  <span class="text-danger">(TEKRARDAN SEÇMEYİ UNUTMAYIN)</span></label>
                <input name="urunfoto" type="file" class="form-control" value="<?= $satir["urunfoto"] ?>">
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