<?php
include 'koneksi.php';
include 'function.php';

if(isset($_POST['nama'])){
    $sql=mysqli_query($conn, "UPDATE bahan set stok=stok+'$_POST[stok]' where id_bahan='$_POST[id]'");
    if($sql){
        notif('success','Data Bahan Berhasil Diedit'); 
        header("location: ../index.php?p=databahan");
    }else{
        notif('error','Data Bahan Gagal Diedit');
        header("location: ../index.php?p=databahan");
    }
}
?>