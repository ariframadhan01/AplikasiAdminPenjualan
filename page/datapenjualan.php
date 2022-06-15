<!-- Theme JS files -->
<?php
include 'proses/koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM data_penjualan JOIN data_produk ON data_penjualan.id_produk=data_produk.id_produk ORDER BY tggl_transaksi DESC");
shownotif();
?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Data Penjualan</h5>
        <div class="heading-elements">
        </div>
    </div>
    <table class="table datatable-pagination">

        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Kualifikasi</th>
                <th>Lembar</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['tggl_transaksi'] ?></td>
                    <td><?php echo $row['nama_produk'] ?></td>
                    <td><?php echo $row['id_produk'] ?></td>
                    <td><span class="label label-success"><?php echo $row['lembar'] ?></span></td>
                    <td>Rp. <?php echo $row['harga'] ?></td>
                    <td>Rp. <?php echo $row['harga'] * $row['stock'] ?></td>
                    <td><?php echo $row['ket'] ?></td>
                </tr>
                <?php $no++;
            } ?>

        </tbody>
    </table>
</div>
<!-- /pagination types -->
<script>
    $(document).ready(function() {

        /* ------------------------------------------------------------------------------
         *
         *  # Basic datatables
         *
         *  Specific JS code additions for datatable_basic.html page
         *
         *  Version: 1.0
         *  Latest update: Aug 1, 2015
         *
         * ---------------------------------------------------------------------------- */


    });
</script>