<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>


<a type="button" target="_blank" href="proses/testmetode.php" class="btn btn-success btn-sm legitRipple mb-20">Export Excel <i class="icon-file-excel"></i></a>
<a style="position: absolute;right: 2%;" type="button" target="_blank" href="proses/metode.php" class="btn btn-primary btn-sm legitRipple mb-20"><i class="icon-stack-plus"></i> Perhitungan</a>

<?php

include 'proses/koneksi.php';
$array = array();
$ramal = array();

$array2 = array();
$ramal2 = array();

// $array3 = array();
// $ramal3 = array();

// $array4 = array();
// $ramal4 = array();

$tahun = array();
$sql0 = mysqli_query($conn, "SELECT YEAR(tahun) as tahun FROM peramalan GROUP BY YEAR(tahun)");
while ($query = mysqli_fetch_array($sql0)) {
	array_push($tahun, $query['tahun']);
} //tahun 

$sql2 = mysqli_query($conn, "SELECT data_produk.id_produk,data_produk.nama_produk FROM data_produk"); // memanggil data produk

$a = 0;
while ($c = mysqli_fetch_array($sql2)) {
	$array[$a] = array();
	$ramal[$a] = array();
	$sql1 = mysqli_query($conn, "SELECT penjualan as dodol FROM peramalan WHERE id_produk = '$c[id_produk]'");

	while ($row = mysqli_fetch_array($sql1)) {
		array_push($array[$a], $row['dodol']); //penjualan
	}

	$query1 = mysqli_query($conn, "SELECT peramalan as ya FROM peramalan WHERE id_produk = '$c[id_produk]'");
	while ($row = mysqli_fetch_array($query1)) {
		array_push($ramal[$a], $row['ya']); //peramalan penjualan
	}

	?>
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title text-semibold">Grafik Penjualan <?= $c['nama_produk'] ?></h6>
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
				<div class="chart" id="c<?= $a + 1 ?>-grid-lines"></div>
			</div>
		</div>
	</div>
	<script>
		var grid_lines = c3.generate({
			bindto: '#c<?= $a + 1 ?>-grid-lines',
			size: {
				height: 400
			},
			color: {
				pattern: ['#2196F3', '#FF9800']

			},
			data: {

				columns: [

					['Penjualan', <?php
									$tmp = mysqli_num_rows($sql1);
									for ($i = 0; $i < $tmp; $i++) { ?>
							<?= $array[$a][$i] ?>,
						<?php } ?>
					],
					['peramalan penjualan', <?php
											$tmp = mysqli_num_rows($query1);
											for ($i = 0; $i < $tmp; $i++) { ?>
							<?= $ramal[$a][$i] ?>,
						<?php } ?>
					],
				]
			},
			axis: {
				x: {
					type: 'category',
					categories: [
						<?php
						$tmp = mysqli_num_rows($sql0);
						for ($i = 0; $i < $tmp; $i++) { ?>
							<?= $tahun[$i] ?>,
						<?php } ?>
					]
				}
			},
			grid: {
				x: {
					show: true
				},
				y: {
					show: true
				}
			}
		});
	</script>
	<?php $a++;
} ?>