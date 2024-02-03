<?php

include "baglan.php";
if (
    isset($_POST["ad"], $_POST["sad"], $_POST["cins"], $_POST["sinif"], $_POST["dtarih"]) &&
    $_POST["ad"] !== '' &&
    $_POST["sad"] !== '' &&
    $_POST["cins"] !== '' &&
    $_POST["sinif"] !== '' &&
    $_POST["dtarih"] !== ''
){
    if (isset($_POST['guncelle'])) {

        $sql = "UPDATE `ogrenci` 
            SET `ograd` = ?, 
                `ogrsoyad` = ?, 
                `cinsiyet` = ?, 
                `dtarih` = ?, 
                `sinif` = ?,
                `ceza` = ?,
                `uyari` = ? WHERE `ogrenci`.`ogrno` = ?";
        $dizi = [
            $_POST['ad'],
            $_POST['sad'],
            $_POST['cins'],
            $_POST['dtarih'],
            $_POST['sinif'],
            $_POST['ceza'],
            $_POST['uyari'],
            $_POST['ogrno']
        ];
        $sorgu = $baglan->prepare($sql);
        $sorgu->execute($dizi);

        header("Location:index.php");
    }
}
$sql = "SELECT * FROM ogrenci WHERE ogrno = ?";
$sorgu = $baglan->prepare($sql);
$sorgu->execute([
    $_GET['ogrno']
]);
$satir = $sorgu->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="tr">

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
                    <h1 class="display-1 text-center">Tasarım Kodlama</h1>

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
        <div class="container mt-2">
            <form class="row g-3" method="post">
            <input type="hidden" name="ogrno" value="<?=$satir['ogrno']?>">
                <div class="col-md-6">
                    <label for="ad" class="form-label">Ad</label>
                    <input type="text" name="ad" class="form-control" id="inputEmail4" value="<?= $satir["ograd"] ?>">
                </div>
                <div class="col-md-6">
                    <label for="sad" class="form-label">Soyad</label>
                    <input type="text" name="sad" class="form-control" id="inputEmail4" value="<?= $satir["ogrsoyad"] ?>">
                </div>
                <div class="col-md-6">
                    <label for="sinif" class="form-label">Sınıf</label>
                    <input type="text" name="sinif" class="form-control" id="inputEmail4" value="<?= $satir["sinif"] ?>">
                </div>
                <div class="col-md-6">
                    <label for="dtarih" class="form-label">Doğum tarihi</label>
                    <input type="date" name="dtarih" class="form-control" id="inputEmail4" value="<?= $satir["dtarih"] ?>">
                </div>
                <div class="col-md-6">
                    <label for="ceza" class="form-label">Ceza</label>
                    <input type="number" name="ceza" class="form-control border-danger" id="inputEmail4" value="<?= $satir["ceza"] ?>">
                </div>                <div class="col-md-6">
                    <label for="uyari" class="form-label">Uyarı</label>
                    <input type="number" name="uyari" class="form-control border-warning " id="inputEmail4" value="<?= $satir["uyari"] ?>">
                </div>
                <div class="col">
                    <br>
                    <p class="text-danger">Lütfen işaretlemeyi unutmayın!</p>

                    <label for="" class="form-label">Kız
                        <input type="radio" name="cins" value="K">
                    </label>
                    <label for="" class="form-label">Erkek
                        <input type="radio" name="cins" value="E">
                    </label>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>