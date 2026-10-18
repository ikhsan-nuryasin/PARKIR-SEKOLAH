<?php include 'template.php'; include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM kendaraan WHERE id='$id'"));
?>

<a href="kendaraan.php" class="btn btn-secondary mb-3">← Kembali</a>

<div class="card">
<div class="card-header bg-warning">
<h4>Edit Kendaraan</h4>
</div>

<div class="card-body">

<form method="POST">

<select name="user_id" class="form-control mb-2">
<?php
$users = mysqli_query($conn,"SELECT * FROM users WHERE role='user'");
while($u=mysqli_fetch_assoc($users)){
$selected = ($u['id']==$data['user_id'])?'selected':'';
echo "<option value='$u[id]' $selected>$u[nama]</option>";
}
?>
</select>

<input name="plat" class="form-control mb-2" value="<?= $data['plat_nomor'] ?>">

<select name="jenis" class="form-control mb-2">
<option <?= ($data['jenis']=='motor')?'selected':'' ?>>motor</option>
<option <?= ($data['jenis']=='mobil')?'selected':'' ?>>mobil</option>
</select>

<button name="update" class="btn btn-success">Update</button>

</form>

<?php
if(isset($_POST['update'])){
    $user_id=$_POST['user_id'];
    $plat=strtoupper($_POST['plat']);
    $jenis=$_POST['jenis'];

    mysqli_query($conn,"UPDATE kendaraan SET 
    user_id='$user_id',
    plat_nomor='$plat',
    jenis='$jenis'
    WHERE id='$id'");

    echo "<script>alert('Berhasil update');location='kendaraan.php';</script>";
}
?>

</div>
</div>