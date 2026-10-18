<?php include 'template.php'; include '../config/koneksi.php'; ?>

<h3>Dashboard</h3>

<?php
$max = 100;

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total FROM parkir WHERE status='masuk'
"))['total'];

$sisa = $max - $total;
?>

<div class="row">

<div class="col-md-4">
<div class="card bg-info p-3">
<h4>Total Kendaraan Masuk</h4>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card bg-success p-3">
<h4>Sisa Slot</h4>
<h2><?= $sisa ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card bg-danger p-3">
<h4>Status</h4>
<h2><?= ($sisa <= 0) ? "PENUH" : "TERSEDIA" ?></h2>
</div>
</div>

</div>

<?php if($sisa <= 0){ ?>
<div class="alert alert-danger">🚨 PARKIR PENUH!</div>
<?php } ?>

<div style="width:1000px; height:400px;">
<canvas id="chart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let chart;

function loadChart(){
    fetch("data_chart.php")
    .then(res => res.json())
    .then(data => {

        if(chart){
            chart.data.datasets[0].data = data;
            chart.update();
        } else {

            chart = new Chart(document.getElementById("chart"), {
                type: 'bar',
                data: {
                    labels: ["Pagi","Siang","Sore"],
                    datasets: [{
                        label: "Kendaraan",
                        data: data
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

        }

    });
}

// load pertama
loadChart();

// auto refresh tiap 5 detik
setInterval(loadChart, 5000);
</script>