<?php include 'template.php'; ?>

<h4>Scan QR Kendaraan</h4>

<div id="reader" style="width:300px;"></div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
function onScanSuccess(decodedText) {
    fetch("proses_scan.php?qr=" + decodedText)
    .then(res => res.text())
    .then(data => {
        alert(data);
        location.href="dashboard.php";
    });
}

new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
}).render(onScanSuccess);
function onScanSuccess(decodedText) {
    document.getElementById("beep").play();

    fetch("proses_scan.php?qr=" + decodedText)
    .then(res => res.text())
    .then(data => {
        alert(data);
        location.href="dashboard.php";
    });
}
</script>
<audio id="beep" src="https://www.soundjay.com/buttons/beep-07.mp3"></audio>
<a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>