<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';

$NamaProduk = $_POST['NamaProduk'];
$Harga = $_POST['Harga'];
$Stok = $_POST['Stok'];

mysqli_query($koneksi,"insert into produk (NamaProduk, Harga, Stok) values('$NamaProduk','$Harga','$Stok')");

header("location:data_barang.php?pesan=simpan");

?>