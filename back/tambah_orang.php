<?php
include "conn.php";

// $no=$_POST['in_no_keg'];
$nama=$_POST['in_nama'];

$lasta = "SELECT MAX(no_orang) AS last_no FROM orang_kasbon";
$resulta = mysqli_query($con, $lasta);
$rowa = mysqli_fetch_array($resulta, MYSQLI_ASSOC);
$last_ida = $rowa['last_no'];
if($last_ida<=0){
    $l_1a=1;
}else{

$l_1a=$last_ida+1;
}


$datacek = mysqli_query($con,
"SELECT * FROM orang_kasbon WHERE nama_orang='$nama'");
$num=mysqli_num_rows($datacek);
 
if($num > 0){ // user ditemukan

    header("location:../admin/kasbon.php?hasil=ada_sama");}
else{
    $data = mysqli_query($con,
    "INSERT INTO orang_kasbon (no_orang,nama_orang) VALUES('$l_1a','$nama')");
    
header("location:../admin/kasbon.php");
}
?>