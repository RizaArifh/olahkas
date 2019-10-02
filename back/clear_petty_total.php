<?php
include "conn.php";
// include "get_jml_sisa.php";
mysqli_query($con,"delete from data_transaksi where de=3");

header("location:../admin/pettycash.php");
?>