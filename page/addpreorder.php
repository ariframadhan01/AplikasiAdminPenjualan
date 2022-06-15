
<?php shownotif(); ?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
 <!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Tambah Pre Order
                <a class="heading-elements-toggle">
                    <i class="icon-more"></i>
                </a>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                    
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="proses/addpreorder.php">
                <fieldset class="content-group">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tanggal Pre Order</label>
                        <div class="col-lg-9">
                            <input type="text" name="tgl" class="form-control datepicker-dates" placeholder="Pick a date&hellip;">
                        </div>
                    </div>
                    
                <div class="form-group">
                        <label class="control-label col-lg-2" >Nama Produk</label>
                        <div class="col-lg-4">
                            <select name="produk" class="form-control">  
                                <?php $sql=mysqli_query($conn,"SELECT * FROM produk");
                                    while($row=mysqli_fetch_array($sql)){
                                ?>
                                <option value="<?php echo $row['id_produk'] ?>"><?php echo $row['nama_produk'] ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-2">Qty</label>
                        <div class="col-sm-2">
                            <input id="spinner-basic"  name="qty" class="form-control" min="0" value="0" required>
                        </div>
                    </div>

                    <div class="form-group">
						<label class="control-label col-lg-2">Customer</label>
						<div class="col-lg-4">
						<input type="text" name="customer" class="form-control" placeholder="">
						</div>
					</div>
				
                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
