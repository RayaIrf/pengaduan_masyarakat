<?php
include '../lib/database.php';
SESSION_START();

if ($_SESSION['level'] != 'masyarakat') {
    header('Location:/pengaduan_masyarakat/logout.php');
}

$id_user = $_SESSION['id'];
$queryShowData = "SELECT * FROM pengaduan WHERE nik = '$id_user'";
$execQueryShowData= mysqli_query($koneksi, $queryShowData);
$getAllData = mysqli_fetch_all($execQueryShowData, MYSQLI_ASSOC);

if (isset($_POST['adukan'])) {
    
    
    $laporan = $_POST['laporan'];

    /* Method untuk memindahkan file dari temp ke server*/
    $locationTemp = $_FILES['foto']['tmp_name'];
    $destinationFile = '../assets/img/';
    /* servername dibyat localhost jika tidak menggunakan port*/
    $ServerName = 'http://localhost/pengaduan_masyarakat/assets/img/';

    $fileName = str_replace(' ','',$_FILES['foto']['name']);
    $locationUpload = $destinationFile.$fileName;
    move_uploaded_file($locationTemp, $locationUpload);

    /* data pada field foto diisi apa?*/
    $query = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) VALUES (now(), '$id_user', '$laporan', '$ServerName$fileName', NULL)" ;
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {
        header('Location:/pengaduan_masyarakat/masyarakat/menulis-pengaduan.php');
    } else {
        echo '<script> alert("Data aduan ada yang salah penulisan")</script>';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aduan</title>
    <link rel="stylesheet" type="text/css " href="../dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/masyarakat/menulis-pengaduan.php" class="nav-link">Menulis Aduan</a>
                </li>
            </ul>
            <div>
                <?php
                    echo $_SESSION['nama'].'<a href="/pengaduan_masyarakat/logout.php">Logout</a>';
                ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="col-lg-6">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Foto Penunjang</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi Aduan</label>
                        <textarea name="laporan" class="form-control" placeholder="Masukan Laporan Anda"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="adukan" value="Adukan" class="form-control btn btn-danger">
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Aduan</th>
                            <th>Foto</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($getAllData as $data) {
                                $no+=1;
                                if ($data['status'] == NULL) {
                                    $status = 'Belum Valid';
                                } else if ($data['status'] == '0') {
                                    $status = 'Valid';
                                }
                                else {
                                    $status = $data['status'];
                                }
                                echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$data[tgl_pengaduan]</td>
                                    <td>
                                    <img src = $data[foto] class='img img-thumbnail' width=100px>
                                    </td>
                                    <td>$data[isi_laporan]</td>
                                    <td>
                                    $status
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    
</body>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
</html>