<?php

    include "conn.php";
    $id = $_GET["id"];
    mysqli_query($con,"DELETE FROM data_transaksi WHERE id='$id'");
// print_r($id);   
header("location:../admin/data_transaksi.php");

?>