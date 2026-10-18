<?php
include '../config/koneksi.php';

$qr = $_GET['qr'];

// cari kendaraan
$kendaraan = mysqli_query($conn,"SELECT * FROM kendaraan WHERE qr_code='$qr'");
$data = mysqli_fetch_assoc($kendaraan);

if(!$data){
    echo "Kendaraan tidak ditemukan!";
    exit;
}

// cek apakah sudah masuk
$cek = mysqli_query($conn,"SELECT * FROM parkir WHERE kendaraan_id='{$data['id']}' AND status='masuk'");
$ada = mysqli_fetch_assoc($cek);

if(!$ada){
    // MASUK
    mysqli_query($conn,"INSERT INTO parkir (kendaraan_id,waktu_masuk,status)
    VALUES ('{$data['id']}',NOW(),'masuk')");
    
    echo "Kendaraan MASUK";
} else {
    // KELUAR
    mysqli_query($conn,"UPDATE parkir SET waktu_keluar=NOW(), status='keluar'
    WHERE id='{$ada['id']}'");

    echo "Kendaraan KELUAR";
}
?>
<a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>