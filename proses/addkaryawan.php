<?php
include 'koneksi.php';
include 'function.php';

$sql=mysqli_query($conn,"DELETE FROM karyawan");
$sql=mysqli_query($conn, "INSERT into karyawan values('$_POST[kary]')");
if($sql){
     notif('success','Data Karyawan Berhasil Ditambahkan'); 
    header("location: ../index.php?p=karyawan");
}else{
    notif('error','Data Karyawan Gagal Ditambahkan'); 
    header("location: ../index.php?p=karyawan");
}

?>