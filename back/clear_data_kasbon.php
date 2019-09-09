<?php
include "conn.php";
mysqli_query($con,"delete from data_transaksi where de=4");

header("location:../admin/rekap_sertifikasi.php");
?>