<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';

$TotalHarga = $_POST['TotalHarga'];
$UangBayar = $_POST['UangBayar'];
$PenjualanID = $_POST['PenjualanID'];
$PelangganID = $_POST['PelangganID'];

$Kembalian = $UangBayar - $TotalHarga;

if (!empty($TotalHarga) && !empty($UangBayar) && !empty($PenjualanID) && !empty($PelangganID)) {

    $query = "UPDATE penjualan SET TotalHarga='$TotalHarga', UangBayar='$UangBayar', Kembalian='$Kembalian' WHERE PenjualanID='$PenjualanID'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Membuka struk...');
        var newWindow = window.open('invoice.php?PenjualanID=$PenjualanID', '_blank');
        if (!newWindow) {
            alert('Pop-up terblokir! Harap izinkan pop-up.');
        }
        window.location.href = 'detail_pembelian.php?PelangganID=$PelangganID&pesan=update_sukses';
     </script>";
     
    } else {
        header("location:detail_pembelian.php?PelangganID=$PelangganID&pesan=update_gagal");
    }
} else {
    header("location:detail_pembelian.php?PelangganID=$PelangganID&pesan=input_kosong");
}

mysqli_close($koneksi);
exit();
?>