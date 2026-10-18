
<?php include 'template.php'; include '../config/koneksi.php'; ?>

<div class="card">
<div class="card-header bg-primary text-white">
<h4>Manajemen User</h4>
</div>

<div class="card-body">

<!-- FORM TAMBAH -->
<form method="POST" class="mb-4">
<div class="row">

<div class="col-md-3">
<input class="form-control" name="nama" placeholder="Nama" required>
</div>

<div class="col-md-3">
<input class="form-control" name="username" placeholder="Username" required>
</div>

<div class="col-md-2">
<input class="form-control" name="password" placeholder="Password" required>
</div>

<div class="col-md-2">
<select class="form-control" name="role">
<option>admin</option>
<option>petugas</option>
<option>user</option>
</select>
</div>

<div class="col-md-2">
<button class="btn btn-success w-100" name="tambah">Tambah</button>
</div>

</div>
</form>

<?php
if(isset($_POST['tambah'])){
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $role=$_POST['role'];

    // VALIDASI USERNAME
    $cek = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        echo "<div class='alert alert-danger'>Username sudah digunakan!</div>";
    } else {
        mysqli_query($conn,"INSERT INTO users (nama,username,password,role)
        VALUES ('$nama','$username','$password','$role')");
        echo "<div class='alert alert-success'>User berhasil ditambahkan!</div>";
    }
}
?>

<!-- TABLE -->
<table class="table table-bordered table-hover">
<thead class="table-dark">
<tr>
<th>No</th>
<th>Nama</th>
<th>Username</th>
<th>Role</th>
<th>Aksi</th>
</tr>
</thead>

<?php
$no=1;
$data=mysqli_query($conn,"SELECT * FROM users");
while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['username'] ?></td>
<td><?= $d['role'] ?></td>
<td>
<a href="user_edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="user_hapus.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>
</tr>

<?php } ?>
</table>

</div>
</div><script>
$(document).ready(function() {
    $('table').DataTable();
});
</script>