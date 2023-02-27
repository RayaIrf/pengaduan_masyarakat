<?php 
SESSION_START();
SESSION_UNSET();
SESSION_DESTROY();
$_SESSION = array();
header('Location:/pengaduan_masyarakat/index.php');


?>