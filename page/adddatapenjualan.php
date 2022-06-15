<?php shownotif(); ?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="panel panel-flat">
    <!-- <div class="panel-heading">
        <h6 class="panel-title">Import Data Penjualan Excel<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">

        </div>
    </div> -->

    <!-- <div class="table-responsive">
        <table class="table table-lg text-nowrap">
            <tbody>
                <tr>
                    <form action="proses/importpenjualan.php" method="POST" enctype="multipart/form-data">
                        <td class="col-md-10">
                            <div class="media-left">
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Select File Excel</label>
                                    <div class="col-lg-10">
                                        <input type="file" name="file" required>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="col-md-5">
                        </td>

                        <td class="text-right col-md-2">
                            <button type="submit" class="btn bg-indigo-300 legitRipple">
                                <i class="icon-import position-left"></i> Import Data</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div> -->


</div>
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Tambah Data Penjualan
            <a class="heading-elements-toggle">
                <i class="icon-more"></i>
            </a>
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li>
                    <a data-action="collapse"></a>
                </li>

                <li>
                    <a data-action="close"></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="proses/addtransaksi.php">
            <fieldset class="content-group">
                <div class="form-group">
                    <label class="control-label col-lg-2">Tanggal Transaksi</label>
                    <div class="col-lg-9">
                        <input type="text" name="tgl" id="date" class="form-control datepicker-dates" placeholder="Pick a date&hellip;" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Nama Produk</label>
                    <div class="col-lg-4">
                        <select name="produk" class="form-control">
                            <?php $sql = mysqli_query($conn, "SELECT * FROM data_produk");
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?php echo $row['id_produk'] ?>"><?php echo $row['nama_produk'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Lembar</label>
                    <div class="col-sm-2">
                        <input id="spinner-basic" name="qty" class="form-control" min="0" value="0" required>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="control-label col-lg-2">Customer</label>
                    <div class="col-lg-4">
                        <input type="text" name="customer" class="form-control" placeholder="">
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label col-lg-2">Keterangan</label>
                    <div class="col-lg-6">
                        <input type="text" name="ket" class="form-control" placeholder="">
                        <div>
                        </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit form
                    <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 
<script type="text/javascript">
    document.ready() {
        $('#date').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });
    }
</script> -->