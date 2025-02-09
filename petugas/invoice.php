<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../koneksi.php';

if (!isset($_GET['PenjualanID'])) {
    die("Error: PenjualanID tidak ditemukan.");
}

$PenjualanID = $_GET['PenjualanID'];

$query = "SELECT p.*, pel.NamaPelanggan, pel.Alamat, pel.NomorTelepon 
          FROM penjualan p 
          JOIN pelanggan pel ON p.PelangganID = pel.PelangganID
          WHERE p.PenjualanID = '$PenjualanID'";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error Query: " . mysqli_error($koneksi));
}

$d = mysqli_fetch_assoc($result);
if (!$d) {
    die("Error: Data tidak ditemukan untuk PenjualanID = $PenjualanID");
}

$PelangganID = $d['PelangganID'];
$TanggalPenjualan = date('Y-m-d H:i:s', strtotime($d['TanggalPenjualan']));

$detail = mysqli_query($koneksi, "SELECT dp.*, pr.NamaProduk, pr.Harga 
                                  FROM detailpenjualan dp 
                                  JOIN produk pr ON dp.ProdukID = pr.ProdukID 
                                  WHERE dp.PenjualanID='$PenjualanID'");

if (!$detail) {
    die("Error Query Detail: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .struk-container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin-bottom: 5px;
        }

        .header p {
            margin-top: 0;
        }


        .info {
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            font-style: italic;
        }

        .btn-print {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="struk-container">
        <div class="header">
            <h2>Selera Nusantara</h2>
            <p>Jl.Tol Surabaya - Gempol No.KM. 754, Ngepung, Sidokepung, Kec. Buduran, Kab. Sidoarjo, Jawa Timur</p>
        </div>
        <div class="info">
            <p><strong>No Transaksi:</strong> <?php echo $PenjualanID; ?></p>
            <p><strong>Kasir:</strong> <?php echo $_SESSION['nama_petugas']; ?></p>
            
            <p><strong>ID Pelanggan:</strong> <?php echo $PelangganID; ?></p>
            <p><strong>Nama:</strong> <?php echo $d['NamaPelanggan']; ?></p>
            <p><strong>Alamat:</strong> <?php echo $d['Alamat']; ?></p>
            <p><strong>No. Telepon:</strong> <?php echo $d['NomorTelepon']; ?></p>
            <p><strong>Tanggal Pembelian:</strong> <?php echo date("j F Y, H:i", strtotime($TanggalPenjualan)); ?></p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan & Minuman</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($item = mysqli_fetch_assoc($detail)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $item['NamaProduk']; ?></td>
                        <td><?php echo $item['JumlahProduk']; ?> PCS</td>
                        <td>Rp. <?php echo number_format($item['Harga'], 0, ',', '.'); ?></td>
                        <td>Rp. <?php echo number_format($item['Subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p class="total">Total: Rp. <?php echo number_format($d['TotalHarga'], 0, ',', '.'); ?></p>
        <p class="total">Bayar: Rp. <?php echo number_format($d['UangBayar'], 0, ',', '.'); ?></p>
        <p class="total">Kembalian: Rp. <?php echo number_format($d['Kembalian'], 0, ',', '.'); ?></p>

        <div class="footer">
            <p>Terima kasih atas singgah anda di <strong>Selera Nusantara</strong>!</p>
            <p>Semoga Anda puas dengan layanan kami. Sampai jumpa lagi!</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>