<?php
include 'proses/koneksi.php';


$sql=mysqli_query($conn,"SELECT * FROM user");
 
shownotif();
if(isset($_GET['u'])){
    $sql2=mysqli_query($conn,"SELECT * From user where username='$_GET[u]'");
    $row=mysqli_fetch_array($sql2);
    $name=$row['nama'];
    $username=$row['username'].'" readonly="';
    $password='disabled ';
    $link='proses/editakun.php';
    $img='';
    $title='Edit';
    $status=$row['status'];    
}else{
    $name="";
    $username="";
    $password="";
    $link="proses/addakun.php";
    $img='required';
    $title='Tambah';
    $status='';    
}
?>

<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>

<div class="col-md-6">
    <!-- Dropdown list -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Data Akun
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
                        <a data-action="reload"></a>
                    </li>
                    <li>
                        <a data-action="close"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            
            <ul class="media-list">
                <?php while($row=mysqli_fetch_array($sql)){ ?>
                <li class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img src="img/user/<?php echo $row['img'] ?>" class="img-circle img-md" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <div class="media-heading text-semibold"><?php echo $row['nama'] ?></div>
                        <span class="text-muted"><?php echo $row['username'] ?></span>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list text-nowrap">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="?p=akun&u=<?php echo $row['username']?>" >
                                            <i class="icon-pencil3"></i> Edit</a>
                                    </li>
                                    <li>
                                        <a onclick="sweet_warning('<?php echo $row['username']?>')" >
                                            <i class="icon-trash"></i> Delete</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                 <?php } ?>
            </ul>
           
        </div>
        </li>
        </ul>
    </div>
</div>
<div class="col-md-6">

    <!-- Basic layout-->
    <form action="<?php echo $link ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title"><?php echo $title ?> Akun
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
                            <a data-action="reload"></a>
                        </li>
                        <li>
                            <a data-action="close"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Name:</label>
                    <div class="col-lg-9">
                        <input type="text" name="nama"  value="<?php echo $name ?>" class="form-control" placeholder="admin" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">username:</label>
                    <div class="col-lg-9">
                        <input type="text" name="username" value="<?php echo $username ?>" class="form-control" placeholder="admin" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Password:</label>
                    <div class="col-lg-9">
                        <input type="password" name="password" <?php echo $password ?> class="form-control" placeholder="Your strong password" required>
                    </div>
                </div>
                <div class="form-group">
                        <label class="control-label col-lg-3" >Status</label>
                        <div class="col-lg-4">
                            <select name="status" class="form-control">  
                                <option value="manager" <?php if($status=='manager'){echo "Selected" ;} ?>>Manager</option>
                                <option value="admin" <?php if($status=='admin'){echo "Selected" ;} ?>>Admin</option>
                                <option value="mandor" <?php if($status=='mandor'){echo "Selected" ;} ?>>Mandor</option>
                                
                            </select>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Your avatar:</label>
                    <div class="col-lg-9">
                        <input type="file" <?php echo $img ?> name="fileimages" class="file-styled" >
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic layout -->

</div>
<!-- /dropdown list -->

<script type="text/javascript">

function sweet_warning(id){
        swal({
            title: "Are you sure?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Yes, delete it!"
            
        },
        function(isConfirm){
            if (isConfirm) {
               window.location.href="proses/deleteakun.php?u="+id;
            }
            
        });
        
     }


</script>