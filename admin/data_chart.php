<?php
include '../config/koneksi.php';

// contoh pembagian waktu
$pagi = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir 
WHERE HOUR(waktu_masuk) BETWEEN 6 AND 11
"))['total'];

$siang = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir 
WHERE HOUR(waktu_masuk) BETWEEN 12 AND 15
"))['total'];

$sore = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir 
WHERE HOUR(waktu_masuk) BETWEEN 16 AND 18
"))['total'];

echo json_encode([$pagi, $siang, $sore]);