<?php 
include 'koneksi.php';
include 'function.php';
if(isset($_GET['u'])){
    $username=$_GET['u'];
    $sql=mysqli_query($conn,"SELECT * from user where username='$username'");
    $row=mysqli_fetch_array($sql);

    $sql=mysqli_query($conn,"DELETE from user where username='$username'");
    if($sql){
        unlink('../img/user/'.$row['img']);
        notif('success','Akun Berhasil dihapus'); 
        header("location: ../index.php?p=akun");
    }else{
        notif('error','Akun Gagal dihapus');
        header("location: ../index.php?p=akun");
    }
}
?>