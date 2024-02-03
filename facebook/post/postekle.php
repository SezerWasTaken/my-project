<?php

include "../baglan.php";
if (
    isset($_POST["baslik"], $_POST["aciklama"], $_POST["foto"]) &&
    $_POST["baslik"] !== '' &&
    $_POST["aciklama"] !== '' &&
    $_POST["foto"] !== ''
) {
    if (isset($_POST["ekle"])) {

        $sql = "INSERT INTO `post` (`post_id`, `post_baslik`, `post_aciklama`, `post_foto`, `post_begeni`, `post_goruntulenme`, `post_yorum`, `post_tarih`) VALUES (NULL, ?, ?, ?, NULL, NULL, NULL, '')";

        $dizi = [
            $_POST["baslik"],
            $_POST["aciklama"],
            $_POST["foto"],
        ];
        $sth = $baglan->prepare($sql);
        $sonuc = $sth->execute($dizi);

        header("Location: ../index.php");
    }
}

$sql = "SELECT * FROM post";
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
$postListele = $sorgu->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="">
    <!-- Header -->
    <?php include("../inc/header.php"); ?>
    <!-- Header -->
    <!-- Main -->
    <main>
        <div class="container mt-5">
            <?php
            if (
                isset($_POST["baslik"], $_POST["aciklama"], $_POST["foto"]) &&
                ($_POST["baslik"] === '' || $_POST["aciklama"] === '' || $_POST["foto"] === '')
            ) {
            ?>
                <div class="alert alert-danger" role="alert">
                    Lütfen boş alan bırakmayınız.
                </div>
            <?php } ?>
            <form class="row g-3" method="post">
                <div class="col-12">
                    <label for="" class="mb-2">Başlık</label>
                    <input type="text" name="baslik" class="form-control" placeholder="Başlık" minlength="28" aria-label="Başlık">
                </div>
                <div class="col-12">
                    <label for="foto" class="mb-2">Fotoğraf (Link)</label>
                    <input type="text" name="foto" class="form-control" placeholder="Fotoğraf" aria-label="Fotoğraf">
                </div>
                <div class="form-outline">
                    <label for="aciklama" class="mb-2">Açıklama</label>
                    <textarea name="aciklama" class="form-control" id="textAreaExample2" rows="8" minlength="100"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" name="ekle" class="btn btn-primary">Ekle</button>
                </div>
            </form>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>