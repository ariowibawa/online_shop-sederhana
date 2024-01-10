<h2>Ubah Produk</h2>
<?php
$ambil = $conn->query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama" class="form-control" name="nama" value="<?php echo $pecah['nama_produk'] ?>">
    </div>
    <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" class="form-control" name=" harga"value="<?php echo $pecah['harga_produk'] ?>">
    </div>
    <div class="form-group">
        <label for="berat">Berat (Gr)</label>
        <input type="number" id="berat" class="form-control" name="berat" value="<?php echo $pecah['berat'] ?>">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10"><?php echo $pecah['deskripsi_produk'] ?></textarea>
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label for="foto">Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if(isset($_POST['ubah'])){
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    if(!empty($lokasifoto)){
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
        $conn->query("UPDATE produk SET nama_produk ='$_POST[nama]',
        harga_produk = '$_POST[harga]',
        berat = '$_POST[berat]',
        foto_produk = '$namafoto', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk = '$_GET[id]' ");
    }else{
        $conn->query("UPDATE produk SET nama_produk ='$_POST[nama]',
        harga_produk = '$_POST[harga]',
        berat = '$_POST[berat]', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk = '$_GET[id]' ");
    }
    echo "<script>alert('Produk Berhasil diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>