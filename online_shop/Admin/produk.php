<h2>Data Produk</h2>

<table class="table table-bordered"> 
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $conn->query("SELECT * FROM produk"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $tampil['nama_produk']; ?></td>
            <td><?php echo $tampil['harga_produk']; ?></td>
            <td><?php echo $tampil['berat']; ?></td>
            <td><img src="../foto_produk/<?php echo $tampil['foto_produk']; ?>" width="100"></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $tampil['id_produk']; ?>" class="btn btn-danger" >Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $tampil['id_produk']; ?>" class="btn btn-warning" >Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>  