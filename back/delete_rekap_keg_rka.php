<?php

include "conn.php";
$nama = $_GET["nama"];
mysqli_query($con,"delete from data_transaksi where de=1 and subnama_kegiatan='$nama' or de=1 and nama_kegiatan_keterangan='$nama'");
header("location:../admin/rekap_keg_rka.php");
?>