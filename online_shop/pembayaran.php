<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$idpem = $_GET['id'];
$ambil = $conn->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem'");
$detail = $ambil->fetch_assoc();

$id_pelanggan_beli = $detail['id_pelanggan'];
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

if($id_pelanggan_beli != $id_pelanggan_login){
    echo "<script>alert('Maaf, anda tidak berhak melihat nota ini');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include "menu.php"; ?>
<div class="container">
    <h2>Konfirmasi pembayaran</h2>
    <p>Kirim bukti pembayaran Anda disini</p>
    <div class="alert alert-info">Total tagihan anda : Rp. <?php echo number_format($detail['total_pembelian']); ?></div>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama Penyetor</label>
            <input type="text" id="nama" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label for="bank">Bank</label>
            <input type="text" id="bank" class="form-control" name="bank">
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" class="form-control" name="jumlah" min="1">
        </div>
        <div class="form-group">
            <label for="bukti">Bukti transfer</label>
            <input type="file" id="bukti" name="bukti" class="form-control">
            <p class="text-danger">Ekstensi yang diperbolehkan .png | .jpg | .jpeg maksimal 4mb</p></p>
</div>
<div>
    <input type="submit" name="kirim" value="Kirim" class="btn btn-primary">
</div>
</form>
</div>
</div>
<?php
if(isset($_POST['kirim'])){
    $namabukti = $_FILES['bukti']['name'];
    $lokasibukti = $_FILES['bukti']['tmp_name'];
    $namafiks = date('YmdHis').$namabukti;
    move_uploaded_file($lokasibukti, 'bukti/'.$namafiks);
    $namapembeli = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tgl_bayar = date('Y-m-d');
    $kirim = $conn->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem', '$namapembeli', '$bank', '$jumlah', '$tgl_bayar', '$namafiks')");

    if($kirim){
        $conn->query("UPDATE pembelian SET status_pembelian='Terbayar' WHERE id_pembelian='$idpem'");
        echo "<script>alert('Terimakasih, pembayaranmu akan segera di proses');</script>";
        echo "<script>location='riwayat.php';</script>";
    }
}
?>
</body>
</html>