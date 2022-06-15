
	<!-- Theme JS files -->
<?php 
include 'proses/koneksi.php';
$sql=mysqli_query($conn,"SELECT * FROM preorder join produk on preorder.id_produk=produk.id_produk");
shownotif();
?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Data Pre Order</h5>
							<div class="heading-elements">
							</div>
						</div>
						<table class="table datatable-pagination">
						
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Kualifikasi</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th>Keterangan</th>
                                    <?php if($_SESSION['status']=='mandor'){ ?>
                                    <th>Action</th>
                                    <?php } ?>
								</tr>
							</thead>
							<tbody>
                                <?php 
                                    $no=1 ; 
                                    while($row=mysqli_fetch_array($sql)){
                                ?>
								<tr>
									<td><?php echo $no ?></td>
                                    <td><?php echo $row['tgl_trans'] ?></td>
                                    <td><?php echo $row['nama_produk'] ?></td>
                                    <td><?php echo $row['id_produk'] ?></td>
                                    <td><span class="label label-success"><?php echo $row['qty'] ?></span></td>
                                    <td>Rp. <?php echo $row['harga'] ?></td>
                                    <td>Rp. <?php echo $row['harga']*$row['qty'] ?></td>
                                    <td><?php echo $row['customer'] ?></td>
                                    <td><?php if($row['ket']=='menunggu'){ echo '<span class="label label-warning">'.$row['ket'].'</span>';}else{echo '<span class="label label-success">'.$row['ket'].'</span>';} ?></td>
                                    <?php if($_SESSION['status']=='mandor' and $row['ket']=='menunggu'){ ?>
                                    <td><center><a href='proses/statuspreorder.php?id=<?php echo $row['id_transaksi'] ?>' class='btn btn-info btn-xs legitRipple'>Ready ?</a></center></td>
                                    <?php }else{ ?>
                                        <td></td>
                                    <?php } ?>
                                </tr>
                                <?php $no++; }?>
								
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