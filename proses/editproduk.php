<?php
include 'koneksi.php';
include 'function.php';
$target_dir = "../img/produk/";
$target_file = $target_dir . basename($_FILES["fileimages"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if (empty($_FILES['fileimages']['tmp_name'])) {
    $name = $_POST['nama'];
    $id = $_POST['id'];
    $name = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $ket = $_POST['ket'];
    $ukuran = $_POST['ukuran'];

    $sql = mysqli_query($conn, "UPDATE data_produk SET nama_produk='$name', harga='$harga',stock='$stok',
    keterangan='$ket'where id_produk='$id'");
    if ($sql) {

        notif('success', 'Produk Berhasil Diedit');
        header("location: ../index.php?p=dataproduk");
    } else {
        notif('error', 'Produk Gagal diedit');
        header("location: ../index.php?p=dataproduk");
    }
} else {

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileimages"]["tmp_name"]);
        if ($check !== false) {
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
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $nfile = basename($_FILES["fileimages"]["name"]);
        $name = $_POST['nama'];
        $id = $_POST['id'];
        $name = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $ket = $_POST['ket'];
        $ukuran = $_POST['ukuran'];

        $sql = mysqli_query($conn, "SELECT * from produk where id_produk='$id'");
        $row = mysqli_fetch_array($sql);
        unlink('../img/produk/' . $row['img']);

        $sql = mysqli_query($conn, "UPDATE produk SET nama_produk='$name',ukuran='$ukuran', harga='$harga',stok='$stok',
        keterangan='$ket',img='$nfile',bahan_kain='$_POST[kain]',bahan_zipper='$_POST[zipper]',bahan_foam='$_POST[foam]',waktu_produksi='$_POST[hari]' where id_produk='$id'");

        if ($sql) {
            if (move_uploaded_file($_FILES["fileimages"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileimages"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            notif('success', 'Produk Berhasil diEdit');
            // header("location: ../index.php?p=dataproduk");
        } else {
            notif('error', 'Produk Gagal diedit');
            header("location: ../index.php?p=dataproduk");
        }
    }
}
