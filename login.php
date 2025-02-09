<?php 
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$query = $koneksi->prepare("SELECT * FROM petugas WHERE username=?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if($result->num_rows > 0){
    $data = $result->fetch_assoc();

    if(md5($password) === $data['password']) {  
 
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_petugas'] = $data['nama_petugas'];
        $_SESSION['level'] = $data['level'];

        if($data['level'] == "1"){
            header("location:administrator/index.php");
        } else if($data['level'] == "2"){
            header("location:petugas/index.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    } else {
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
?>
