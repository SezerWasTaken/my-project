<?php

include "baglan.php";

$post_id = $_GET["post_id"];

$postlar = $baglan->prepare("SELECT * FROM post WHERE post_id=?");
$postlar->execute(array($post_id));
$post_cek = $postlar->fetch(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
</head>

<body>

    <!-- Header -->
    <?php include "inc/header.php" ?>
    <!-- Header -->
    <!-- Main -->
    <main>
        <div class="container mt-5">
            <div class="text-center">
                <img src="<?= $post_cek["post_foto"] ?>" height="50%" width="60%" class="rounded" alt="...">
            </div>
            <h5 class="text-center fs-1 my-3"><?= $post_cek["post_baslik"] ?></h5>
            <p class="fs-4"><?= $post_cek["post_aciklama"] ?></p>
        </div>
    </main>
    <!-- Main -->




    <script src="assets/js/script.js"></script>
</body>

</html>