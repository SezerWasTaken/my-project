<?php

include "baglan.php";

$sql = "SELECT * FROM ogrenci WHERE ogrno = ?";
$sorgu = $baglan->prepare($sql);
$sorgu->execute([
    $_GET['ogrno']
]);

$satir = $sorgu->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-1 text-center">İstanbul Kadiköy Lisesi</h1>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <a href="index.php" class="btn btn-outline-primary">Tüm Öğrenciler</a>
                        <a href="ekle.php" class="btn btn-outline-primary">Öğrenci ekle</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header -->
    <!-- Main -->
    <main>
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="card w-100 border-success mt-3">
                        <div class="card-header">Öğrenci Bilgi </div>
                        <div class="card-body">
                            <h5 class="card-text">Numara: <?= $satir["ogrno"] ?></h5>
                            <h5 class="card-text">Ad: <?= $satir["ograd"] ?></h5>
                            <h5 class="card-text">Soyad: <?= $satir["ogrsoyad"] ?></h5>
                            <h5 class="card-text">Cinsiyet: <?= $satir["cinsiyet"] ?></h5>
                            <h5 class="card-text">Doğum Tarihi: <?= $satir["dtarih"] ?></h5>
                            <h5 class="card-text">Sınıfı: <?= $satir["sinif"] ?></h5>
                            <h5 class="card-text">Ortalama: <?= $satir["ortalama"] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-100 border-danger mt-3">
                        <div class="card-header">Ceza-Uyarı</div>
                        <div class="card-body">
                            <h5 class="card-text">Uyarı: <?= $satir["ceza"] ?></h5>
                            <h5 class="card-text">Ceza: <?= $satir["uyari"] ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>