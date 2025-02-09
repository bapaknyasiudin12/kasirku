<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
	<div class="card-body">
		<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
			<i class="bi bi-plus-circle"></i> Tambah Data
		</button>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.open('cetak_laporan_barang.php', '_blank')">
			<i class="bi bi-printer"></i> Cetak Laporan
		</button>
	</div>
	<div class="card-body">
		<?php
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "simpan") { ?>
				<div class="alert alert-success" id="alert-message" role="alert">
					<i class="bi bi-check-circle"></i> Data Berhasil Di Simpan
				</div>
			<?php } ?>
			<?php if ($_GET['pesan'] == "update") { ?>
				<div class="alert alert-success" id="alert-message" role="alert">
					<i class="bi bi-pencil-square"></i> Data Berhasil Di Update
				</div>
			<?php } ?>
			<?php if ($_GET['pesan'] == "hapus") { ?>
				<div class="alert alert-success" id="alert-message" role="alert">
					<i class="bi bi-trash"></i> Data Berhasil Di Hapus
				</div>
			<?php } ?>
		<?php
		}
		?>
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Makanan & Minuman</th>
					<th>Harga</th>
					<th>Stok</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi, "SELECT * FROM produk");
				while ($d = mysqli_fetch_array($data)) {
					if ($d['Stok'] == 0) {
						$status = "<span class='badge bg-danger'><i class='bi bi-exclamation-triangle'></i> Habis, perlu restock</span>";
					} elseif ($d['Stok'] < 10) {
						$status = "<span class='badge bg-warning text-dark'><i class='bi bi-exclamation-circle'></i> Menipis</span>";
					} else {
						$status = "<span class='badge bg-success'><i class='bi bi-check-circle'></i> Aman</span>";
					}
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['NamaProduk']; ?></td>
						<td>Rp. <?php echo number_format($d['Harga'], 0, ',', '.'); ?></td>
						<td><?php echo $d['Stok']; ?></td>
						<td><?php echo $status; ?></td>
						<td>
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['ProdukID']; ?>">
								<i class="bi bi-pencil"></i> Edit
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['ProdukID']; ?>">
								<i class="bi bi-trash"></i> Hapus
							</button>
						</td>
					</tr>


					<!-- Modal Edit Data-->
					<div class="modal fade" id="edit-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="proses_update_barang.php" method="POST">
									<div class="modal-body">
										<div class="form-group">
											<label>Nama Makanan & Minuman</label>
											<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
											<input type="text" name="NamaProduk" class="form-control" value="<?php echo $d['NamaProduk']; ?>">
										</div>
										<div class="form-group">
											<label>Harga</label>
											<input type="number" name="Harga" class="form-control" value="<?php echo $d['Harga']; ?>">
										</div>
										<div class="form-group">
											<label>Stok</label>
											<input type="number" name="Stok" class="form-control" value="<?php echo $d['Stok']; ?>">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
										<button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Hapus Data-->
					<div class="modal fade" id="hapus-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> Hapus Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form method="post" action="proses_hapus_barang.php">
									<div class="modal-body">
										<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
										Apakah anda yakin akan menghapus data <b><?php echo $d['NamaProduk']; ?></b>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
										<button type="submit" class="btn btn-primary"><i class="bi bi-trash"></i> Hapus</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Tambah Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="proses_simpan_barang.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Makanan & Minuman</label>
						<input type="text" name="NamaProduk" class="form-control">
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" name="Harga" class="form-control">
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="number" name="Stok" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
					<button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
				</div>
			</form>
		</div>
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