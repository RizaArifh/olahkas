<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$tersedia = $_POST['jumlah_tersedia'];
$tanggall=date("Y-m-d",strtotime($tanggal));


?>