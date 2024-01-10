<nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <?php if (isset($_SESSION["pelanggan"])): ?>
                    <li><a href="riwayat.php">Riwayat</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="daftar.php">Daftar</a></li>
                <?php endif ?>
            </ul>
            <form action="pencarian.php" method="get" class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Cari..." name="keyword">
                <button class="btn btn-primary">Cari</button>
            </form>
    </nav>