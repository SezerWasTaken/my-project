<?php

include "baglan.php";

if (isset($_GET["sil"])) {
    $sqlsil = "DELETE FROM ogrenci WHERE ogrno = ?";
    $sorgusil = $baglan->prepare($sqlsil);
    $sorgusil->execute([$_GET["sil"]]);

    header('Location: index.php');
}

$sql = "SELECT * FROM ogrenci";
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
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
                        <a href="notlar.php" class="btn btn-outline-primary">Notlar</a>
                        <a href="notekle.php" class="btn btn-outline-primary">Not gir</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header -->
    <!-- Main -->
    <main>
        <div class="container">
            <div class="row mt-4">
                <div class="col">
                    <table class="table table-hover table-dark table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>cinsiyet</th>
                                <th>sinif</th>
                                <th>doğum tarihi</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?= $satir['ogrno'] ?></td>
                                    <td><?= $satir['ograd'] ?></td>
                                    <td><?= $satir['ogrsoyad'] ?></td>
                                    <td><?= $satir['cinsiyet'] ?></td>
                                    <td><?= $satir['sinif'] ?></td>
                                    <td><?= $satir['dtarih'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="detay.php?ogrno=<?= $satir['ogrno'] ?>" class="btn btn-success">Detay</a>
                                            <a href="guncelle.php?ogrno=<?= $satir['ogrno'] ?>" class="btn btn-secondary">Güncelle</a>
                                            <a href="index.php?sil=<?= $satir['ogrno'] ?>" onclick="return confirm('silinsin mi ?')" class="btn btn-danger">Kaldır</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>