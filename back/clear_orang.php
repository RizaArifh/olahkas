<?php
include "conn.php";
mysqli_query($con,"delete from orang_kasbon");

header("location:../admin/kasbon.php");
?>