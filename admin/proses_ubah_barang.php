<?php
    if ($_POST) {
        include "../connection.php";
        $id_barang=$_POST["id_barang"];
        $nama_barang = $_POST["nama_barang"];
        $deskripsi = $_POST ["deskripsi"];
        $harga = $_POST ["harga"];
        if ($_FILES['foto']['tmp_name']) {
            $file_tmp = $_FILES['foto']['tmp_name'];
            $file_name=rand(0,9999).$_FILES['foto']['name'];
            $file_size= $_FILES['foto']['size'];
            $file_type= $_FILES['foto']['type'];
            $folder="./assets/";
            $sql=mysqli_query($conn, "select * from barang where id_barang='$id_barang'");
            $barang=mysqli_fetch_array($sql);
            $path=$folder.$barang["foto"];
            if(file_exists($path)){
                unlink($path); 
            }
            if($file_size < 2048000 and ($file_type == "image/jpeg" or $file_type== "image/png" or $file_type == "image/jpg")){
                move_uploaded_file($file_tmp, $folder.$file_name);
                $update= mysqli_query ($conn, "update barang set nama_barang='".$nama_barang."', deskripsi='".$deskripsi."', harga='".$harga."',foto='".$file_name."'  where id_barang='".$id_barang."' ") or die (mysqli_error($conn));
                if ($update) {
                    echo "<script> alert ('Sukses update barang'); location.href='data_barang.php' ; </script>";  
                }else{
                    echo "<script> alert ('Gagal update barang'); location.href='data_barang.php' ; </script>";
                } 
            }
            else{
                echo "<script>alert('file tidak sesuai');location.href='data_barang.php';</script>";
            }
        }
        else{
            $update= mysqli_query ($conn, "update barang set nama_barang='".$nama_barang."', deskripsi='".$deskripsi."', harga='".$harga."', foto='".$file_name."' where id_barang='".$id_barang."' ") or die (mysqli_error($conn));
                if ($update) {
                    echo "<script> alert ('Sukses update barang'); location.href='data_barang.php' ; </script>";  
                }else{
                    echo "<script> alert ('Gagal update barang'); location.href='data_barang.php' ; </script>";
                } 
        }
    }
?>