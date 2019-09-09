<?php

    include "conn.php";
    $id = $_GET["id"];
    mysqli_query($con,"DELETE FROM orang_kasbon WHERE id='$id'");
// print_r($id);   
header("location:../admin/kasbon.php");

?>