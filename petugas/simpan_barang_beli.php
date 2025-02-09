<?php 
include '../koneksi.php';

$ProdukID = $_POST['ProdukID'];
$DetailID = $_POST['DetailID'];
$PelangganID = $_POST['PelangganID'];

mysqli_query($koneksi,"update detailpenjualan set ProdukID='$ProdukID' where DetailID='$DetailID'");

header("location:detail_pembelian.php?PelangganID=$PelangganID");
?>