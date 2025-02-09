<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$NamaPelanggan = $_POST['NamaPelanggan'];
$NomorTelepon = $_POST['NomorTelepon'];
$Alamat = $_POST['Alamat'];
$TanggalPenjualan = $_POST['TanggalPenjualan'];

mysqli_query($koneksi,"insert into pelanggan (PelangganID, NamaPelanggan, Alamat, NomorTelepon) values('$PelangganID','$NamaPelanggan','$Alamat','$NomorTelepon')");
mysqli_query($koneksi,"insert into penjualan (TanggalPenjualan, TotalHarga, UangBayar, Kembalian, PelangganID) values('$TanggalPenjualan', 0 , 0 , 0 ,'$PelangganID')");

header("location:pembelian.php?pesan=simpan");

?>