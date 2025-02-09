<?php 
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];

mysqli_query($koneksi,"delete from pelanggan where PelangganID='$PelangganID'");
mysqli_query($koneksi,"delete from penjualan where PelangganID='$PelangganID'");

header("location:pembelian.php?pesan=hapus");

?>