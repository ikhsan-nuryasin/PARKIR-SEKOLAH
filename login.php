<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login</title>

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<style>
body {
    background: linear-gradient(135deg,#0d6efd,#000);
    height: 100vh;
    display: flex;
    align-items: center;
}

.card {
    border-radius: 15px;
}
</style>

</head>

<body>

<div class="container">
<div class="row justify-content-center">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h4 class="text-center mb-3">Login</h4>

<form method="POST" action="proses_login.php">

<input name="username" class="form-control mb-2" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-primary w-100">Masuk</button>

</form>

<?php
if(isset($_GET['error'])){
    echo "<div class='alert alert-danger mt-2'>Login gagal</div>";
}
?>

</div>

</div>

</div>

</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>