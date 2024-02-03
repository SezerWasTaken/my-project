<?php

$dsn = 'mysql:dbname=market;host=127.0.0.1';
$user = 'root';
$password = '';
// baglanmayı dene
try {
    $baglan = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Bağlantı kurulamadı: ' . $e->getMessage();
}

$path = 'http://localhost/marketstok/';