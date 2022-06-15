<?php
include 'koneksi.php';
$username=$_POST['username'];
$pass=md5($_POST['password']);
$sql=mysqli_query($conn,"SELECT * FROM user where username='$username' AND password='$pass'");
$cek = mysqli_num_rows($sql);
$row= mysqli_fetch_array($sql);
if($cek>0){
  session_start();
  $_SESSION['username'] = $username;
  $_SESSION['status'] = $row['status'];
  $_SESSION['nama'] = $row['nama'];
  $_SESSION['img']=$row['img'];
  header('Location: ../index.php');
}else {
  header('Location: ../login-page.php?log=err');
}
?>
