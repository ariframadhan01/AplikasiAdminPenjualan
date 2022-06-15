<?php 
include 'proses/koneksi.php';
$sql=mysqli_query($conn,"SELECT * FROM karyawan");
$row=mysqli_fetch_array($sql);

 shownotif(); ?>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Jumlah Data Karyawan
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
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12">
                    <form action="proses/addkaryawan.php" method="POST" class="main-search">
                        <div class="input-group content-group" style="padding-top: 15px;">
                            <div class="has-feedback has-feedback-left">
                                <input type="text" name="kary" value="<?php echo $row['jml_kary'] ?>" class="form-control input-xlg">
                                <div class="form-control-feedback" style="padding-top: 15px;">
                                <i class="icon-users4 text-muted text-size-base"></i>
                                </div>
                            </div>

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-xlg legitRipple">UPDATE</button>
                            </div>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>