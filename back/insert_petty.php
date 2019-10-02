<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$tanggall=date("Y-m-d",strtotime($tanggal));
$nama_keg = $_POST['nama_keg'];
$penerima = $_POST['nama_penerima'];
$jumlah = $_POST['jumlah'];
$sesi = $_POST['sesi_petty'];

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,kredit,keterangan) VALUES('$tanggall','K','3','$nama_keg','$penerima','$jumlah','$sesi')");


header("location:../admin/pettycash.php");
?>