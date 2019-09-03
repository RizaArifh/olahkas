<?php

    include "conn.php";
    $id = $_GET["id"];
    mysqli_query($con,"DELETE FROM kegiatan WHERE id='$id'");
// print_r($id);   
header("location:../admin/kegiatan_rka.php");

?>