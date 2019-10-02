<?php
include "conn.php";
mysqli_query($con,"delete from data_transaksi where de=4 and subnama_kegiatan='Petty dan Kas Bon'");

header("location:../admin/pettycash.php");
?>