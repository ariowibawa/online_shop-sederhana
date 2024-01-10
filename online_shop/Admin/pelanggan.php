<h2>Data Pelanggan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>email</th>
            <th>telepon</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor = 1; ?>
        <?php $ambil = $conn->query("SELECT * FROM pelanggan"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $tampil['nama_pelanggan']; ?></td>
            <td><?php echo $tampil['email_pelanggan']; ?></td>
            <td><?php echo $tampil['telepon_pelanggan']; ?></td>
            <td>
                <a href="" class="btn btn-danger" >Hapus</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>