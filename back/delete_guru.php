<?php

    include "conn.php";
    $id = $_GET["id"];
    mysqli_query($con,"DELETE FROM guru_sertifikasi WHERE id='$id'");
// print_r($id);   
header("location:../admin/sertifikasi.php");

?>