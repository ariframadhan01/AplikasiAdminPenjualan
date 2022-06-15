<?php
include 'koneksi.php';
include 'function.php';
    $sql=mysqli_query($conn,"INSERT into bahan values('','$_POST[nama]','$_POST[stok]','$_POST[satuan]','$_POST[kat]')");
    if($sql){
        notif('success','Data Bahan Berhasil Ditambahkan'); 
        echo 'asdsadasd';
        header("location: ../index.php?p=databahan");
    } else{
        notif('error','Data Bahan Gagal Ditambahkan');
        header("location: ../index.php?p=databahan");
        
    }
?>