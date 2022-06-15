
	<!-- Theme JS files -->
<?php 
include 'proses/koneksi.php';
$sql=mysqli_query($conn,"SELECT * FROM bahan");
shownotif();
?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Data Bahan</h5>
							<div class="heading-elements">
								<?php if($_SESSION['status']=='admin'){ ?>
								<a href="?p=addbahan" type="submit" class="btn btn-primary">Add Bahan
									<i class="icon-googleplus5 position-right"></i>
								</a>
								<?php } ?>
							</div>
						</div>
						<table class="table datatable-pagination">
						
							<thead>
								<tr>
									<th>Nama Bahan</th>
									<th>Satuan</th>
									<th>Stok</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
                                <?php while($row=mysqli_fetch_array($sql)){?>
								<tr>
									<td><?php echo $row['nama_bahan'] ?></td>
									<td><a href="#"><?php echo $row['satuan'] ?></a></td>
									
									<td><span class="label label-success"><?php echo $row['stok'] ?></span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="?p=addbahan&id=<?php echo $row['id_bahan'] ?>"><i class="icon-pencil"></i>Edit</a></li>
													<li><a href="proses/deletebahan.php?id=<?php echo $row['id_bahan'] ?>"><i class="icon-trash"></i>Delete</a></li>
													
												</ul>
											</li>
										</ul>
									</td>
                                </tr>
                                <?php }?>
								
							</tbody>
						</table>
					</div>
                    <!-- /pagination types -->
                    <script>
                        $(document).ready(function(){

                        /* ------------------------------------------------------------------------------
*
*  # Basic datatables
*
*  Specific JS code additions for datatable_basic.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */


                        }); 
                        </script>