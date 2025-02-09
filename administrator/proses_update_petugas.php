<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$level = $_POST['level'];

if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', password='$password', level='$level' WHERE id_petugas='$id_petugas'");
} else {
    mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', level='$level' WHERE id_petugas='$id_petugas'");
}

header("location:data_pengguna.php?pesan=update");

?>
