<?php 

if (isset($_POST['registrasi'])) {
    /* include file yang didalamnya ada mysqli_connect*/
    include '../lib/database.php';

    /* query insert*/
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];


    $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) VALUES ('$nik', '$nama', '$username', '$password', '$telp')";
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {   
        echo '<script> alert ("data anda berhasil disimpan")</script>';
        header('Location:/pengaduan_masyarakat/index.php');
    }else{
        echo '<script> alert ("data anda ada yang salah")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Masyarakat</title>
    <link rel="stylesheet" type="text/css " href="../dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/index.php" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>
                        <h2>Registrasi Masyarakat</h2>
                    </center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nama" placeholder="Nama Asli Anda" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username Anda" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="telp" placeholder="Nomor Telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="registrasi" value="Registrasi" class="form-control btn btn-primary">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>  
</body>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
</html>