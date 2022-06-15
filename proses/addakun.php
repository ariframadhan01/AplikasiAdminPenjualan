<?php
include 'koneksi.php';
include 'function.php';
$target_dir = "../img/user/";
$target_file = $target_dir . basename($_FILES["fileimages"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileimages"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileimages"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $nfile=basename($_FILES["fileimages"]["name"]);
    $name=$_POST['nama'];
    $username=$_POST['username'];
    $pass=md5($_POST['password']);
    $status=$_POST['status'];


    $sql=mysqli_query($conn,"insert into user values('$username','$name','$pass','$nfile','$status')");
  
    
    if($sql){
        if (move_uploaded_file($_FILES["fileimages"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileimages"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        notif('success','Akun Berhasil Ditambahkan'); 
        header("location: ../index.php?p=akun");
    }else{
        notif('error','Akun Gagal Ditambahkan');
        header("location: ../index.php?p=akun");
    }

}
?>