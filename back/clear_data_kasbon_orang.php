<?php

include "conn.php";
$nama = $_GET["nama"];
mysqli_query($con,"delete from data_transaksi where subnama_kegiatan='$nama'");

header("location:../admin/rekap_kasbon.php");
?>