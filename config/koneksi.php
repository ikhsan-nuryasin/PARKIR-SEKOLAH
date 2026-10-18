<?php
$conn = mysqli_connect("localhost","root","","parkir_sekolah");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>