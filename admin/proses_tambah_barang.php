<?php
    if($_POST){
        $nama_barang=$_POST['nama_barang'];
        $deskripsi=$_POST['deskripsi'];
        $kategori=$_POST['kategori'];
        $harga=$_POST['harga'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_name=rand(0,9999).$_FILES['foto']['name'];
        $file_size= $_FILES['foto']['size'];
        $file_type= $_FILES['foto']['type'];

        include "../connection.php";
        global $conn;
        if($file_size < 2048000 and ($file_type == "image/jpeg" or $file_type== "image/png")){
            move_uploaded_file($file_tmp, './assets/'.$file_name);
            $insert=mysqli_query($conn,"insert into barang (nama_barang, deskripsi, kategori, harga, foto) value ('".$nama_barang."', '".$deskripsi."', '".$kategori."', '".$harga."', '".$file_name."')") or die(mysqli_error($conn));
            if($insert){
                echo "<script>alert('Sukses menambahkan barang');location.href='data_barang.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan barang');location.href='data_barang.php';</script>";
            } 
        }else{
            echo "<script>alert('file tidak sesuai');location.href='data_barang.php';</script>";
        }  
    }
    
?>