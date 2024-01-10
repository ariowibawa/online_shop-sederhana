<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['pelanggan'])){
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Belanja</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <!-- navbar -->
    <?php include "menu.php"; ?>    
    <!-- konten -->
<section class="konten"><div class="container">
<h2>Detail Pembelian</h2>
<?php
$ambil = $conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<?php $idpelangganyangbeli = $detail["id_pelanggan"];
    $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
    if($idpelangganyangbeli != $idpelangganyanglogin){
        echo "<script>alert('Maaf, anda tidak berhak melihat nota ini');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }
?>
<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
        Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
        Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan'] ?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan'] ;?>
</p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?php echo $detail['nama_kota']; ?></strong><br>
        Ongkos kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
        Alamat : <?php echo $detail['alamat_pengiriman']; ?>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Sub Berat</th>
            <th>Sub Harga</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor = 1; ?>
        <?php $ambil = $conn->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $tampil['nama']; ?></td>
            <td>Rp. <?php echo number_format($tampil['harga']); ?></td>
            <td><?php echo $tampil['berat']; ?> Gr.</td>
            <td><?php echo $tampil['jumlah']; ?></td>
            <td><?php echo $tampil['subberat']; ?>Gr.</td>
            <td>Rp. <?php echo number_format($tampil['subharga']); ?></td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table> 
<div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan membayar Rp. <?php echo number_format($detail['total_pembelian']); ?> Ke
                            Nomer Rekening 087965123
                        </p>
                    </div>
                </div>
            </div>
        </div> 
</div></section>
</body>
</html>