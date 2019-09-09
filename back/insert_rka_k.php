<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$nama_keg = $_POST['nama_keg'];
$no_keg = $_POST['no_kegiatan'];
$sub_keg = $_POST['sub_kegiatan'];
$kredit = $_POST['kredit'];

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,kredit) VALUES('$tanggal','K','1','$nama_keg','$sub_keg','$kredit')");


header("location:../admin/data_transaksi.php");
?>