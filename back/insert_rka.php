<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$tanggall=date("Y-m-d",strtotime($tanggal));
$nama_keg = $_POST['nama_keg'];
$no_keg = $_POST['no_kegiatan'];
$didebet = $_POST['didebet'];
$keterangan = $_POST['keterangan'];

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,debet,keterangan) VALUES('$tanggall','D','1','Kas Kegiatan Masuk','$nama_keg','$didebet','$keterangan')");


header("location:../admin/data_transaksi.php");
?>