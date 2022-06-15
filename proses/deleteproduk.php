<?php 
include 'koneksi.php';
include 'function.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql=mysqli_query($conn,"SELECT * from data_produk where id_produk='$id'");
    $row=mysqli_fetch_array($sql);

    $sql=mysqli_query($conn,"DELETE from data_produk where id_produk='$id'");
    if($sql){
        unlink('../img/produk/'.$row['img']);
        notif('success','Produk Berhasil dihapus'); 
        header("location: ../index.php?p=dataproduk");
    }else{
        notif('error','Produk Gagal dihapus');
        header("location: ../index.php?p=dataproduk");
    }
}
