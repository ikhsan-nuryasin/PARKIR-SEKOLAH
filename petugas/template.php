<?php
session_start();
if($_SESSION['user']['role'] != 'petugas'){
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Petugas Parkir</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

<nav class="navbar navbar-dark bg-dark">
<span class="navbar-brand">Petugas Parkir</span>
</nav>

<div class="container mt-3">