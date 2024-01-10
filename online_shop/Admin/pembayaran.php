<h2>Data Pembayaran</h2>
<?php
$id_pembelian = $_GET["id"];
$ambil = $conn->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td><?php echo $detail["nama"] ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detail["bank"] ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detail["jumlah"]) ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti/<?php echo $detail["bukti"] ?>" alt="" class="img-responsive">
    </div>
</div>

<form action="" method="post">
    <div class="form-group">
        <label for="resi">No Resi Pengiriman</label>
        <input type="text" name="resi" id="resi" class="form-control">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
        <option value="">Pilih Status</option>
        <option value="lunas">Lunas</option>
        <option value="barang dikirim">Barang dikirim</option>
        <option value="batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button></button>
</form>
<?php
if(isset($_POST["proses"])){
    $resi = $_POST["resi"];
    $status = $_POST["status"];
    $conn->query("UPDATE pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status' WHERE id_pembelian = '$id_pembelian'");
    echo "<script>alert('data pembelian terupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>