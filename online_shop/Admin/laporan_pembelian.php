<?php
$semuadata = array();
$tglm = "-";
$tgls = "-";
if(isset($_POST["kirim"])) {
    $tglm = $_POST["tglm"];
    $tgls = $_POST["tgls"];
    $conn = $conn->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.tanggal_pembelian BETWEEN '$tglm' AND '$tgls'");
    while($ambil = $conn->fetch_assoc()) {
        $semuadata[] = $ambil;
}}
?>

<h2>Laporan Pembelian <?php echo $tglm; ?> hingga <?php echo $tgls; ?></h2>
<br>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
            <label for="">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tglm">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls">
            </div>
        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($semuadata as $key => $value):?>
        <?php $total += $value['total_pembelian']; ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value['nama_pelanggan']; ?></td>
            <td><?php echo $value['tanggal_pembelian']; ?></td>
            <td>Rp. <?php echo number_format($value['total_pembelian']); ?></td>
            <td><?php echo $value['status_pembelian']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th colspan="2">Rp. <?php echo number_format($total); ?></th>
        </tr>
    </tfoot>
</table>