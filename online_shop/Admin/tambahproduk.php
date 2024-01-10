<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label for="berat">Berat (Gr)</label>
        <input type="number" id="berat" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="text" id="stok" class="form-control" name="stok">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>


<?php
if(isset($_POST['save'])){
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi,"../foto_produk/".$nama);
    $conn->query("INSERT INTO produk(nama_produk,harga_produk,berat,foto_produk,deskripsi_produk,stok_produk)
    VALUES ('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]') ");

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv = 'refresh' content ='1;url=index.php?halaman=produk'>";
}
?>