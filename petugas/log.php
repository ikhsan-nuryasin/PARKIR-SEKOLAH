<?php include 'template.php'; include '../config/koneksi.php'; ?>

<h4>Log Hari Ini</h4>
<form method="GET" class="mb-3">
<input name="cari" class="form-control" placeholder="Cari plat...">
</form>

<table class="table table-bordered">
    <tr style="<?= ($d['status']=='masuk')?'background:#ffcccc':'' ?>">
<tr>
<th>Plat</th>
<th>Masuk</th>
<th>Keluar</th>
</tr>

<?php
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$data = mysqli_query($conn,"
SELECT parkir.*, kendaraan.plat_nomor 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id = kendaraan.id
WHERE DATE(waktu_masuk)=CURDATE()
AND kendaraan.plat_nomor LIKE '%$cari%'
ORDER BY waktu_masuk DESC
");

while($d=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $d['plat_nomor'] ?></td>
<td><?= $d['waktu_masuk'] ?></td>
<td><?= $d['waktu_keluar'] ?></td>
</tr>
<?php } ?>
</table>
<a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>