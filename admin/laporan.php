<?php include 'template.php'; include '../config/koneksi.php'; ?>

<h3>Laporan Parkir</h3>

<a href="export_excel.php" class="btn btn-success">Download Excel</a>

<table class="table table-striped mt-3">
<tr>
<th>No</th>
<th>Plat</th>
<th>Masuk</th>
<th>Keluar</th>
<th>Status</th>
</tr>

<?php
$no=1;
$data=mysqli_query($conn,"
SELECT parkir.*, kendaraan.plat_nomor 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id = kendaraan.id
");

while($d=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['plat_nomor'] ?></td>
<td><?= $d['waktu_masuk'] ?></td>
<td><?= $d['waktu_keluar'] ?></td>
<td><?= $d['status'] ?></td>
</tr>
<?php } ?>
</table>