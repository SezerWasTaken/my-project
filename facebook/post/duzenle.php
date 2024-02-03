<?php

include "../baglan.php";

if (isset($_POST["kaydet"])) {

    $sql = "UPDATE post SET `post_baslik` = ?,
        `post_aciklama` = ?,
        `post_foto` = ? WHERE `post`.`post_id` = ?";

    $dizi = [
        $_POST["baslik"],
        $_POST["aciklama"],
        $_POST["foto"],
        $_POST["post_id"], // post_id'yi ekledik
    ];
    $sorgu = $baglan->prepare($sql);
    $sorgu->execute($dizi);

    header("Location: ../index.php");
}

$sql = "SELECT * FROM post WHERE post_id = ?";
$sorgu = $baglan->prepare($sql);
$sorgu->execute([
    $_GET['post_id']
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
            <form class="row g-3" method="post">
                <input type="hidden" name="post_id" value="<?= $satir['post_id'] ?>">
                <div class="col-12">
                    <label for="" class="mb-2">Başlık</label>
                    <input type="text" name="baslik" class="form-control" value="<?= $satir["post_baslik"] ?>" aria-label="Başlık">
                </div>
                <div class="col-12">
                    <label for="foto" class="mb-2">Fotoğraf (Link)</label>
                    <input type="text" name="foto" class="form-control" value="<?= $satir["post_foto"] ?>" aria-label="Fotoğraf">
                </div>
                <div class="form-outline">
                    <label for="aciklama" class="mb-2">Açıklama</label>
                    <textarea name="aciklama" class="form-control" id="textAreaExample2" rows="8" placeholder="aciklama" minlength="100"><?= $satir["post_aciklama"] ?></textarea>
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