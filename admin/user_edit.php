<?php include 'template.php'; include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE id='$id'"));
?>

<div class="card">
<div class="card-header bg-warning">
<h4>Edit User</h4>
</div>

<div class="card-body">

<form method="POST">

<input type="hidden" name="id" value="<?= $data['id'] ?>">

<input class="form-control mb-2" name="nama" value="<?= $data['nama'] ?>">

<input class="form-control mb-2" name="username" value="<?= $data['username'] ?>">

<input class="form-control mb-2" name="password" placeholder="Kosongkan jika tidak diubah">

<select class="form-control mb-2" name="role">
<option <?= ($data['role']=='admin')?'selected':'' ?>>admin</option>
<option <?= ($data['role']=='petugas')?'selected':'' ?>>petugas</option>
<option <?= ($data['role']=='user')?'selected':'' ?>>user</option>
</select>

<button class="btn btn-success" name="update">Update</button>

</form>

<?php
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $role=$_POST['role'];

    if($_POST['password'] != ""){
        $password = md5($_POST['password']);
        mysqli_query($conn,"UPDATE users SET 
        nama='$nama',
        username='$username',
        password='$password',
        role='$role'
        WHERE id='$id'");
    } else {
        mysqli_query($conn,"UPDATE users SET 
        nama='$nama',
        username='$username',
        role='$role'
        WHERE id='$id'");
    }

    echo "<script>alert('Berhasil update');location='user.php';</script>";
}
?>

</div>
</div>