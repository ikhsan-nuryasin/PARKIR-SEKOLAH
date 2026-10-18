<?php include 'template.php'; include '../config/koneksi.php'; ?>

<a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

<div class="d-flex justify-content-between mb-2">
<h4>Kendaraan di Parkiran</h4>

</div>

<!-- STATISTIK -->
<?php
$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir WHERE status='masuk'
"))['total'];
?>

<div class="alert alert-info">
🚗 Kendaraan Aktif: <b><?= $total ?></b>
</div>

<!-- SEARCH -->
<input type="text" id="search" class="form-control mb-3" placeholder="Cari plat...">

<div class="card">
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered text-center" id="table">

<tr>
<th>No</th>
<th>Plat</th>
<th>Nama</th>
<th>Masuk</th>
<th>Durasi</th>
<th>Status</th>
</tr>

<?php
$no=1;
$data = mysqli_query($conn,"
SELECT parkir.*, kendaraan.plat_nomor, users.nama 
FROM parkir
JOIN kendaraan ON parkir.kendaraan_id = kendaraan.id
JOIN users ON kendaraan.user_id = users.id
WHERE parkir.status='masuk'
ORDER BY waktu_masuk DESC
");

while($d=mysqli_fetch_assoc($data)){
?>

<tr data-plat="<?= strtolower($d['plat_nomor']) ?>" data-masuk="<?= $d['waktu_masuk'] ?>">
<td><?= $no++ ?></td>
<td><?= $d['plat_nomor'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['waktu_masuk'] ?></td>
<td class="durasi">Loading...</td>
<td><span class="badge bg-warning">Masuk</span></td>
</tr>

<?php } ?>

</table>
</div>

</div>
</div>

<!-- SOUND -->
<audio id="alarm" src="https://www.soundjay.com/buttons/beep-07.mp3"></audio>

<script>
// 🔍 SEARCH REALTIME
document.getElementById("search").addEventListener("keyup", function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll("#table tr[data-plat]").forEach(row => {
        row.style.display = row.dataset.plat.includes(val) ? "" : "none";
    });
});

// ⏱️ DURASI + 🔊 ALARM
function updateDurasi(){
    let now = new Date().getTime();

    document.querySelectorAll("#table tr[data-masuk]").forEach(row => {
        let masuk = new Date(row.dataset.masuk).getTime();
        let diff = now - masuk;

        let jam = Math.floor(diff / (1000*60*60));
        let menit = Math.floor((diff % (1000*60*60)) / (1000*60));

        row.querySelector(".durasi").innerHTML = jam+" jam "+menit+" menit";

        // 🔊 ALARM > 8 JAM
        if(jam >= 8){
            row.style.background = "#ffcccc";

            if(!row.dataset.alarm){
                document.getElementById("alarm").play();
                row.dataset.alarm = "true";
            }
        }
    });
}

// update tiap detik
setInterval(updateDurasi, 1000);
</script>