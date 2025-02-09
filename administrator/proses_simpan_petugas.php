<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../koneksi.php';

$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

mysqli_query($koneksi,"insert into petugas (nama_petugas, username, password, level) values('$nama_petugas','$username','$password','$level')");

header("location:data_pengguna.php?pesan=simpan");

?>