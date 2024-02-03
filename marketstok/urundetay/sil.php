<?php
include '../baglan.php';

$sql = 'DELETE FROM `urunler` WHERE `urunler`.`urunid` = ?';
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
$urunListele = $sorgu->fetchAll(PDO::FETCH_ASSOC);
