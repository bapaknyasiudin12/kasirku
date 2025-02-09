<?php 
include '../koneksi.php';

$Stok = $_POST['Stok'];
$ProdukID = $_POST['ProdukID'];
$JumlahProduk = $_POST['JumlahProduk'];
$Harga = $_POST['Harga'];
$DetailID = $_POST['DetailID'];
$PelangganID = $_POST['PelangganID'];


$Subtotal = $JumlahProduk * $Harga;
$Stok_total = $Stok - $JumlahProduk;


mysqli_query($koneksi,"update detailpenjualan set Subtotal='$Subtotal', JumlahProduk='$JumlahProduk' where DetailID='$DetailID'");
mysqli_query($koneksi,"update produk set Stok='$Stok_total' where ProdukID='$ProdukID'");

header("location:detail_pembelian.php?PelangganID=$PelangganID");
?>