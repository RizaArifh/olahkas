<?php
include "conn.php";

$nama=$_POST['in_nama'];

$lasta = "SELECT MAX(no_guru) AS last_no FROM guru_sertifikasi";
$resulta = mysqli_query($con, $lasta);
$rowa = mysqli_fetch_array($resulta, MYSQLI_ASSOC);
$last_ida = $rowa['last_no'];
if($last_ida<=0){
    $l_1a=1;
}else{

$l_1a=$last_ida+1;
}


$data = mysqli_query($con,
"INSERT INTO guru_sertifikasi (no_guru,nama_guru) VALUES('$l_1a','$nama')");

// print_r($nama);
header("location:../admin/sertifikasi.php");
?>