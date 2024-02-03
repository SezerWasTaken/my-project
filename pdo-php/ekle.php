<?php
if (
    isset($_POST["ad"], $_POST["sad"], $_POST["cins"], $_POST["sinif"], $_POST["dtarih"]) &&
    $_POST["ad"] !== '' &&
    $_POST["sad"] !== '' &&
    $_POST["cins"] !== '' &&
    $_POST["sinif"] !== '' &&
    $_POST["dtarih"] !== ''
) {
    if (isset($_POST["kaydet"])) {
        include "baglan.php";
        
        $sql = "INSERT INTO `ogrenci` (`ogrno`, `ograd`, `ogrsoyad`, `cinsiyet`, `sinif`, `dtarih`, `ortalama`) VALUES (NULL, ?, ?, ?, ?, ?, '0');" ;

        $dizi = [
            $_POST["ad"],
            $_POST["sad"],
            $_POST["cins"],
            $_POST["sinif"],
            $_POST["dtarih"],
        ];
        $sth = $baglan->prepare($sql);
        $sonuc = $sth->execute($dizi);

        // harfleri büyütmek için
        $updateSql = "UPDATE ogrenci SET 
            ograd = CONCAT(UPPER(SUBSTRING(ograd, 1, 1)), LOWER(SUBSTRING(ograd, 2))),
            ogrsoyad = CONCAT(UPPER(SUBSTRING(ogrsoyad, 1, 1)), LOWER(SUBSTRING(ogrsoyad, 2))),
            cinsiyet = CONCAT(UPPER(SUBSTRING(cinsiyet, 1, 1)), LOWER(SUBSTRING(cinsiyet, 2))),
            sinif = UPPER(sinif)
        ";

        $updateStmt = $baglan->prepare($updateSql);
        $updateStmt->execute();
        header("location:index.php");
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
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <label for="dtarih" class="form-label">Doğum tarihi</label>
                    <input type="date" name="dtarih" class="form-control" id="inputEmail4">
                </div>
                <div class="col">
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