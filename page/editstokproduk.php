    <?php
include 'proses/koneksi.php';
if(isset($_GET['id'])){
    $sql=mysqli_query($conn,"SELECT * FROM produk where id_produk='$_GET[id]'"); 
    $row=mysqli_fetch_array($sql);
    $nama=$row['nama_produk'];
    $harga=$row['harga'];
    $stok=$row['stok'];
    $waktu=$row['waktu_produksi'];
    $ket=$row['keterangan'];
    $link='proses/editproduk.php';
    $kain=$row['bahan_kain'];
    $zipper=$row['bahan_zipper'];
    $foam=$row['bahan_foam'];   
    $id=$_GET['id'];
    $img='';
}else{
    $nama='';
    $harga='';
    $stok='';
    $ket='';
    $waktu='';
    $kain='';
    $zipper='';
    $foam='';   
    $link='proses/addproduk.php';
    $id="";
    $img='required';
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
            <form class="form-horizontal" method="POST" action="proses/addstokproduk.php" enctype="multipart/form-data">
                <fieldset class="content-group">
                <div class="row">
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
                        <div class="col-md-5">
                    
                    </div>
                    </div>
                    </div>
                    
                </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-lg-2">Stok</label>
                        <div class="col-sm-2">
                            <input id="spinner-basic" placeholder='<?php echo $stok ?>'  name="stok" class="form-control" min="0" required>
                        </div>
                    </div>

                    
                </fieldset>
                
                
                <legend class="text-semibold"></legend>
                
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>