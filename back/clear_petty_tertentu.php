<?php
include "conn.php";
include "get_jml_sisa.php";
$id=$_GET['ids'];
mysqli_query($con,"delete from data_transaksi where de=3 and keterangan='$id'");

header("location:../admin/semua_petty.php?ids=$id");
?>