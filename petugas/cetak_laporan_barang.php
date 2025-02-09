<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';

$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Makanan & Minuman Selera Nusantara</title>
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

        p {
            /* text-align: center; */
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #007bff;
            color: black;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(odd) {
            background: #f2f2f2;
        }

        tbody tr:hover {
            background: #d1ecf1;
            cursor: pointer;
        }

        .total {
            font-weight: bold;
            color: #2c3e50;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
        }

        .status-aman {
            background: #28a745;
            color: black;
        }

        .status-menipis {
            background: #ffc107;
            color: black;
        }

        .status-habis {
            background: #dc3545;
            color: black;
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

            .container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body onload="window.print();">

    <div class="container">
        <h2>Laporan Data Makanan & Minuman</h2>
        <p>Dicetak Pada: <?php echo date("d-m-Y"); ?></p>
        <p>Dicetak Oleh: <?php echo $_SESSION['nama_petugas']; ?></p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan & Minuman</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Total Harga Stok</th>
                    <th>Status Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalSemua = 0;
                while ($d = mysqli_fetch_assoc($result)) {
                    $totalHarga = $d['Harga'] * $d['Stok'];
                    $totalSemua += $totalHarga;

                    if ($d['Stok'] == 0) {
                        $status = "<span class='status status-habis'>Habis, perlu restock</span>";
                    } elseif ($d['Stok'] < 10) {
                        $status = "<span class='status status-menipis'>Menipis</span>";
                    } else {
                        $status = "<span class='status status-aman'>Aman</span>";
                    }
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['NamaProduk']; ?></td>
                        <td>Rp. <?php echo number_format($d['Harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $d['Stok']; ?></td>
                        <td>Rp. <?php echo number_format($totalHarga, 0, ',', '.'); ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="total">Total Nilai Stok</td>
                    <td class="total">Rp. <?php echo number_format($totalSemua, 0, ',', '.'); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <p class="footer">&copy; <?php echo date("Y"); ?> Selera Nusantara</p>
    </div>

</body>

</html>
