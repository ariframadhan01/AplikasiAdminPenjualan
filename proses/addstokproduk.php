<?php
include 'koneksi.php';
include 'function.php';
$target_dir = "../img/produk/";

// Check if image file is a actual image or fake image

    $name=$_POST['nama'];
    $id=$_POST['id'];
    $name=$_POST['nama'];
    $harga=$_POST['harga'];
    $stok=$_POST['stok'];
    $ket=$_POST['ket'];
    $ukuran=$_POST['ukuran'];

    $sql=mysqli_query($conn,"UPDATE produk SET stok=stok+'$stok' where id_produk='$id'");
    if($sql){
            
            notif('success','Produk Berhasil Diedit'); 
            header("location: ../index.php?p=dataproduk");
        }else{
            notif('error','Produk Gagal diedit');
            header("location: ../index.php?p=dataproduk");
        }

?>