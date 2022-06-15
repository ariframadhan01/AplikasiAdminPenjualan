<?php
include 'koneksi.php';
include 'function.php';

if(isset($_POST['nama'])){
    $sql=mysqli_query($conn, "UPDATE bahan set nama_bahan='$_POST[nama]',stok='$_POST[stok]',satuan='$_POST[satuan]',
    id_kat='$_POST[kat]' where id_bahan='$_POST[id]'");
    if($sql){
        notif('success','Data Bahan Berhasil Diedit'); 
        header("location: ../index.php?p=databahan");
    }else{
        notif('error','Data Bahan Gagal Diedit');
        header("location: ../index.php?p=databahan");
    }
}
?>