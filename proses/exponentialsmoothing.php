<?php
include 'koneksi.php';
$a=0.9;

$arr=array();
$sql=mysqli_query($conn,"DELETE FROM peramalan");
$sql2=mysqli_query($conn,"SELECT * FROM penjualan p join produk d on p.id_produk=d.id_produk GROUP BY p.id_produk");

while($c=mysqli_fetch_array($sql2)){
    $sql=mysqli_query($conn,"SELECT SUM(qty) AS jumlah, YEAR(tgl_trans) as tahun,MONTH(tgl_trans) AS bulan FROM penjualan WHERE 
    id_produk='$c[id_produk]' GROUP BY YEAR(tgl_trans),MONTH(tgl_trans)");
    $arrsementara=array();
    $periode=array();
    while($row=mysqli_fetch_array($sql)){
        array_push($arrsementara,$row['jumlah']);
        array_push($periode,$row['tahun'].'-'.$row['bulan'].'-01');
        $bulan=$row['bulan'];
        $tahun=$row['tahun'];
    }
     array_push($periode,$tahun.'-'.($bulan+1).'-01');

    $dataramal=array('0',$arrsementara[0]);
    $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[0]','0')");
    $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[1]','$arrsementara[0]')");
    
    $error=array($arrsementara[1]-$arrsementara[0]);
    $error2=array(pow($error[0],2));
    $ramal=$arrsementara[0];

    for($i=2;$i<=count($arrsementara);$i++){
        $x1=$arrsementara[$i-1];
        $ramal=$a*$x1+(1-$a)*$ramal;
        array_push($dataramal,$ramal);
        $sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode[$i]','$ramal')");
        //$sql=mysqli_query($conn,"INSERT INTO peramalan values('A','1','$ramal')");
        if($i<count($arrsementara)){
            $err=$arrsementara[$i]-$ramal;
           // echo $err;
            $err2=pow($err,2);
            array_push($error,$err);
            array_push($error2,$err2);
        }
    }
    $arr[$c['id_produk']]=$dataramal;
    //$sql=mysqli_query($conn,"INSERT into peramalan values('$c[id_produk]','$periode','$ramal')");

$jml_err=array_sum($error2);
$rmse=pow(($jml_err/(count($arrsementara)-1)),0.5);

// print_r($arrsementara);
// echo "<br>";
// echo "<br>";
// print_r($dataramal);
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
// print_r($arr);

?>