<?php include 'template.php'; include '../config/koneksi.php'; ?>

<h4>Dashboard Petugas</h4>

<?php
$max = 100;

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir WHERE status='masuk'
"))['total'];

$sisa = $max - $total;
?>

<div class="row">

<div class="col-md-4">
<div class="card bg-info p-3">
<h5>Total Masuk</h5>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card bg-success p-3">
<h5>Sisa Slot</h5>
<h2><?= $sisa ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card <?= ($sisa<=0)?'bg-danger':'bg-primary' ?> p-3">
<h5>Status</h5>
<h2><?= ($sisa<=0)?"PENUH":"TERSEDIA" ?></h2>
</div>
</div>

</div>

<a href="scan.php" class="btn btn-primary mt-3">Scan QR</a>
<a href="manual.php" class="btn btn-warning mt-3">Input Manual</a>
<a href="log.php" class="btn btn-info mt-3">Log Hari Ini</a>
<a href="kendaraan.php" class="btn btn-info mt-3">kendaraan</a>
<a href="parkiran.php" class="btn btn-dark mt-3">Lihat Parkiran</a>
<a href="../logout.php" class="btn btn-danger">Logout</a>

<?php if($sisa<=0){ ?>
<div class="alert alert-danger mt-3">🚨 PARKIR PENUH</div>
<?php } ?>
<script>
setInterval(() => {
    location.reload();
}, 5000); // refresh tiap 5 detik
</script>
<?php
$inap = mysqli_query($conn,"
SELECT kendaraan.plat_nomor, parkir.waktu_masuk 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id=kendaraan.id
WHERE status='masuk' AND waktu_masuk < NOW() - INTERVAL 10 HOUR
");

if(mysqli_num_rows($inap) > 0){
    echo "<div class='alert alert-warning mt-3'>";
    echo "<b>Kendaraan terlalu lama:</b><br>";

    while($i=mysqli_fetch_assoc($inap)){
        echo $i['plat_nomor']." (".$i['waktu_masuk'].")<br>";
    }

    echo "</div>";
}
?>