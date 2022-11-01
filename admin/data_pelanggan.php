<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data pembeli</title>
</head>
<body>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data pembeli</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Kit Font Awesome -->
    <script src="https://kit.fontawesome.com/1a01d4b743.js" crossorigin="anonymous"></script>

    <!-- Link Css -->
    <link rel="stylesheet" href="./css/datapembeli.css">
    <link rel="stylesheet" href="./css/navbar.css">
</body>
    <?php 
        require 'navbar.php';
    ?>

<div class="container my-3">
        <div class="card">
            <div class="card-header">
               <h3 class="text-center mt-2 mb-3">Data pembeli<h3>    
                <form action="data_pembeli.php" method="post">
                    <!-- <input type="text" name="cari" class="form-control mb-3" placeholder="Masukkan keyword pencarian"> -->
                </form> 
            </div>
            <div class="card-body">
                <table class="table table-bordered fs-5 fw-light text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No.Telp</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "../connection.php";
                            if (isset($_POST["cari"])) {
                                // jika ada keyword pencarian 
                                $cari=$_POST['cari'];
                                $query_pembeli= mysqli_query($conn,"SELECT * FROM pembeli WHERE id_pembeli LIKE '%$cari%' OR nama_pembeli LIKE '%$cari%' OR username LIKE '%$cari%' OR alamat LIKE '%$cari%'");
                            }else{
                                //jika tidak ada keyword pencarian
                                $query_pembeli= mysqli_query($conn,"SELECT * FROM pembeli");
                            }
                            while($data_pembeli= mysqli_fetch_assoc($query_pembeli)) { ?>
                                <tr>
                                    <td><?= $data_pembeli["nama_pembeli"]; ?></td>
                                    <td><?= $data_pembeli["alamat"]; ?></td>
                                    <td><?= $data_pembeli["no_tlp"]; ?></td>
                                    <td><?= $data_pembeli["username"]; ?></td>
                                    <td> <a href="hapus_pembeli.php?id_pembeli=<?=$data_pembeli['id_pembeli']?>" onclick="return confirm ('Apakah anda yakin menghapus data ini?')" ><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                            <!-- Jumlah Pelangggan -->
                             <?php 
                            include '../connection.php';
                            $data_pembeli = mysqli_query($conn,"SELECT * FROM pembeli");
                                // menghitung data barang
                            $jumlah_barang_data = mysqli_num_rows($data_pembeli);
                            $jumlah_barang = $jumlah_barang_data;

                            ?>
                        
                            <p>Jumlah data pembeli : <b><?php echo $jumlah_barang_data; ?></b></p>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</html>