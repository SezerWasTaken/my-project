<?php
if (
    isset($_POST["sinif"], $_POST["not1"], $_POST["not2"], $_POST["perf1"], $_POST["perf2"]) &&
    $_POST["sinif"] !== '' &&
    $_POST["not1"] !== '' &&
    $_POST["not2"] !== '' &&
    $_POST["perf1"] !== '' &&
    $_POST["perf2"] !== ''
) {
    if (isset($_POST["kaydet"])) {
        include "baglan.php";

        // Öğrenci ekleme kısmı
        $sqlOgrenci = "INSERT INTO `ogrenci` (`ogrno`,`ograd`, `ogrsoyad`, `cinsiyet`, `sinif`, `dtarih`, `ortalama`) VALUES (?, ?, ?, ?, ?, '0')";
        $ogrenciDizi = [
            $_POST["no"],
            $_POST["ad"],
            $_POST["sad"],
            $_POST["cins"],
            $_POST["sinif"],
            $_POST["dtarih"],
        ];
        $ogrenciStmt = $baglan->prepare($sqlOgrenci);
        $ogrenciSonuc = $ogrenciStmt->execute($ogrenciDizi);

        // Eklenen öğrencinin ID'sini al
        $ogrenciId = $baglan->lastInsertId();

        if ($ogrenciSonuc) {
            // SQL sorgusundaki sütun adlarını düzelt
            $sqlMatematik = "INSERT INTO `matematik` (`ogrno`, `not1`, `not2`, `perf1`, `perf2`) VALUES (?, ?, ?, ?, ?)";
            $matematikDizi = [
                $ogrenciId,
                $_POST["not1"],
                $_POST["not2"],
                $_POST["perf1"],
                $_POST["perf2"],
            ];
            $matematikStmt = $baglan->prepare($sqlMatematik);
            $matematikSonuc = $matematikStmt->execute($matematikDizi);

            // Öğrenci bilgilerini güncelleme kısmı
            $updateSql = "UPDATE ogrenci SET 
                ograd = CONCAT(UPPER(SUBSTRING(ograd, 1, 1)), LOWER(SUBSTRING(ograd, 2))),
                ogrsoyad = CONCAT(UPPER(SUBSTRING(ogrsoyad, 1, 1)), LOWER(SUBSTRING(ogrsoyad, 2))),
                cinsiyet = CONCAT(UPPER(SUBSTRING(cinsiyet, 1, 1)), LOWER(SUBSTRING(cinsiyet, 2))),
                sinif = UPPER(sinif)
            ";

            $updateStmt = $baglan->prepare($updateSql);
            $updateStmt->execute();

            if ($matematikSonuc) {
                header("location:index.php");
            } else {
                // Hata durumunda burada işlem yapabilirsiniz
                echo "Not eklenirken bir hata oluştu.";
            }
        } else {
            // Hata durumunda burada işlem yapabilirsiniz
            echo "Öğrenci eklenirken bir hata oluştu.";
        }
    }
}
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
                <div class="col-md-12">
                    <label for="no" class="form-label">No</label>
                    <input type="text" name="no" class="form-control" id="inputEmail4">
                </div>
                <!-- <div class="col-md-6">
                    <label for="Ad" class="form-label">Ad</label>
                    <input type="text" name="ad" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="Sad" class="form-label">Soyad</label>
                    <input type="text" name="sad" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="sinif" class="form-label">Sınıf</label>
                    <input type="text" name="sinif" class="form-control" id="inputEmail4">
                </div> -->
                <br>
                <div class="col-md-6">
                    <label for="not1" class="form-label">Not 1</label>
                    <input type="text" name="not1" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="not2" class="form-label">Not 1</label>
                    <input type="text" name="not2" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="perf1" class="form-label">Performans 1</label>
                    <input type="text" name="perf1" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="perf2" class="form-label">Performans 2</label>
                    <input type="text" name="perf2" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                    <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>