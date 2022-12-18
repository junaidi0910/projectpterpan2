<?php 
$koneksi=mysqli_connect("localhost","root","","db_sidriver");
if (mysqli_connect_error()) {
	echo "koneksi ke database gagal".mysqli_connect_error();
}
?>