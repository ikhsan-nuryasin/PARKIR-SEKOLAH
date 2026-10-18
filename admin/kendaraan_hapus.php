<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kendaraan WHERE id='$id'");

header("Location: kendaraan.php");