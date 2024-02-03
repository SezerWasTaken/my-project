<?php

$dsn = 'mysql:dbname=facebook;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $baglan = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Bağlantı kurulamadı: ' . $e->getMessage();
}
