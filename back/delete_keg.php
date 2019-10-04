<?php

    include "conn.php";
    $id = $_GET["id"];
    mysqli_query($con,"DELETE FROM kegiatan WHERE id='$id'");
    $m=1;
    $dataupdate=mysqli_query($con,"select * FROM kegiatan");
    foreach ($dataupdate as $row){
        $b=$row['id'];
        mysqli_query($con,"update kegiatan set no_keg='$m' where id='$b'");
        $m++;
    }
// print_r($id);   
header("location:../admin/kegiatan_rka.php?hapus=berhasil");

?>