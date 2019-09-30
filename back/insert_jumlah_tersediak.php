<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$dana = $_POST['jumlah_tersedia'];
$nama_keg = $_POST['nama_keg'];
$tanggall=date("Y-m-d",strtotime($tanggal));

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,debet,keterangan) VALUES('$tanggall','D','4','Dana Masuk Petty dan Kas Bon','Petty dan Kas Bon','$dana','$keterangan')");



header("location:../admin/pettycash.php");
?>