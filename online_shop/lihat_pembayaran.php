<?php
session_start();
include 'koneksi.php';
$id_pembelian = $_GET["id"];
$ambil = $conn->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian = '$id_pembelian'");
$detbay = $ambil->fetch_assoc();

if(empty($detbay)){
    echo "<script>alert('data tidak ditemukan');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}elseif($detbay['status_pembelian'] == 'pending'){
    echo "<script>alert('lakukan pembayaran terlebih dahulu');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

if($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]){
    echo "<script>alert('anda bukan pelanggan yang membeli');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include "menu.php"; ?>
<div class="container">
    <h3>Lihat Pembayaran</h3>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr><th>Nama</th>
            <td><?php echo $detbay["nama"]; ?></td></tr>
            <tr><th>Bank</th>
            <td><?php echo $detbay["bank"]; ?></td></tr>
            <tr><th>Tanggal</th>
            <td><?php echo $detbay["tanggal"]; ?></td></tr>
            <tr><th>Jumlah</th>
            <td>Rp. <?php echo number_format($detbay["jumlah"]); ?></td></tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="bukti/<?php echo $detbay["bukti"]; ?>" alt="" class="img-responsive">
        </div>
    </div>
</div>    
</body>
</html>