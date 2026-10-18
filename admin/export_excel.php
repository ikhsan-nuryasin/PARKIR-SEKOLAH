<?php
include '../config/koneksi.php';

// header biar jadi file excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_parkir.xls");

?>

<h2>Laporan Parkir</h2>

<table border="1">
<tr>
    <th>No</th>
    <th>Plat Nomor</th>
    <th>Jenis</th>
    <th>Waktu Masuk</th>
    <th>Waktu Keluar</th>
    <th>Status</th>
</tr>

<?php
$no = 1;
$query = mysqli_query($conn,"
SELECT parkir.*, kendaraan.plat_nomor, kendaraan.jenis 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id = kendaraan.id
ORDER BY waktu_masuk DESC
");

while($data = mysqli_fetch_assoc($query)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $data['plat_nomor'] ?></td>
    <td><?= $data['jenis'] ?></td>
    <td><?= $data['waktu_masuk'] ?></td>
    <td><?= $data['waktu_keluar'] ?></td>
    <td><?= $data['status'] ?></td>
</tr>
<?php } ?>

</table>