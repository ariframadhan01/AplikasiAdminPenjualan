<?php
include 'proses/koneksi.php';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
$sql = mysqli_query($conn, "SELECT * FROM data_produk where nama_produk like '%$search%'");
shownotif();
?>

<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="content">

    <!-- Search field -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Search Data Produk
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
            <div class="col-md-12">
                <div class="col-md-12">
                    <form action="?p=dataproduk" method='POST' class="main-search">
                        <div class="input-group content-group" style="padding-top: 15px;">
                            <div class="has-feedback has-feedback-left">
                                <input type="text" name="search" class="form-control input-xlg" placeholder="Search Produk">
                                <div class="form-control-feedback" style="padding-top: 15px;">
                                    <i class="icon-search4 text-muted text-size-base"></i>
                                </div>
                            </div>

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-xlg legitRipple">Search</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /search field -->
    <ul class="media-list">
        <?php while ($row = mysqli_fetch_array($sql)) { ?>
            <li class="media panel panel-body stack-media-on-mobile">
                <a href="" class="media-left" data-popup="lightbox">
                    <img src="img/produk/<?php echo $row['img'] ?>" width="96" alt="">
                </a>

                <div class="media-body">
                    <h6 class="media-heading text-semibold">
                        <span href="#"><?php echo $row['nama_produk'] ?></span>
                    </h6>

                    <ul class="list-inline list-inline-separate mb-10">
                        <li>
                            <a href="#" class="text-muted">Fashion</a>
                        </li>

                    </ul>

                    <p class="content-group-sm"><?php echo $row['keterangan'] ?></p>

                </div>

                <div class="media-right text-center">
                    <h3 class="no-margin text-semibold">Rp. <?php echo $row['harga'] ?></h3>

                    <div class="text-nowrap">
                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                    </div>

                    <div class="text-muted">Stok <?php echo $row['stock'] ?></div>


                    <div class="btn-group">
                        <?php if ($_SESSION['status'] == 'admin') { ?>
                            <button type="button" class="mt-15 btn bg-teal-400 dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">Action
                                <i class="icon-cog5  position-right"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="?p=addproduk&id=<?php echo $row['id_produk'] ?>">
                                        <i class="icon-pencil"></i> Edit</a>
                                </li>
                                <li>
                                    <a href="proses/deleteproduk.php?id=<?php echo $row['id_produk'] ?>">
                                        <i class=" icon-trash-alt"></i> Delete</a>
                                </li>

                            </ul>
                        <?php } else { ?>
                            <a href="?p=addproduk&id=<?php echo $row['id_produk'] ?>" class="btn btn-primary btn-md legitRipple">Add Stock</a>
                        <?php } ?>
                    </div>
                </div>
            </li>
        <?php } ?>


    </ul>

</div>