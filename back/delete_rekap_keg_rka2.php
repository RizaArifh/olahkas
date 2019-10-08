<?php

include "conn.php";
$id = $_GET["id"];
mysqli_query($con,"delete from data_transaksi where de=1 and id='$id'");
header("location:../admin/rekap_keg_rka2.php");
?>