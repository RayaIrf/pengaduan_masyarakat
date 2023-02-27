<!-- ini untuk login masyarakat -->
<?php 
/* mendelklarasikan session start*/
    SESSION_START();
if (isset($_SESSION['id'])) {
    if ($_SESSION['level'] == 'masyarakat') {
        header('Location:/pengaduan_masyarakat/masyarakat/menulis-pengaduan.php');
    } elseif (($_SESSION['level'] == 'admin') or ($_SEESION['level'] == 'petugas')) {
        header('Location:/pengaduan_masyarakat/administrator/verifikasi/nonvalid.php');
    } else {
        header('Location:/pengaduan_masyarakat/logout.php');
    }
}
if (isset($_POST['login'])) {
    /* melkukan query dari username dan password yang didapatkan di form (html) ke dlam mysql*/

    /* melakukan koneksi ke database*/
    include 'lib/database.php';

    /* mendapatkan data dari form dengan method post*/
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* melakukan query*/
    $query = "SELECT * FROM masyarakat WHERE username='$username' AND password='$password';";

    $execQuery = mysqli_query($koneksi, $query);

    /* melakukan aksi untuk mendapatkan data yang keluar dari hasil query*/
    $getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

    /* melakukan aksi mendapatkan jumlah dari data yang keluar setelah eksekusi query*/
    $numRows = mysqli_num_rows($execQuery);

    if ($numRows == 1) {
        /* data user dan pasword yang berhasil login dilakukan penyimpanan di variable session*/
        foreach ($getData as $data) {
            $_SESSION['id'] = $data['nik'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = 'masyarakat';
        };
        /* header ini digunakan untuk melempar ke halaman yang di maksud di (Location)*/
        header('Location:masyarakat/menulis-pengaduan.php');
        echo '<script> alert("data anda benar") </script>';
    } else {
        echo '<script> alert("data anda salah") </script>';
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css "href="dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar">

    </nav>
    <div class="container">
        <div class="row justify-content-center align-center">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>Login Masyarakat</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="username" class="form-control" required/>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="password" class="form-control" required/>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="login" value="login" class="form-control btn btn-primary"/>
                        </div>
                    </form>
                    <a href="/pengaduan_masyarakat/masyarakat/registrasi.php" class="nav-link">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
</html>