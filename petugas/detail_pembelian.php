<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
	<div class="card-body">

		<?php
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "update_sukses") { ?>
				<div class="alert alert-success" id="alert-message" role="alert">
					<i class="bi bi-check-circle"></i> Data Berhasil Di Simpan
				</div>
			<?php } ?>
			<?php if ($_GET['pesan'] == "update_gagal") { ?>
				<div class="alert alert-danger" id="alert-message" role="alert">
					<i class="bi bi-x-circle"></i> Data Gagal Di Simpan
				</div>
			<?php } ?>
			<?php if ($_GET['pesan'] == "input_kosong") { ?>
				<div class="alert alert-warning" id="alert-message" role="alert">
					<i class="bi bi-exclamation-triangle"></i> Lengkapi Datanya Dulu!!
				</div>
			<?php } ?>
		<?php
		}
		?>

		<?php
		include '../koneksi.php';
		$PelangganID = $_GET['PelangganID'];
		$no = 1;
		$data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
		while ($d = mysqli_fetch_array($data)) {
		?>
			<?php if ($d['PelangganID'] == $PelangganID) { ?>
				<table>
					<tr>
						<td>ID Transaksi</td>
						<td>: <?php echo $d['PenjualanID']; ?></td>
					</tr>
					<tr>
						<td>ID Pelanggan</td>
						<td>: <?php echo $d['PelangganID']; ?></td>
					</tr>
					<tr>
						<td>Nama Pelanggan</td>
						<td>: <?php echo $d['NamaPelanggan']; ?></td>
					</tr>
					<tr>
						<td>No. Telepon</td>
						<td>: <?php echo $d['NomorTelepon']; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo $d['Alamat']; ?></td>
					</tr>
					<tr>
						<td>Total Pembelian</td>
						<td>: Rp. <?php echo number_format($d['TotalHarga'], 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td>Uang Pembayaran</td>
						<td>: Rp. <?php echo number_format($d['UangBayar'], 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td>Kembalian</td>
						<td>: Rp. <?php echo number_format($d['Kembalian'], 0, ',', '.'); ?></td>
					</tr>

				</table>
				<form method="post" action="tambah_detail_penjualan.php">
					<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
					<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
					<button type="submit" class="btn btn-primary btn-sm mt-2" >
						<i class="bi bi-plus-circle"></i> Tambah Barang
					</button>
				</form>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Makanan & Minuman</th>
							<th>Jumlah Beli</th>
							<th>Sub Total</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include '../koneksi.php';
						$nos = 1;
						$detailpenjualan = mysqli_query($koneksi, "SELECT * FROM detailpenjualan");
						while ($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)) {
						?>
							<?php
							if ($d_detailpenjualan['PenjualanID'] == $d['PenjualanID']) { ?>
								<tr>
									<td><?php echo $nos++; ?></td>
									<td>
										<form action="simpan_barang_beli.php" method="post">
											<div class="form-group">
												<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
												<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
												<select name="ProdukID" class="form-control" onchange="this.form.submit()" >
													<option>--- Pilih Makanan & Minuman ---</option>
													<?php
													include '../koneksi.php';
													$no = 1;
													$produk = mysqli_query($koneksi, "SELECT * FROM produk");
													while ($d_produk = mysqli_fetch_array($produk)) {
													?>
														<option value="<?php echo $d_produk['ProdukID']; ?>" <?php if ($d_produk['ProdukID'] == $d_detailpenjualan['ProdukID']) {
																													echo "selected";
																												} ?>><?php echo $d_produk['NamaProduk']; ?></option>
													<?php } ?>
												</select>
											</div>
										</form>
									</td>
									<td>
										<form method="post" action="hitung_subtotal.php">
											<?php
											include '../koneksi.php';
											$produk = mysqli_query($koneksi, "SELECT * FROM produk");
											while ($d_produk = mysqli_fetch_array($produk)) {
											?>
												<?php
												if ($d_produk['ProdukID'] == $d_detailpenjualan['ProdukID']) { ?>
													<input type="text" name="Harga" value="<?php echo $d_produk['Harga']; ?>" hidden>
													<input type="text" name="ProdukID" value="<?php echo $d_produk['ProdukID']; ?>" hidden>
													<input type="text" name="Stok" value="<?php echo $d_produk['Stok']; ?>" hidden>
											<?php
												}
											}
											?>
											<div class="form-group">
												<input type="number" name="JumlahProduk" value="<?php echo $d_detailpenjualan['JumlahProduk']; ?>" class="form-control" >
											</div>
									</td>
									<td><?php echo $d_detailpenjualan['Subtotal']; ?></td>
									<td>
										<div class="d-flex gap-2">
											<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
											<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
											<button type="submit" class="btn btn-warning btn-sm" ><i class="bi bi-check-circle"></i> Proses</button>
											</form>
											<form method="post" action="hapus_detail_pembelian.php">
												<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
												<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
												<button type="submit" class="btn btn-danger btn-sm" ><i class="bi bi-trash"></i> Hapus</button>
											</form>
										</div>
									</td>
								</tr>
							<?php } else {
							?>
						<?php
							}
						}
						?>
					</tbody>
				</table>
				<form method="post" action="simpan_total_harga.php">
					<?php
					include '../koneksi.php';
					$detailpenjualan = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS TotalHarga FROM detailpenjualan WHERE PenjualanID='$d[PenjualanID]'");
					$row = mysqli_fetch_assoc($detailpenjualan);
					$sum = $row['TotalHarga'];
					?>
					<div class="row">
						<div class="col-sm-10">
							<div class="form-group">
								<label>Total pembayaran</label>
								<input type="text" class="form-control" name="TotalHarga" value="<?php echo $sum; ?>" >
								<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
								<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
							</div>
							<div class="form-group">
								<label>Uang Pembayaran</label>
								<input type="number" class="form-control" name="UangBayar" placeholder="<?php echo $d['UangBayar']; ?>" required >
							</div>
						</div>

						<!-- <div class="row">
							<div class="col-sm-10">

							</div>
						</div> -->
						<div class="col-sm-2">
							<div class="form-group">
								<label for=""></label>
								<button class="btn btn-info btn-sm form-control" type="submit" ><i class="bi bi-save"></i> Simpan</button>
							</div>
						</div>
					</div>
				</form>
			<?php } else { ?>
		<?php
			}
		}
		?>
	</div>
	<script>
		setTimeout(function() {
			var alert = document.getElementById('alert-message');
			if (alert) {
				alert.style.transition = "opacity 0.5s ease";
				alert.style.opacity = "0";
				setTimeout(() => alert.remove(), 500);
			}
		}, 2500); //1s : 1000ms
	</script>
</div>

<?php
include "footer.php";
?>