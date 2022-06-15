<?php
include 'koneksi.php';
include 'function.php';

$sql=mysqli_query($conn,"SELECT * FROM preorder where id_transaksi='$_GET[id]'");
$row=mysqli_fetch_array($sql);

$sql=mysqli_query($conn,"INSERT into penjualan values('','$row[tgl_trans]','$row[id_produk]','$row[qty]','$row[customer]'
,'')");
if($sql){
    $sql=mysqli_query($conn,"UPDATE preorder SET ket='ready' Where id_transaksi='$_GET[id]'");
     notif('success','Data Preorder Berhasil Diedit'); 
     header("location: ../index.php?p=preorder");
}else{
    notif('error','Data Preorder gagal Diedit'); 
     header("location: ../index.php?p=preorder");
}
?>