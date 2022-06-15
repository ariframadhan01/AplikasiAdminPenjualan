<?php
include 'proses/koneksi.php';

if (isset($_GET['id'])) {
    $sql = mysqli_query($conn, "SELECT * FROM data_produk where id_produk='$_GET[id]'");
    $row = mysqli_fetch_array($sql);
    $nama = $row['nama_produk'];
    $harga = $row['harga'];
    $stock = $row['stock'];
    // $waktu = $row['waktu_produksi'];
    $ket = $row['keterangan'];
    if ($_SESSION['status'] == 'admin') {
        $link = 'proses/editproduk.php';
    } else {
        $link = 'proses/addstock.php';
    }
    // $kain = $row['bahan_kain'];
    // $zipper = $row['bahan_zipper'];
    // $foam = $row['bahan_foam'];
    $id = $_GET['id'];
    $img = '';
    if ($_SESSION['status'] != 'mandor') {
        $s = 'readonly';
    } else {
        $s = 'id="spinner-basic"';
    }
} else {
    $nama = '';
    $harga = '';
    $stock = '';
    $ket = '';
    $waktu = '0';
    $kain = '';
    $zipper = '';
    $foam = '';
    $link = 'proses/addproduk.php';
    $id = "";
    $img = 'required';
    $s = 'id="spinner-basic"';
}






?>

<div class="content">

    <!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Tambah Data Produk
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
                        <a data-action="reload"></a>
                    </li>
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="<?php echo $link ?>" enctype="multipart/form-data">
                <fieldset class="content-group">
                    <div class="row">
                        <?php if ($_SESSION['status'] == 'admin') { ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Kualifikasi</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="id" value="<?php echo $id ?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Nama Produk</label>
                                    <div class="col-lg-5">
                                        <input type="text" value='<?php echo $nama ?>' name="nama" class="form-control" required>
                                    </div>
                                    <!-- <div class="col-md-5">
                                                                                            <div class="form-group">
                                                                                                <label class="control-label col-lg-4">Ukuran (P x L x T) cm </label>
                                                                                                <div class="col-lg-3">
                                                                                                    <input type="text" name="ukuran" class="form-control" data-mask="999 x 999 x 99">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Harga</label>
                            <div class="content-group-lg">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" value='<?php echo $harga ?>' name="harga" value="0" class="touchspin-prefix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Nama Produk</label>
                            <div class="col-lg-5">
                                <input type="text" value='<?php echo $nama ?>' readonly name="nama" class="form-control" required>
                                <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" required>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="control-label col-lg-2">stock</label>
                        <div class="col-sm-2">
                            <input <?php echo $s ?> value='<?php echo $stock ?>' name="stok" class="form-control" min="0" required>
                        </div>
                    </div>
                    <?php if ($_SESSION['status'] == 'admin') { ?>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                                <textarea rows="5" cols="5" name="ket" class="form-control" placeholder="Keterangan Produk" required><?php echo $ket ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">Gambar</label>
                            <div class="col-lg-5">
                                <input type="file" class="file-input-custom" name="fileimages" data-show-caption="true" data-show-upload="false" accept="image/*" <?php echo $img ?>>
                            </div>
                        </div>
                    </fieldset>
                    <!-- <legend class="text-semibold"><i class="icon-reading position-left"></i> Bahan Produksi</legend>
                                                                        <fieldset class="content-group">
                                                                            <div class="form-group">
                                                                                <label class="col-lg-2 control-label text-semibold">Kain</label>
                                                                                <div class="col-lg-5">
                                                                                    <select class="form-control" name="kain" required>
                                                                                        <option value="0" disabled selected>Pilih bahan</option>
                                                                                        <?php
                                                                                        $sql = mysqli_query($conn, "SELECT * FROM bahan where id_kat='1'");
                                                                                        while ($row = mysqli_fetch_array($sql)) {
                                                                                            ?>
                                                                                                                                                <option value="<?php echo $row['id_bahan'] ?>" <?php if ($row['id_bahan'] == $kain) {
                                                                                                                                                                                                    echo "Selected";
                                                                                                                                                                                                } ?>><?php echo $row['nama_bahan'] ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-lg-2 control-label text-semibold">Zipper</label>
                                                                                <div class="col-lg-5">
                                                                                    <select class="form-control" name="zipper" required>
                                                                                        <option value="0" disabled selected>Pilih bahan</option>

                                                                                        <?php
                                                                                        $sql = mysqli_query($conn, "SELECT * FROM bahan where id_kat='2'");
                                                                                        while ($row = mysqli_fetch_array($sql)) {
                                                                                            ?>
                                                                                                                                                <option value="<?php echo $row['id_bahan'] ?>" <?php if ($row['id_bahan'] == $zipper) {
                                                                                                                                                                                                    echo "Selected";
                                                                                                                                                                                                } ?>><?php echo $row['nama_bahan'] ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-lg-2 control-label text-semibold">Foam</label>
                                                                                <div class="col-lg-5">
                                                                                    <select class="form-control" name="foam" required>
                                                                                        <option value="0" disabled selected>Pilih bahan</option>
                                                                                        <?php
                                                                                        $sql = mysqli_query($conn, "SELECT * FROM bahan where id_kat='3'");
                                                                                        while ($row = mysqli_fetch_array($sql)) {
                                                                                            ?>
                                                                                                                                                <option value="<?php echo $row['id_bahan']; ?> " <?php if ($row['id_bahan'] == $foam) {
                                                                                                                                                                                                        echo "Selected";
                                                                                                                                                                                                    } ?>><?php echo $row['nama_bahan'] ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-2">Waktu Produksi</label>
                                                                                <div class="col-sm-1">
                                                                                    <input id="spinner-basic" value='<?php echo $waktu ?>' name="hari" class="form-control" min="0" value="0" required>
                                                                                </div>
                                                                                <label class="control-label col-lg-2">Hari</label>
                                                                            </div>
                    <?php } ?>
                </fieldset>
                <legend class="text-semibold"></legend> -->

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>