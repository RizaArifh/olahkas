<?php
include "conn.php";
$nama=$_GET['nama'];
mysqli_query($con,"delete from data_transaksi where de=1 and subnama_kegiatan='$nama'");

header("location:../admin/rekap_keg_rka.php");
?>