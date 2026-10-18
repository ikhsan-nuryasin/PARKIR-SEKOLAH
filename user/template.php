<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'user'){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>User Parkir</title>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<style>
body {
    background: #f4f6f9;
}
.navbar-brand {
    font-weight: bold;
}
.card {
    border-radius: 12px;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark shadow-sm">
<div class="container">

<span class="navbar-brand">🚗 Parkir Saya</span>

<div>
<span class="text-white me-3">
<?= $_SESSION['user']['nama']; ?>
</span>

<a href="../logout.php" class="btn btn-danger btn-sm">
Logout
</a>
</div>

</div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    </div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>