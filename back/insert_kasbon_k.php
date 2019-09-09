<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$nama_keterangan = $_POST['nama_orang'];
$kasbon = $_POST['kasbon'];

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,kredit) VALUES('$tanggal','K','4','Kas Bon Keluar','$nama_keterangan','$kasbon')");


header("location:../admin/kasbon.php");
?>