<?php
include "header.php";
include "navbar.php";
date_default_timezone_set("Asia/Jakarta");
?>
<div class="card mt-2">
	<div class="card-body">
		<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data" disabled>
		<i class="bi bi-plus-circle"></i> Tambah Data
		</button>
		<button type="button" class="btn btn-primary btn-sm" onclick="cetakLaporan()">
		<i class="bi bi-printer"></i> Cetak Laporan
		</button>

	</div>
	<div class="card-body">
		<div class="col-md-4">
			<label for="">Cetak Mulai Tanggal:</label>
			<input type="date" id="tanggal_mulai" class="form-control form-control-sm">
			<label for="">Sampai Dengan:</label>
			<input type="date" id="tanggal_selesai" class="form-control form-control-sm">
		</div>
	</div>

	<script>
		function cetakLaporan() {
			var tanggalMulai = document.getElementById("tanggal_mulai").value;
			var tanggalSelesai = document.getElementById("tanggal_selesai").value;
			var alertBox = document.getElementById("alertTanggal");

			if (tanggalMulai && tanggalSelesai) {
				window.open('cetak_laporan_penjualan.php?tgl_mulai=' + tanggalMulai + '&tgl_selesai=' + tanggalSelesai, '_blank');
				alertBox.classList.add("d-none");
			} else {
				alertBox.classList.remove("d-none");

				setTimeout(function() {
					alertBox.style.transition = "opacity 0.5s ease";
					alertBox.style.opacity = "0";

					setTimeout(() => {
						alertBox.classList.add("d-none");
						alertBox.style.opacity = "1";
					}, 500);
				}, 3000);
			}
		}
	</script>

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

		<div id="alertTanggal" class="alert alert-danger d-none" role="alert">
		<i class="bi bi-exclamation-triangle"></i> Silakan pilih rentang tanggal terlebih dahulu!
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Transaksi</th>
					<th>ID Pelanggan</th>
					<th>Nama Pelanggan</th>
					<th>No. Telepon</th>
					<th>Alamat</th>
					<th>Total Pembayaran</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
				while ($d = mysqli_fetch_array($data)) {
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['PenjualanID']; ?></td>
						<td><?php echo $d['PelangganID']; ?></td>
						<td><?php echo $d['NamaPelanggan']; ?></td>
						<td><?php echo $d['NomorTelepon']; ?></td>
						<td><?php echo $d['Alamat']; ?></td>
						<td>Rp. <?php echo $d['TotalHarga']; ?></td>
						<td>
							<a class="btn btn-info btn-sm" href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID']; ?>"><i class="bi bi-file-text"></i> Detail</a>
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>" disabled>
							<i class="bi bi-pencil"></i> Edit
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>" disabled>
							<i class="bi bi-trash"></i> Hapus
							</button>
						</td>
					</tr>
					<!-- Modal Edit Data-->
					<div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> >Edit Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="proses_update_pembelian.php" method="post">
									<div class="modal-body">
										<div class="form-group">
											<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" class="form-control" hidden>
										</div>
										<div class="form-group">
											<label>Nama Pelanggan</label>
											<input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan']; ?>" class="form-control">
										</div>
										<div class="form-group">
											<label>No. Telepon</label>
											<input type="text" name="NomorTelepon" value="<?php echo $d['NomorTelepon']; ?>" class="form-control">
										</div>
										<div class="form-group">
											<label>Alamat</label>
											<input type="text" name="Alamat" value="<?php echo $d['Alamat']; ?>" class="form-control">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
										<button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Hapus Data-->
					<div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> Hapus Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form method="post" action="proses_hapus_pembelian.php">
									<div class="modal-body">
										<input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
										Apakah anda yakin akan menghapus data <b><?php echo $d['NamaPelanggan']; ?></b>
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
			<form action="proses_pembelian.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>ID Pelanggan</label>
						<input type="text" name="PelangganID" value="<?php echo date("dmHis") ?>" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nama Pelanggan</label>
						<input type="text" name="NamaPelanggan" class="form-control">
					</div>
					<div class="form-group">
						<label>No. Telepon</label>
						<input type="text" name="NomorTelepon" class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="Alamat" class="form-control">
						<input type="hidden" name="TanggalPenjualan" value="<?php echo date("Y-m-d H:i:s") ?>" class="form-control">
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