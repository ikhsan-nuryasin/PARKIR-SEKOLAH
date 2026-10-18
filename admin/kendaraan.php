<?php include 'template.php'; include '../config/koneksi.php'; ?>

<div class="container-fluid">

<h3 class="mb-3">Manajemen Kendaraan</h3>

<div class="row">

<!-- FORM TAMBAH -->
<div class="col-md-4">
<div class="card">
<div class="card-header bg-primary text-white">Tambah Kendaraan</div>
<div class="card-body">

<form method="POST">

<select name="user_id" class="form-control mb-2" required>
<option value="">-- Pilih User --</option>
<?php
$users = mysqli_query($conn,"SELECT * FROM users WHERE role='user'");
while($u=mysqli_fetch_assoc($users)){
echo "<option value='$u[id]'>$u[nama]</option>";
}
?>
</select>

<input name="plat" class="form-control mb-2" placeholder="Plat Nomor" required>

<select name="jenis" class="form-control mb-2">
<option value="motor">Motor</option>
<option value="mobil">Mobil</option>
</select>

<button class="btn btn-success w-100" name="tambah">Tambah</button>

</form>

<?php
if(isset($_POST['tambah'])){
    $user_id = $_POST['user_id'];
    $plat = strtoupper($_POST['plat']);
    $jenis = $_POST['jenis'];

    $cek = mysqli_query($conn,"SELECT * FROM kendaraan WHERE plat_nomor='$plat'");
    if(mysqli_num_rows($cek) > 0){
        echo "<div class='alert alert-danger mt-2'>Plat sudah terdaftar!</div>";
    } else {
        $qr = "QR-".uniqid();
        mysqli_query($conn,"INSERT INTO kendaraan (user_id,plat_nomor,jenis,qr_code)
        VALUES ('$user_id','$plat','$jenis','$qr')");
        echo "<div class='alert alert-success mt-2'>Berhasil ditambahkan!</div>";
    }
}
?>

</div>
</div>
</div>

<!-- CHART -->
<div class="col-md-8">
<div class="card">
<div class="card-header bg-info text-white">Statistik Kendaraan</div>
<div class="card-body">

<?php
$motor = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kendaraan WHERE jenis='motor'"))['total'];
$mobil = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kendaraan WHERE jenis='mobil'"))['total'];
?>
<div style="max-width:175px; margin:auto;">
    <canvas id="chart"></canvas>
</div>
</div>
</div>
</div>

</div>

<!-- FILTER -->
<div class="card mt-3">
<div class="card-body">

<form method="GET" class="form-inline">

<select name="user_filter" class="form-control mr-2">

<option value="">Semua User</option>

<?php
$users = mysqli_query($conn,"SELECT * FROM users WHERE role='user'");
while($u=mysqli_fetch_assoc($users)){
$selected = (isset($_GET['user_filter']) && $_GET['user_filter']==$u['id']) ? 'selected' : '';
echo "<option value='$u[id]' $selected>$u[nama]</option>";
}
?>

</select>

<button class="btn btn-primary">Filter</button>

</form>

</div>
</div>

<?php
$where = "";
if(isset($_GET['user_filter']) && $_GET['user_filter'] != ""){
    $id = $_GET['user_filter'];
    $where = "WHERE kendaraan.user_id='$id'";
}

$data = mysqli_query($conn,"
SELECT kendaraan.*, users.nama 
FROM kendaraan
JOIN users ON kendaraan.user_id = users.id
$where
");
?>

<!-- TABLE -->
<div class="card">
<div class="card-header bg-dark text-white">Data Kendaraan</div>
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-hover text-center">

<thead class="thead-dark">
<tr>
<th>No</th>
<th>Nama</th>
<th>Plat</th>
<th>Jenis</th>
<th>QR</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['plat_nomor'] ?></td>
<td><?= $d['jenis'] ?></td>

<td>
<img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?= $d['qr_code'] ?>"><br>

<a href="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= $d['qr_code'] ?>"
download="QR-<?= $d['plat_nomor'] ?>.png"
class="btn btn-success btn-sm mt-1">
Download
</a>
</td>

<td>
<a href="kendaraan_edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="kendaraan_hapus.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>

</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById("chart"), {
type: 'doughnut',
data: {
labels: ["Motor", "Mobil"],
datasets: [{
data: [<?= $motor ?>, <?= $mobil ?>]
}]
}
});

new Chart(document.getElementById("chart"), {
    type: 'doughnut',
    data: {
        labels: ["Motor", "Mobil"],
        datasets: [{
            data: [<?= $motor ?>, <?= $mobil ?>]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>