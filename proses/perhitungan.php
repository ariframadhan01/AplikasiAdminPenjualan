<style>
table, th, td {
    border: 1px solid black;
}
</style>
<?php
include 'koneksi.php';
$a=0.9;

$arr=array();
$sql=mysqli_query($conn,"DELETE FROM peramalan"); // menghapus data peramalan sebelumnya
$sql2=mysqli_query($conn,"SELECT * FROM produk"); // memanggil data produk

?>



<?php
while($c=mysqli_fetch_array($sql2)){
    $sql=mysqli_query($conn,"SELECT SUM(qty) AS jumlah, YEAR(tgl_trans) as tahun,MONTH(tgl_trans) AS bulan FROM penjualan WHERE 
    id_produk='$c[id_produk]' GROUP BY YEAR(tgl_trans),MONTH(tgl_trans)"); // memanggil jumlah data penjualan berdasarkan bulan dan tahun
    $arrsementara=array(); //inisialisasi array
    $periode=array();  //inisialisasi array
    while($row=mysqli_fetch_array($sql)){
        array_push($arrsementara,$row['jumlah']); // menginput data penjualan per bulan kedalam array untuk proses perhitungan selanjutnya
        array_push($periode,$row['tahun'].'-'.$row['bulan'].'-01');
        $bulan=$row['bulan'];
        $tahun=$row['tahun'];
    }
     array_push($periode,$tahun.'-'.($bulan+1).'-01');

    $dataramal=array('0',$arrsementara[0]); // inisialisasi peramalan bulan pertama=0 dan peramalan bulan ke dua=datapenjualan bulan pertama
    $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[0]','0')"); //insert data peramalan bulan 1 ke database
    $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[1]','$arrsementara[0]')"); //insert data peramalan bulan 2 ke database
    $error=array($arrsementara[1]-$arrsementara[0]); // menghitung nilai error perbulan
    $error2=array(pow($error[0],2));  // menghitung nilai error^2 perbulan
    $ramal=$arrsementara[0]; 

    for($i=2;$i<=count($arrsementara);$i++){
        $x1=$arrsementara[$i-1];  //mendapatkan nilai penjualan bulan 3 dan seterusnya
        $ramal=$a*$x1+(1-$a)*$ramal; // perhitungan nilai peramalan bulan 3 dan seterusnya berdasarkan metode
        array_push($dataramal,$ramal); //simpan data peramalan ke array
        $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[$i]','$ramal')"); //insert data peramalan bulan 3 dan seterusnya ke database
        //$sql=mysqli_query($conn,"INSERT INTO peramalan values('A','1','$ramal')");
        if($i<count($arrsementara)){
            $err=$arrsementara[$i]-$ramal; //menghitung nilai error perbulan
           // echo $err;
            $err2=pow($err,2); //menghitung nilai error^2 perbulan
            array_push($error,$err); //simpan nilai error ke array
            array_push($error2,$err2); //simpan nilai error^2 ke array
        }
    }
    // $arr[$c['id_produk']]=$dataramal; //
    

$jml_err=array_sum($error2); // menjumlahkan semua nilai error perbulan
$rmse=pow(($jml_err/(count($arrsementara)-1)),0.5); //menghitung nilai error akhir

?>

                

<?php

// echo "<pre>";
// print_r($arrsementara);
// echo "</pre>";
// echo "<br>";
// echo "<br>";
?>
<h2> BARANG <?php echo $c['id_produk'] ?></h2>
<table style="width:50%">
    <tr>
        <th class="text-center" width="100">Periode (Bulan)</th>
        <th class="text-center" width="100">Penjualan</th>
        <th class="text-center" width="100">Peramalan</th>
        <th class="text-center" width="100">Error</th>
        <th class="text-center" width="100">|Error|</th>
        <th class="text-center" width="100">Error^2</th>
        <th class="text-center" width="100">|%Error|</th>

    </tr>
<?php
$jumlah=0;
$jumlah2=0;
foreach ($dataramal as $key => $value) {
    echo "<tr>";
    echo "<td>".($key+1)."</td>";
    if($key>=count($arrsementara)){
        echo "<td>-</td>";
    }else{
        echo "<td>".$arrsementara[$key]."</td>";
    }
     echo "<td>".$value."</td>";
    if($key==0){
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
    }elseif($key>count($error)){
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
    }else{
        echo "<td>".$error[$key-1]."</td>";
        echo "<td>".abs($error[$key-1])."</td>";
        echo "<td>".$error2[$key-1]."</td>";
        $d=(abs($error[$key-1])/$arrsementara[$key])*100;
        echo "<td>".$d."%</td>";
    }
    echo "</tr>";
if(isset($error2[$key-1])){
$jumlah=$jumlah+$error2[$key-1];
$jumlah2=$jumlah2+$d;
}
}
echo "<tr>";
echo "<td colspan='5'><b>Jumlah</b></td>";
echo "<td>".$jumlah."</td>";
echo "<td>".$jumlah2."%</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='5'><b>Nilai Error<b></td>";
echo "<td>".$rmse."</td>";
echo "<td>".$jumlah2/count($error2)."%</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='5'></td>";
echo "<td align='center'><b>RSME</b></td>";
echo "<td align='center'><b>MAPE</b></td>";
echo "</tr>";
  
  echo "</table>";
  echo "<br><br>";
//   echo "<pre>";
// print_r($dataramal);
// echo "</pre>";
// echo "<br>";
// echo "<br>";
// print_r($error);
// echo "<br>";
// echo "<br>";
// print_r($error2);
// echo "<br>";
// echo "<br>";
// echo $rmse;
// echo "<br>";
// echo "<br>";

}



?>
