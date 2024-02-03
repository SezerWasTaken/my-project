<?php
include 'baglan.php';

$sql = 'DELETE FROM `post` WHERE `post`.`post_id` = ?;';
$sorgu = $baglan->prepare($sql);
$sorgu->execute();
$postListele = $sorgu->fetchAll(PDO::FETCH_ASSOC);

?>