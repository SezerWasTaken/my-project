<?php
include "../baglan.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // AJAX ile gönderilen verileri al
    $urunID = $_POST["urunID"];
    $yeniStok = $_POST["yeniStok"];

    // Veritabanında güncelleme yap
    $sqlUpdate = "UPDATE urunler SET urunstok = ? WHERE urunid = ?";
    $stmtUpdate = $baglan->prepare($sqlUpdate);

    if ($stmtUpdate->execute([$yeniStok, $urunID])) {
        // Başarılı bir şekilde güncellendiğini belirt
        echo "Stok başarıyla güncellendi!";
    } else {
        // Hata durumunda hata mesajını belirt
        echo "Stok güncelleme hatası: " . $stmtUpdate->errorInfo()[2];
    }
} else {
    // Geçersiz bir istek durumunda hata mesajını belirt
    echo "Geçersiz istek!";
}
