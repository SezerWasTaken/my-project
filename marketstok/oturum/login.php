<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session başlat
session_start();

// baglan.php'den bağlantı çekiyoruz.
require_once("../baglan.php");
$hatamsj = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_mail = filter_var($_POST["kullanici_mail"], FILTER_SANITIZE_EMAIL);
    $kullanici_sifre = $_POST["kullanici_sifre"];
    $hashed_password = hash('sha256', $kullanici_sifre);

    if ($kullanici_mail == "" || $kullanici_sifre == "") {
        echo "Boş yer bırakmayın";
        exit();
    }

    $login_sql = "SELECT * FROM kullanicilar WHERE kullanici_mail = :mail";

    $login_stmt = $baglan->prepare($login_sql);

    $login_stmt->bindParam(':mail', $kullanici_mail);

    $login_stmt->execute();

    $user = $login_stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($hashed_password == $user['kullanici_sifre']) {
            echo "<script>
            alert('Giriş başarılı. Hoşgeldiniz.');
            </script>";

            $_SESSION['user_mail'] = $user['kullanici_mail'];
            $_SESSION['user_password'] = $user['kullanici_sifre'];
            $_SESSION['user_id'] = $user['kullanici_id']; // Kullanıcı ID'sini ekleyin

            header("location: http://localhost/marketstok/urunler.php");
            exit();
        } else {
            echo "Giriş yapılamadı, şifre yanlış";
        }
    } else {
        echo "Giriş yapılamadı, kullanıcı bulunamadı";
    }
}
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Stok Programı - Kayıt Ol</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Navbar start -->
    <?php include "../inc/header.php" ?>
    <!-- Navbar end -->
    <?php if (isset($_SESSION["user_mail"])) {
        $hatamsj = "
        <div class=\"alert alert-danger mt-3 mx-3\" role=\"alert\">
        Zaten giriş yaptığınız için bu sayfaya giremezsiniz
        </div>";
        echo $hatamsj;
    } else {
    ?>
        <div class="container mt-5">
            <form class="row g-3" method="post">
                <div class="col-md-12">
                    <label for="kullanici_mail" class="form-label">E-Posta adresiniz</label>
                    <input name="kullanici_mail" type="email" class="form-control" value="">
                </div>
                <div class="col-md-12">
                    <label for="kullanici_sifre" class="form-label">Şifreniz</label>
                    <input name="kullanici_sifre" type="password" class="form-control" value="">
                </div>
                <div class="col-12">
                    <button name="giris" type="submit" class="btn btn-primary w-100">Giriş yap</button>
                </div>
            </form>
        </div>
    <?php } ?>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>