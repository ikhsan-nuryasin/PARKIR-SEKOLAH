<?php include 'template.php'; include '../config/koneksi.php'; ?>

<h4>Input Manual Plat</h4>

<form method="POST">
<input name="plat" autofocus class="form-control mb-2" placeholder="Masukkan Plat">
<button name="cek" class="btn btn-primary">Proses</button>
</form>

<?php
if(isset($_POST['cek'])){
    $plat=$_POST['plat'];

    $k = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM kendaraan WHERE plat_nomor='$plat'
    "));

    if(!$k){
        echo "<div class='alert alert-danger'>Plat tidak ditemukan</div>";
    } else {

        $cek = mysqli_fetch_assoc(mysqli_query($conn,"
        SELECT * FROM parkir 
        WHERE kendaraan_id='{$k['id']}' AND status='masuk'
        "));

        if(!$cek){
            mysqli_query($conn,"INSERT INTO parkir (kendaraan_id,waktu_masuk,status)
            VALUES ('{$k['id']}',NOW(),'masuk')");
            echo "<div class='alert alert-success'>MASUK</div>";
        } else {
            mysqli_query($conn,"UPDATE parkir SET waktu_keluar=NOW(), status='keluar'
            WHERE id='{$cek['id']}'");
            echo "<div class='alert alert-warning'>KELUAR</div>";
        }
    }
}
?>

<a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>