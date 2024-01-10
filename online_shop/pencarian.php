<?php
include 'koneksi.php';
$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
$semuadata = array();
if ($keyword) {
    $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'";
    $query = $conn->query($sql);
}else{
    echo "<script>alert('Masukkan kata kunci pencarian');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}
while($pecah = $query->fetch_assoc()) {
    $semuadata[] = $pecah;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include "menu.php"; ?>
<div class="container">
    <h3>Hasil pencarian : <?php echo $keyword; ?></h3>
    <?php if(empty($semuadata)): ?>
    <div class="alert alert-danger">Produk <strong><?php echo $keyword; ?></strong> tidak ditemukan</div>
    <?php endif; ?>
    <?php foreach ($semuadata as $key => $value): ?>
    <div class="col-md-3">
        <div class="thumbnail">
        <img src="foto_produk/<?php echo $value['foto_produk']; ?>" class="img-responsive">
        <div class="caption">
            <h3><?php echo $value['nama_produk']; ?></h3>
            <h5>Rp. <?php echo number_format($value['harga_produk']); ?></h5>
            <a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
            <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-default">Detail</a>
        </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>