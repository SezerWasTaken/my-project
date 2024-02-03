<?php

include "../baglan.php";
session_start();

if (isset($_GET["sil"])) {
    $sqlsil = "DELETE FROM urunler WHERE urunid = ?";
    $sorgusil = $baglan->prepare($sqlsil);
    $sorgusil->execute([$_GET["sil"]]);

    header('Location: urundetay.php');
}

$sql = "SELECT urunler.*, kullanicilar.kullanici_ad
FROM urunler
LEFT JOIN kullanicilar ON kullanicilar.kullanici_id = urunler.urunkid
ORDER BY urunler.urunid ASC";
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Şeker Market</title>
    <!-- Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php include '../inc/header.php'; ?>
    <?php if (isset($_SESSION["user_mail"])) { ?>
        <!-- Header -->
        <header>
            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <h1 class="display-1 text-center">Şeker market</h1>
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
                                    <th>Urun İd</th>
                                    <th>Urun Adi</th>
                                    <th>Urun Ücreti</th>
                                    <th>Urun Stok</th>
                                    <th>Urun Kodu</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <?php if ($_SESSION["user_id"] == $satir['urunkid']) { ?>
                                        <tr>
                                            <td><?= $satir['urunid'] ?></td>
                                            <td><?= $satir['urunadi'] ?></td>
                                            <td><?= $satir['urunucreti'] ?> ₺</td>
                                            <td contenteditable="true" class="editable" data-urunid="<?= $satir['urunid'] ?>"><?= $satir['urunstok'] ?></td>
                                            <td><?= $satir['urunkodu'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="http://localhost/marketstok/urundetay/urunduzenle.php?urunid=<?= $satir['urunid'] ?>" class="btn btn-primary">Düzenle</a>
                                                    <a type="button" href="urundetay.php?sil=<?= $satir["urunid"] ?>" onclick="return confirm('silinsin mi ?')" class="btn btn-danger">Sil</a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main -->

    <?php } else {
        $hatamsj = "
    <div class=\"alert alert-danger mt-3 mx-3\" role=\"alert\">
    Üye Olmadığınız & Giriş Yapmadığınız için ürün ekleyemezsiniz.
    </div>";
        echo $hatamsj;
    }
    ?>


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Tablodaki düzenlenebilir hücrelere yapılan değişiklikleri yakala
            $('.editable').on('input', function() {
                var urunID = $(this).data('urunid');
                var yeniStok = $(this).text();

                // AJAX kullanarak veritabanında güncelleme işlemi yap
                $.ajax({
                    type: 'POST',
                    url: 'stok_guncelle.php', // Bu dosyayı oluşturmanız gerekecek
                    data: {
                        urunID: urunID,
                        yeniStok: yeniStok
                    },
                    success: function(response) {
                        // Başarılı bir şekilde güncellendiğinde buraya bir işlem ekleyebilirsiniz
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>

</html>