<?php

include 'proses/koneksi.php';
$array = array();
$ramal = array();

date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d');
$year = date('Y');
$tgl = explode('-', $tgl);
$sql = mysqli_query($conn, "SELECT * FROM peramalan GROUP BY MONTH(bulan),YEAR(bulan)");
$row = mysqli_num_rows($sql);
$bln = date('m');;
$sql = mysqli_query($conn, "SELECT SUM(qty) as jumlah FROM penjualan where YEAR(tgl_trans)='$year' GROUP BY MONTH(tgl_trans)");
while ($row = mysqli_fetch_array($sql)) {
	array_push($array, $row['jumlah']);
}
for ($i = 0; $i < 12; $i++) {
	if (isset($array[$i])) { } else {
		array_push($array, '0');
	}
}
$sql = mysqli_query($conn, "SELECT SUM(penjualan) as penjualan FROM peramalan GROUP BY YEAR(bulan),MONTH(bulan)");
while ($row = mysqli_fetch_array($sql)) {
	array_push($ramal, $row['penjualan']);
}

for ($i = 0; $i < 12; $i++) {
	if (isset($ramal[$i])) { } else {
		array_push($ramal, '0');
	}
}
$databulan = array(
	'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
	'November', 'Desember'
);
$monthName = $databulan[$bln - 1];
$sql = mysqli_query($conn, "SELECT * from karyawan");
$r = mysqli_fetch_array($sql);
$kary = $r['jml_kary'];

$tothari1 = 0;
$sql = mysqli_query($conn, "SELECT * FROM produk JOIN peramalan ON produk.id_produk = peramalan.id_produk WHERE YEAR(bulan)='$year' and MONTH(bulan)='$bln'");
while ($row = mysqli_fetch_array($sql)) {
	$s = mysqli_query($conn, "SELECT * FROM penjualan where id_produk='$row[id_produk]' and YEAR(tgl_trans)='$year' and MONTH(tgl_trans)='$bln'");
	$d = mysqli_fetch_array($s);
	$jual = $d['qty'];
	if (($row['stok'] - ($row['penjualan'] - $jual)) <= 0) {
		$kurang = ($row['penjualan'] - $jual) - $row['stok'];
		$waktu = $row['waktu_produksi'];
		$tothari = ceil(($waktu * $kurang) / $kary);
	} else {
		$tothari = 0;
		$kurang = 0;
	}
	$tothari1 = $tothari1 + $tothari;
}

?>
<div id="modal_theme_warning" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Notifikasi</h6>
			</div>

			<div class="modal-body">
				<!-- <?php $sa = mysqli_query($conn, "SELECT sum(qty) as tot FROM penjualan where YEAR(tgl_trans)='$year' and MONTH(tgl_trans)='$bln'");
						$ccd = mysqli_fetch_array($sa); ?>
												<p>Berdasarkan hasil peramalan penjualan menggunakan metode Exponential Smoothing, 
												peramalan penjualan bulan <b><?php echo $monthName ?></b> adalah sejumlah 
												<b><?php echo $ramal[$bln - 1] ?></b> produk. Telah terjual <b><?php echo $ccd['tot'] ?></b>. Target kekurangan penjualan bulan
												<b><?php echo $monthName ?></b> sebanyak <b><?php echo $ramal[$bln - 1] - $ccd['tot'] ?></b> produk</p>
												<p>Waktu produksi yang dibutuhkan untuk memenuhi pesanan, yaitu selama <b><?php echo $tothari1 ?> hari</b></p> -->

				<h6 class="text-semibold">Hasil Peramalan</h6>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" style="font-size:12px">
						<thead>
							<tr>
								<th style="width:25px"> #</th>
								<th>Nama Produk</th>
								<th>Quantity</th>
								<th>Kekurangan</th>
								<?php if ($_SESSION['status'] == 'mandor') { ?>
									<th>Action</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							$x = 1;
							$bahankain = array();
							$bahan = [];
							// $sql = mysqli_query($conn, "SELECT * FROM produk JOIN peramalan ON produk.id_produk = peramalan.id_produk WHERE YEAR(bulan)='$year' and MONTH(bulan)='$bln'");
							while ($row = mysqli_fetch_array($sql)) {
								$s = mysqli_query($conn, "SELECT * FROM penjualan where id_produk='$row[id_produk]' and YEAR(tgl_trans)='$year' and MONTH(tgl_trans)='$bln'");
								$d = mysqli_fetch_array($s);
								$jual = $d['qty'];
								if (($row['stok'] - ($row['penjualan'] - $jual)) <= 0) {
									$kurang = ($row['penjualan'] - $jual) - $row['stok'];
									if (!isset($bahan["$row[bahan_kain]"])) {
										$bahan["$row[bahan_kain]"] = $kurang;
									}
									if (!isset($bahan["$row[bahan_zipper]"])) {
										$bahan["$row[bahan_zipper]"] = $kurang;
									}
									if (!isset($bahan["$row[bahan_foam]"])) {
										$bahan["$row[bahan_foam]"] = $kurang;
									} else {
										$bahan["$row[bahan_kain]"] = $bahan["$row[bahan_kain]"] + $kurang;
										$bahan["$row[bahan_zipper]"] = $bahan["$row[bahan_zipper]"] + $kurang;
										$bahan["$row[bahan_foam]"] = $bahan["$row[bahan_foam]"] + $kurang;
									}

									echo "<tr>
																<td>" . $x . "</td>
																<td>" . $row['nama_produk'] . "</td>
																<td>" . $row['penjualan'] . "</td>
																<td>" . $kurang . "</td>";
									if ($_SESSION['status'] == 'mandor') {
										echo 	"<td><center><a href='?p=editstokproduk&id=$row[id_produk]' class='label bg-warning'>Add Stock</a></td>";
									}
									echo "</tr>";

									$x++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<hr>
				<h6 class="text-semibold">Kekurangan Bahan Produksi</h6>
				<table class="table table-bordered table-striped" style="font-size:12px">
					<thead>
						<tr>
							<th style="width:25px"> #</th>
							<th>Nama Bahan</th>
							<th>Kekurangan</th>
							<?php if ($_SESSION['status'] == 'admin') { ?>
								<th>Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$x = 1;
						foreach ($bahan as $item => $val) {
							$sql2 = mysqli_query($conn, "SELECT * from bahan where id_bahan='$item' limit 1");
							$c = mysqli_fetch_array($sql2);
							$kur = $val - $c['stok'];
							if ($kur > 0) {
								echo "<tr>
													<td>" . $x . "</td>
													<td>" . $c['nama_bahan'] . "</td>
                                                    <td>" . $kur . "</td>";
								if ($_SESSION['status'] == 'admin') {
									echo "<td><center><a href='?p=editstokbahan&id=$c[id_bahan]' class='label bg-warning'>Add Stock</a></td>";
								}
								echo "</tr>";
							}

							$x++;
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>