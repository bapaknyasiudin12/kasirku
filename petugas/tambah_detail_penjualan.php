<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$PenjualanID = $_POST['PenjualanID'];

mysqli_query($koneksi,"insert into detailpenjualan (PenjualanID, ProdukID, JumlahProduk, Subtotal) values('$PenjualanID', 0 , 0 , 0)");

header("location:detail_pembelian.php?PelangganID=$PelangganID");
?>