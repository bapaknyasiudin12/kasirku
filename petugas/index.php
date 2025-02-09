<?php
session_start();
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						Data Makanan & Minuman
						<?php
						include '../koneksi.php';
						$data_produk = mysqli_query($koneksi, "SELECT * FROM produk");
						$jumlah_produk = mysqli_num_rows($data_produk);
						?>
						<h3><?php echo $jumlah_produk; ?></h3>
						<a href="data_barang.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-text"></i> Detail</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						Data Pembelian
						<?php
						include '../koneksi.php';
						$data_penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
						$jumlah_penjualan = mysqli_num_rows($data_penjualan);
						?>
						<h3><?php echo $jumlah_penjualan; ?></h3>
						<a href="pembelian.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-text"></i> Detail</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						Data Pelanggan
						<?php
						include '../koneksi.php';
						$data_petugas = mysqli_query($koneksi, "SELECT * FROM pelanggan");
						$jumlah_petugas = mysqli_num_rows($data_petugas);
						?>
						<h3><?php echo $jumlah_petugas; ?></h3>
						<a href="pembelian.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-text"></i> Detail</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card mt-2">
	<div class="card-body">
		<p>Hi!, <?php echo $_SESSION['nama_petugas']; ?>. Selamat Datang di Halaman Petugas!</p>
	</div>
</div>
<?php
include "footer.php";
?>