<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export Peramalan.xls");
include 'koneksi.php';

$sql = mysqli_query($conn, "SELECT YEAR(tahun) as tahun,peramalan.peramalan as peramalan ,data_produk.nama_produk as nama FROM peramalan JOIN data_produk ON peramalan.id_produk = data_produk.id_produk ");
$i = 1;
?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Nama Produk</th>
            <th>Peramalan</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <tr>
                <td> <?= $i ?></td>
                <td> <?= $row['tahun'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td> <?= round($row['peramalan'], 1) ?></td>
            </tr>
            <?php $i++;
        } ?>
    </tbody>
</table>