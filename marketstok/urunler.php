<?php

session_start();

// baglan.php'den bağlantı çekiyoruz. 
require_once("baglan.php");

if (isset($_GET["sil"])) {
    $sqlsil = "DELETE FROM urunler WHERE urunid = ?";
    $sorgusil = $baglan->prepare($sqlsil);
    $sorgusil->execute([$_GET["sil"]]);

    header('Location: urunler.php');
}

// veritabanındaki bilgileri alıyoruz
$sql = "SELECT urunler.*, kullanicilar.kullanici_ad
FROM urunler
LEFT JOIN kullanicilar ON kullanicilar.kullanici_id = urunler.urunkid
ORDER BY urunler.urunid ASC";
// SELECT * FROM yazilar
//     INNER JOIN kategoriler ON kategoriler.kategori_id = yazilar.yazi_kategori_id WHERE yazi_kategori_id=? ORDER BY yazi_id DESC
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
$urunListele = $sorgu->fetchAll(PDO::FETCH_ASSOC);

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

    <div class="container mt-5 ">
        <div class="row row-gap-3">
            <?php foreach ($urunListele as $urun) { ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card">
                        <img src="img/<?= $urun["urunfoto"] ?>" class="card-img-top img-fluid" alt="<?= $urun["urunfoto"] ?>" style="object-fit: cover; height: 180px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $urun["urunadi"] ?></h5>
                            <h6 class="card-text fs-5"><?= $urun["urunucreti"] ?>₺</h6>
                            <p class="card-text fw-medium">Ürün kodu: <?= $urun["urunkodu"] ?><br>Ürün stok: <?= $urun["urunstok"] ?><br>Kullanici ID: <?= $urun["urunkid"] ?></p>
                            <a href="" class="btn btn-primary w-100 mb-1">Sepete Ekle</a>
                            <!-- <?php if ($_SESSION["user_id"] == $urun["urunkid"]) { ?>
                                <div class="btn-group w-100">
                                    <a href="http://localhost/marketstok/urundetay/urunduzenle.php?urunid=<?= $urun["urunid"] ?>" class="btn btn-primary">Ürünü Düzenle</a>
                                    <a href="urunler.php?sil=<?= $urun["urunid"] ?>" onclick="return confirm('Ürün silinsin mi ?')" class="btn btn-danger">Ürünü Sil</a>
                                </div>
                            <?php } ?> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- AJAX js-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();

                $(".card").each(function() {
                    var cardText = $(this).text().toLowerCase();
                    var card = $(this);

                    if (cardText.indexOf(searchText) === -1) {
                        card.fadeOut();
                    } else {
                        card.fadeIn();
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>