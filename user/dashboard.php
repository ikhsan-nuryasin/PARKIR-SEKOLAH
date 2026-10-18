<?php include 'template.php'; include '../config/koneksi.php'; ?>

<?php $user = $_SESSION['user']['id']; ?>

<style>
.card-hover:hover {
    transform: scale(1.02);
    transition: 0.3s;
}
.qr-img {
    width: 120px;
}
@media (max-width:768px){
    .qr-img {
        width: 100px;
    }
}
</style>

<div class="container">

<h4 class="mb-3">Dashboard Saya</h4>

<!-- STATUS -->
<div class="row text-center g-2">

<div class="col-6">
<div class="card shadow-sm border-0 p-2">
<h6>Status</h6>

<?php
$status = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT parkir.status 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id = kendaraan.id
WHERE kendaraan.user_id='$user'
ORDER BY parkir.id DESC LIMIT 1
"));

if($status && $status['status']=='masuk'){
    echo "<span class='badge bg-warning'>Sedang Parkir</span>";
} else {
    echo "<span class='badge bg-success'>Tidak Parkir</span>";
}
?>

</div>
</div>

<div class="col-6">
<div class="card shadow-sm border-0 p-2">
<h6>Total Kendaraan</h6>

<?php
$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM kendaraan WHERE user_id='$user'
"))['total'];
?>

<h5><?= $total ?></h5>

</div>
</div>

</div>

<!-- KARTU PARKIR PREMIUM -->
<h5 class="mt-4">Kartu Parkir</h5>

<div class="row">

<?php
$data = mysqli_query($conn,"SELECT * FROM kendaraan WHERE user_id='$user'");
while($d=mysqli_fetch_assoc($data)){
?>

<div class="col-md-4 col-12 mb-3">
<div class="card text-white shadow card-hover"
style="border-radius:15px; background: linear-gradient(135deg,#343a40,#000);">

<div class="card-body text-center">

<h6><?= $d['plat_nomor'] ?></h6>
<p class="small"><?= strtoupper($d['jenis']) ?></p>

<img class="qr-img"
src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $d['qr_code'] ?>">

<p class="mt-2 small"><?= $d['qr_code'] ?></p>

<a href="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= $d['qr_code'] ?>"
download="QR-<?= $d['plat_nomor'] ?>.png"
class="btn btn-light btn-sm mt-2">
Download
</a>

</div>

</div>
</div>

<?php } ?>

</div>

<!-- RIWAYAT -->
<h5 class="mt-4">Riwayat Parkir</h5>

<div class="card shadow-sm border-0">
<div class="card-body p-2">

<div class="table-responsive">

<table class="table table-sm text-center">
<tr>
<th>Plat</th>
<th>Masuk</th>
<th>Keluar</th>
</tr>

<?php
$data = mysqli_query($conn,"
SELECT parkir.*, kendaraan.plat_nomor 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id=kendaraan.id
WHERE kendaraan.user_id='$user'
ORDER BY waktu_masuk DESC LIMIT 5
");

while($d=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $d['plat_nomor'] ?></td>
<td><?= date('H:i', strtotime($d['waktu_masuk'])) ?></td>
<td><?= $d['waktu_keluar'] ? date('H:i', strtotime($d['waktu_keluar'])) : '-' ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>
</div>

</div>