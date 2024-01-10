<h2>Data Pembelian</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No </th>
            <th>Nama pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pembayaran</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $tampil['nama_pelanggan']; ?></td>
            <td><?php echo $tampil['tanggal_pembelian']; ?></td>
            <td><?php echo $tampil['status_pembelian']; ?></td>
            <td><?php echo $tampil['total_pembelian']; ?></td>
            <td>
                <?php if($tampil ['status_pembelian'] !== "pending"): ?>
                <a href="index.php?halaman=pembayaran&id=<?php echo $tampil['id_pembelian']; ?>" class="btn btn-success">Lihat pembayaran</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>