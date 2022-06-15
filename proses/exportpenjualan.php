<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");
$tgl=date('d-m-Y');

$start=split('/',$_POST['start']);
$hstart=$start[2].'-'.$start[0].'-'.$start[1];

$start=split('/',$_POST['end']);
$hend=$start[2].'-'.$start[0].'-'.$start[1];

$sql=mysqli_query($conn,"SELECT t.`id_trans`,t.`username`,t.`tgl`,SUM(d.jumlah_barang*b.`harga_barang`) AS total FROM tb_transaksi t JOIN tb_detailtrans d ON 
t.`id_trans`=d.`id_trans` JOIN tb_barang b ON d.`id_barang`=b.`id_barang` WHERE t.`tgl`>'$hstart' AND t.`tgl`<'$hend'  GROUP BY t.`id_trans`");


require('../plugins/fpdf/fpdf.php');

// $result=mysqli_query($conn,"SELECT *, SUM(luas) AS kumulatif FROM tblapopt where konfirmasi = 'diterima' group by desa, komoditas, nmopt");



//For each row, add the field to the corresponding column

$pdf = new FPDF('P','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage();


$pdf->SetFont('Arial','B',15);
$pdf->Cell(80);
$pdf->Cell(30,10,'PT KONDANG JAYA',0,0,'C');
$pdf->Ln();

$pdf->SetY(25);
$pdf->SetFont('Arial','',11);
$pdf->SetX(100);
$pdf->Cell(40,10,'Tanggal   :',0,0,'R');
$pdf->SetY(33);
$pdf->SetX(100);
$pdf->Cell(40,10,'Periode   :',0,0,'R');
$pdf->SetY(25);
$pdf->SetX(100);
$pdf->Cell(85,10,$tgl,0,0,'R');
$pdf->SetY(33);
$pdf->SetX(100);
$pdf->Cell(85,10,$_POST['start']." - ".$_POST['end'],0,0,'R');
$pdf->Ln();



//Fields Name position
$Y_Fields_Name_position = 50;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(10,8,'No.',1,0,'C',1);
$pdf->SetX(30);
$pdf->Cell(30,8,'No Surat Jalan',1,0,'C',1);
$pdf->SetX(60);
$pdf->Cell(35,8,'Tanggal',1,0,'C',1);
$pdf->SetX(95);
$pdf->Cell(40,8,'Pembeli',1,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(50,8,'Total Pembelian',1,0,'C',1);
$pdf->SetX(200);

$pdf->Ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);
$no=1;
$total=0;
while($row = mysqli_fetch_array($sql))
{
    $pdf->SetX(20);
    $pdf->Cell(10,8,$no,1,0,'C',1);
    $pdf->SetX(30);
    $pdf->Cell(30,8,$row['id_trans'],1,0,'L',1);
    $pdf->SetX(60);
    $pdf->Cell(35,8,$row['tgl'],1,0,'C',1);
    $pdf->SetX(95);
    $pdf->Cell(40,8,$row['username'],1,0,'L',1);
    $pdf->SetX(135);
    $pdf->Cell(50,8,'Rp. '.$row['total'],1,0,'R',1);
    $pdf->SetX(200);
    $pdf->Ln();
    $no++;
    $total=$total+$row['total'];
}
$pdf->SetFont('Arial','B',12);
$pdf->SetX(95);
$pdf->Cell(40,8,'Total Pendapatan',1,0,'R',1);
$pdf->SetFont('Arial','',10);
$pdf->SetX(135);
$pdf->Cell(50,8,'Rp. '.$total,1,0,'R',1);


$pdf->SetTitle('REPORT PENJUALAN');
$pdf->Output("report","I");


?>