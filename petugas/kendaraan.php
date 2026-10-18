<?php include 'template.php'; include '../config/koneksi.php'; ?>

<a href="dashboard.php" class="btn btn-secondary mb-2">← Kembali</a>

<h4>Input Kendaraan</h4>

<form method="POST" class="mb-3">

<input name="nama" class="form-control mb-2" placeholder="Nama User">

<input name="plat" class="form-control mb-2" placeholder="Plat Nomor">

<select name="jenis" class="form-control mb-2">
<option value="motor">Motor</option>
<option value="mobil">Mobil</option>
</select>

<button name="tambah" class="btn btn-success">Tambah</button>

</form>

<?php
if(isset($_POST['tambah'])){
    $nama=$_POST['nama'];
    $plat=$_POST['plat'];
    $jenis=$_POST['jenis'];

    // cari user berdasarkan nama
    $u = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE nama='$nama'"));

    if(!$u){
        echo "<div class='alert alert-danger'>User tidak ditemukan</div>";
    } else {
        $qr="QR-".rand(1000,9999);

        mysqli_query($conn,"INSERT INTO kendaraan (user_id,plat_nomor,jenis,qr_code)
        VALUES ('{$u['id']}','$plat','$jenis','$qr')");

        echo "<div class='alert alert-success'>Kendaraan berhasil ditambahkan</div>";
    }
}
?>