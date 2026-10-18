<?php
session_start();
include 'config/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($conn,"SELECT * FROM users 
WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($data);

if($cek > 0){
    $user = mysqli_fetch_assoc($data);
    $_SESSION['user'] = $user;

    if($user['role'] == 'admin'){
        header("Location: admin/dashboard.php");
    } elseif($user['role'] == 'petugas'){
        header("Location: petugas/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }

} else {
    header("Location: login.php?error=1");
}