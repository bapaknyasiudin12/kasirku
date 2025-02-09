<?php
session_start();
include '../koneksi.php';

$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : '';
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : '';

$query = "SELECT pelanggan.PelangganID, pelanggan.NamaPelanggan, pelanggan.NomorTelepon, pelanggan.Alamat, penjualan.TotalHarga, penjualan.TanggalPenjualan
          FROM pelanggan
          INNER JOIN penjualan ON pelanggan.PelangganID = penjualan.PelangganID
          WHERE penjualan.TanggalPenjualan BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
$result = mysqli_query($koneksi, $query);
$totalPendapatan = 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Makanan & Minuman Selera Nusantara</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: #007bff;
            color: black;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(odd) {
            background: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="container">
        <h2>Laporan Penjualan</h2>
        <p>Periode: <?php echo date("d-m-Y", strtotime($tgl_mulai)); ?> s/d <?php echo date("d-m-Y", strtotime($tgl_selesai)); ?></p>
        <p>Dicetak Pada: <?php echo date("d-m-Y"); ?></p>
        <p>Dicetak Oleh: <?php echo $_SESSION['nama_petugas']; ?></p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($d = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['PelangganID']; ?></td>
                        <td><?php echo $d['NamaPelanggan']; ?></td>
                        <td><?php echo $d['NomorTelepon']; ?></td>
                        <td><?php echo $d['Alamat']; ?></td>
                        <td><?php echo $d['TanggalPenjualan']; ?></td>
                        <td>Rp. <?php echo number_format($d['TotalHarga'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php $totalPendapatan += $d['TotalHarga']; ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><strong>Total Pendapatan</strong></td>
                    <td><strong>Rp. <?php echo number_format($totalPendapatan, 0, ',', '.'); ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <p class="footer">&copy; <?php echo date("Y"); ?> Selera Nusantara</p>
    </div>
</body>

</html>