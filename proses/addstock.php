<?php
include 'koneksi.php';
include 'function.php';

$sql=mysqli_query($conn,"UPDATE produk SET stok='$_POST[stok]' where id_produk='$_POST[id]'");
if($sql){
	notif('success','Berhasil menabahkan stok'); 
    header("location: ../index.php?p=dataproduk");
}else{
	notif('error','Gagal menabahkan stok'); 
    header("location: ../index.php?p=dataproduk");
}
?>