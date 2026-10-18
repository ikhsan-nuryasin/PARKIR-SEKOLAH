<?php
include '../config/koneksi.php';
?>

<html>
<head>
    <title>Laporan Parkir</title>
</head>
<body onload="window.print()">

<h2>Laporan Parkir</h2>

<table border="1" width="100%">
<tr>
    <th>No</th>
    <th>Plat</th>
    <th>Jenis</th>
    <th>Masuk</th>
    <th>Keluar</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"SELECT * FROM parkir");

while($d=mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['kendaraan_id'] ?></td>
    <td><?= $d['status'] ?></td>
    <td><?= $d['waktu_masuk'] ?></td>
    <td><?= $d['waktu_keluar'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>