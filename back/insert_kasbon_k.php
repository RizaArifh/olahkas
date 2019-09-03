<?php
include "conn.php";

$tanggal = $_POST['tanggal'];
$nama_keterangan = $_POST['nama_orang'];
$kasbon = $_POST['kasbon'];

$data = mysqli_query($con,
"INSERT INTO data_transaksi (tanggal,ko,de,nama_kegiatan_keterangan,subnama_kegiatan,kredit) VALUES('$tanggal','K','4','Kas Bon Keluar','$nama_keterangan','$kasbon')");

$last = "SELECT MAX(id) AS last_id FROM data_transaksi";
$result = mysqli_query($con, $last);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$last_id = $row['last_id'];
if($last_id<=0){
    $l_1=1;
}else{

$l_1=$last_id-1;
}
// print_r($last_id);

$sald="SELECT saldo FROM data_transaksi where id=$l_1";
$rest= mysqli_query($con,$sald);
$row=mysqli_fetch_array($rest, MYSQLI_ASSOC);
$saldo=$row['saldo'];
// print_r($saldo);
// print_r($didebet);

$lastsaldo=($saldo-$kasbon);
// print_r($lastsaldo);
mysqli_query($con,"UPDATE data_transaksi SET saldo='$lastsaldo' where id='$last_id'");



$lastsaldo=($saldo-$kasbon);
// print_r($lastsaldo);
mysqli_query($con,"UPDATE data_transaksi SET saldo='$lastsaldo' where id='$last_id'");


header("location:../admin/kasbon.php");
?>