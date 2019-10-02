<?php
include "conn.php";
mysqli_query($con,"delete from data_transaksi where de=2");

header("location:../admin/kasbon.php");
?>