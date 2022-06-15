<?php
include "koneksi.php"; //memanggil file koneksi database
$loc  = $_FILES['file']['tmp_name'];
  include('../plugins/readexcel/Classes/PHPExcel/IOFactory.php');
  $objPHPExcel = PHPExcel_IOFactory::load($loc);
  $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
$no=1;
echo "<h3>LOG Import</h3> <h4><a href='../index.php?p=adddatapenjualan'>Back</a></h4><br>";
foreach($sheet as $row):
  if($no>5){
    $data=array();
    foreach($row as $key => $val){
      if($key=='A' || $key=='B' || $key=='D' || $key=='E' || $key=='H' || $key=='I'){
       array_push($data,$val);
    }
  }
    //  insert into database function
    $split=explode("/",$data[1]);
    
    $tgl=$split[2].'-'.$split[0].'-'.$split[1];
   $sql=mysqli_query($conn,"INSERT INTO penjualan values('','$tgl','$data[2]','$data[3]','$data[4]','$data[5]')");
    if($sql){
      echo "Data ".$data[0]." berhasil diimport<br>";
    }else{
      echo "Data ".$data[0]."gagal diimport<br>";
    }
  }
  $no++;
endforeach;
include 'proses/exponentialsmoothing.php'; 
?>

