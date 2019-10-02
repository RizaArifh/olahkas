
<?php
include "conn.php";

$tanggal = $_POST['tgl_akhir'];
$sisa = $_POST['sisa'];
$sesi = $_POST['sesi_petty'];
$tanggall=date("Y-m-d",strtotime($tanggal));

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,kredit,keterangan) VALUES('$tanggall','K','4','Dana Keluar Petty dan Kas Bon','Petty dan Kas Bon','$sisa','$sesi')");



header("location:../admin/pettycash.php");
?>