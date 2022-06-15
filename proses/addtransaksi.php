<?php
include 'koneksi.php';
include 'function.php';

$split = explode("/", $_POST['tgl']);

$tgl = $split[2] . '-' . $split[0] . '-' . $split[1];

$sql = mysqli_query($conn, "SELECT YEAR(tggl_transaksi) as tggl ,id_produk FROM `data_penjualan` WHERE YEAR(tggl_transaksi) = '$tgl'");
$query = mysqli_fetch_assoc($sql);

if ($query['tggl'] == $split[2] && $_POST['produk'] == $query['id_produk']) {
     echo "<script>
          alert('Data Tahun Sudah Ada');
          location.href = '../index.php?p=adddatapenjualan';
     </script>";
} else {
     if ($tgl = '' || $_POST['qty'] = '' || $_POST['produk'] = '' || $_POST['ket'] = '') {
          notif('error', 'Data Input Tidak Boleh Kosong');
          header("location: ../index.php?p=adddatapenjualan");
     } else {
          $sql = mysqli_query($conn, "INSERT into data_penjualan values('','$tgl','$_POST[qty]','$_POST[produk]','$_POST[ket]')");
          if ($sql) {
               notif('success', 'Data Transaksi Berhasil Ditambahkan');
               header("location: ../index.php?p=datapenjualan");
          } else {
               notif('success', 'Data Transaksi Berhasil Ditambahkan');
               header("location: ../index.php?p=datapenjualan");
          }
     }
}
