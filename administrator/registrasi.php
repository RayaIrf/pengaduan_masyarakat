<?php 
/* mendelklarasikan session start*/
SESSION_START();
if ($_SESSION['level'] != 'admin') {
        header('Location:/pengaduan_masyarakat/logout.php');
}

if (isset($_POST['registrasi'])) {
    /* include file yang didalamnya ada mysqli_connect*/
    include '../lib/database.php';

    /* query insert*/
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];


    $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUES ('$nama_petugas', '$username', '$password', '$telp', '$level')";
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {   
        echo '<script> alert ("data anda berhasil disimpan")</script>';
        header('Location:/pengaduan_masyarakat/administrator/index.php');
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
    <title>Registrasi Admin</title>
    <link rel="stylesheet" type="text/css " href="../dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/index.php" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>
                        <h2>Registrasi Admin Atau Petuags</h2>
                    </center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nama_petugas" placeholder="Nama Asli Anda" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="telp" placeholder="Nomor Telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <select name="level" class="form-control">
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="registrasi" value="Registrasi" class="form-control btn btn-success">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div> 
</body>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
</html>
