<?php
session_start();
if($_SESSION['user']['role'] != 'admin'){
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Parkir</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('table').DataTable();
});
</script>
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-dark bg-dark">
  <span class="navbar-brand">Admin Parkir</span>
</nav>

<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary">
  <a class="brand-link text-center">MENU</a>
  <div class="sidebar">
    <ul class="nav flex-column">
      <li><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
      <li><a href="kendaraan.php" class="nav-link text-white">Kendaraan</a></li>
      <li><a href="user.php" class="nav-link text-white">Users</a></li>
      <li><a href="laporan.php" class="nav-link text-white">Laporan</a></li>
      <li><a href="../logout.php" class="nav-link text-danger">Logout</a></li>
    </ul>
  </div>
</aside>

<div class="content-wrapper p-3">