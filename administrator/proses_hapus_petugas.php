<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];

mysqli_query($koneksi,"delete from petugas where id_petugas='$id_petugas'");

header("location:data_pengguna.php?pesan=hapus");

?>