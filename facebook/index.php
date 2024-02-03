<?php

include("baglan.php");

if (isset($_GET["sil"])) {
    $sqlsil = "DELETE FROM post WHERE post_id = ?";
    $sorgusil = $baglan->prepare($sqlsil);
    $sorgusil->execute([$_GET["sil"]]);

    header('Location: index.php');
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
</head>

<body class="">
    <!-- Header -->
    <?php include "inc/header.php"; ?>
    <!-- Header -->
    <!-- Main -->
    <main>
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($postListele as $satir) { ?>
                    <div class="col">
                        <div class="card h-100 d-flex flex-column">
                            <img src="<?= $satir["post_foto"] ?>" class="card-img-top img-fluid" alt="<?= $satir["post_baslik"] ?>" style="object-fit: cover; height: 200px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><a href="/facebook/blog.php?post_id=<?= $satir["post_id"] ?>"><?= $satir["post_baslik"] ?></a></h5>
                                <!-- 20 karakterden uzunsa -->
                                <p class="card-text"><?= strlen($satir["post_aciklama"]) >= 100 ? substr($satir["post_aciklama"], 0, 100) . '...' : $satir["post_aciklama"] ?></p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic example">
                                    <a type="button" href="post/duzenle.php?post_id=<?= $satir["post_id"] ?>" class="btn btn-primary">Düzenle</a>
                                    <a type="button" href="index.php?sil=<?= $satir["post_id"] ?>" onclick="return confirm('silinsin mi ?')" class="btn btn-danger">Sil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <!-- Main -->


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>