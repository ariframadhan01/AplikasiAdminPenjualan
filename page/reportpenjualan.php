<?php
include 'proses/koneksi.php';
if(isset($_POST['search'])){
    $search=$_POST['search'];

}else{
    $search='';
}
date_default_timezone_set("Asia/Jakarta");
$tgl=date('Y-m-d');
$tgl=explode('-',$tgl);

if(empty($_POST['tahun'])){
$sql=mysqli_query($conn,"SELECT produk.id_produk, produk.nama_produk, produk.img,produk.ukuran, produk.stok, produk.harga, SUM(penjualan.qty) AS totpenjualan,
SUM(penjualan.qty)*produk.harga AS pendapatan  FROM penjualan JOIN produk ON produk.id_produk=penjualan.id_produk
WHERE YEAR(penjualan.tgl_trans)='$tgl[0]' GROUP BY 
penjualan.id_produk");
$b='';
$c='';
}else{
$sql=mysqli_query($conn,"SELECT produk.id_produk, produk.nama_produk, produk.img,produk.ukuran, produk.stok, produk.harga, SUM(penjualan.qty) AS totpenjualan,
SUM(penjualan.qty)*produk.harga AS pendapatan  FROM penjualan JOIN produk ON produk.id_produk=penjualan.id_produk
WHERE YEAR(penjualan.tgl_trans)='$_POST[tahun]' and MONTH(penjualan.tgl_trans)='$_POST[bulan]'  GROUP BY 
penjualan.id_produk");
	if($_POST['bulan']=='1'){
		$b='Januari';
	}elseif($_POST['bulan']=='2'){
		$b='Februari';
	}if($_POST['bulan']=='3'){
		$b='Maret';
	}if($_POST['bulan']=='4'){
		$b='April';
	}if($_POST['bulan']=='5'){
		$b='Mei';
	}if($_POST['bulan']=='6'){
		$b='Juni';
	}if($_POST['bulan']=='7'){
		$b='Juli';
	}if($_POST['bulan']=='8'){
		$b='Agustus';
	}if($_POST['bulan']=='9'){
		$b='September';
	}if($_POST['bulan']=='10'){
		$b='Oktober';
	}if($_POST['bulan']=='11'){
		$b='November';
	}if($_POST['bulan']=='12'){
		$b='Desember';
	}
	$c=" Bulan ";
}
shownotif();
?>
<title><?php echo $c.$b ?> </title>
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title text-semibold">Grafik Penjualan</h6>
		<div class="heading-elements">
			<ul class="icons-list">
				<li>
					<a data-action="collapse"></a>
				</li>
				<li>
					<a data-action="reload"></a>
				</li>
				<li>
					<a data-action="close"></a>
				</li>
			</ul>
		</div>
	</div>

	<div class="panel-body">
		<div class="chart-container">
			<div class="chart" id="c3-axis-tick-rotation"></div>
		</div>
	</div>
</div>


<!-- /orders history (static table) -->
<div class="content">

    <!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Pilih Data
                <a class="heading-elements-toggle">
                    <i class="icon-more"></i>
                </a>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                    <li>
                        <a data-action="reload"></a>
                    </li>
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
            

                    <div class="form-group">
                        <label class="control-label col-lg-1">Tahun</label>
                        <div class="col-sm-2">
                            <select name="tahun" class="form-control">
                              <?php $sq=mysqli_query($conn,"SELECT year(tgl_trans) as thn from penjualan GROUP by YEAR(tgl_trans)"); 
                              while($ro=mysqli_fetch_array($sq)){ ?>
                                <option value="<?php echo $ro['thn'] ?>"><?php echo $ro['thn'] ?></option>
                               <?php } ?>
                              
                            </select>
                        </div>
                        <label class="control-label col-lg-1">Bulan</label>
                        <div class="col-sm-2">
                            <select name="bulan" class="form-control">
                              <?php $sq=mysqli_query($conn,"SELECT MONTH(tgl_trans) as bln from penjualan GROUP by MONTH(tgl_trans)"); 
                              while($ro=mysqli_fetch_array($sq)){ ?>
                                <option value="<?php echo $ro['bln'] ?>"><?php echo $ro['bln'] ?></option>
                               <?php } ?>
                              
                            </select>
                        </div>
                         <button type="submit" class="btn btn-primary">Submit form
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                    </div>
                    
              

               
            </form>
        </div>
    </div>
</div>

<!-- Orders history (datatable) -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h6 class="panel-title">Detail Produk</h6>
		<div class="heading-elements">
			<ul class="icons-list">
				<li>
					<a data-action="collapse"></a>
				</li>
				<li>
					<a data-action="reload"></a>
				</li>
				<li>
					<a data-action="close"></a>
				</li>

			</ul>
		</div>
	</div>

	<table class="table table-orders-history text-nowrap">
		<thead>
			<tr>
				<th>Status</th>
				<th >Nama Produk</th>
				<th >Ukuran</th>
				<th >Stok</th>
				<th >Harga Produk</th>
				<th >Total Penjualan</th>
				<th style="width: 20px">Total Pendapatan</th>

				<th class="text-center">
					<i class="icon-arrow-down12"></i>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php while($row=mysqli_fetch_array($sql)){?>
			<tr>
				<td></td>
				<td>
					<div class="media">
						<a href="#" class="media-left">
							<img src="img/produk/<?php echo $row['img'] ?>" height="60" class="" alt="">
						</a>
						<div class="media-body media-middle">
							<a href="#" class="text-semibold"><?php echo $row['nama_produk'];?></a>
							<div class="text-muted text-size-small">
							<?php if($row['stok']==0){ ?>
								<span class="status-mark bg-grey position-left"></span>
								Tidak Tersedia
							<?php }else{ ?>
								<span class="status-mark bg-green position-left"></span>
								Tersedia
							<?php } ?>
							</div>
						</div>
					</div>
				</td>
				<td><?php echo $row['ukuran'];?></td>
				<td><?php echo $row['stok'];?></td>
				<td>Rp. <?php echo $row['harga'];?></td>
				<td><?php echo $row['totpenjualan'];?></td>
				<td>
					<h6 class="no-margin text-semibold">Rp. <?php echo $row['pendapatan'];?></h6>
				</td>
				<td class="text-center">
					
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php 
$array=array();

$sql=mysqli_query($conn,"SELECT SUM(qty) as jumlah, MONTH(tgl_trans) FROM penjualan WHERE YEAR(tgl_trans)='$tgl[0]' GROUP BY 
MONTH(tgl_trans)"); 
while($row=mysqli_fetch_array($sql)){
 array_push($array,$row['jumlah']);
}

for($i=0;$i<12;$i++){
	if(isset($array[$i])){

	}else{
		array_push($array,'0');
	}
}

?>

<script>
	// Text label rotation
	// ------------------------------

	// Generate chart
	var axis_tick_rotation = c3.generate({
		bindto: '#c3-axis-tick-rotation',
		size: {
			height: 400
		},
		data: {
			x: 'x',
			columns: [
				['x', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
					'November', 'December'
				],
				['Penjualan <?php echo $tgl[0] ?>', <?php echo $array[0] ?> ,<?php echo $array[1] ?>, <?php echo $array[2] ?>, <?php echo $array[3] ?>
				, <?php echo $array[4] ?>, <?php echo $array[5] ?>, <?php echo $array[6] ?>, <?php echo $array[7] ?>
				, <?php echo $array[8] ?>, <?php echo $array[9] ?>, <?php echo $array[10] ?>, <?php echo $array[11] ?>
				],
			],
			type: 'bar'
		},
		color: {
			pattern: ['#00BCD4']
		},
		axis: {
			x: {
				type: 'category',
				tick: {
					rotate: -90
				},
				height: 80
			}
		},
		grid: {
			x: {
				show: true
			}
		}
	});
</script>