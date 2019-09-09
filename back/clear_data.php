<?php
include "conn.php";
mysqli_query($con,"delete from data_transaksi");

header("location:../admin/data_transaksi.php");
?>