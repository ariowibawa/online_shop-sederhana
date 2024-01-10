<?php
require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman register</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" class="form-horizontal" action="">
                            <div class="form-group">
                                <label for="nama" class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" id="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass" class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="text" id="pass" class="form-control" name="pass" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" id="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp" class="control-label col-md-3">Telp</label>
                                <div class="col-md-7">
                                    <input type="text" id="telp" class="form-control" name="telp" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST['daftar'])){
                            $nama = $_POST['nama'];
                            $email = $_POST['email'];
                            $pass = $_POST['pass'];
                            $alamat = $_POST['alamat'];
                            $telp = $_POST['telp'];

                            $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
                            $yangcocok = $ambil->num_rows;
                            if($yangcocok==1){
                                echo "<script>alert('Email sudah dipakai');</script>";
                                echo "<script>location='daftar.php';</script>";
                            }else{
                                $conn->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat) VALUES ('$email', '$pass', '$nama', '$telp', '$alamat')");
                                echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
                                echo "<script>location='login.php';</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>