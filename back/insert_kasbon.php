<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$nama_keg = $_POST['nama_orang'];
// $no_keg = $_POST['no_kegiatan'];
$dibayar = $_POST['dibayar'];
// $keterangan = $_POST['keterangan'];

$data = mysqli_query($con, 
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,debet) VALUES('$tanggal','D','2','Kas Bon Masuk','$nama_keg','$dibayar')");


header("location:../admin/kasbon.php");
?>