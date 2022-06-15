<?php
include 'koneksi.php';
include 'function.php';

$split=explode("/",$_POST['tgl']);
    
$tgl=$split[2].'-'.$split[0].'-'.$split[1];
$sql=mysqli_query($conn,"INSERT into preorder values('','$tgl','$_POST[produk]','$_POST[qty]','$_POST[customer]'
,'menunggu')");
if($sql){
     notif('success','Data Preorder Berhasil Ditambahkan'); 
     header("location: ../index.php?p=preorder");
}else{
    notif('error','Data Preorder gagal Ditambahkan'); 
     header("location: ../index.php?p=preorder");
}
?>