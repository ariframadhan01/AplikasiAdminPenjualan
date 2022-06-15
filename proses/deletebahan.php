<?php 
include 'koneksi.php';
include 'function.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql=mysqli_query($conn,"DELETE from bahan where id_bahan='$id'");
    if($sql){
        notif('success','Data Bahan Berhasil dihapus'); 
        header("location: ../index.php?p=databahan");
    }else{
        notif('error','Data Bahan Gagal dihapus');
        header("location: ../index.php?p=databahan");
    }
}
?>