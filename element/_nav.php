<?php
session_start();
if($_SESSION['status']!='login'){
    header("location:../index.php");
}
?>
<div class="row navix">
    <div class="col col-md-7">      
    <a href="../admin/kegiatan_rka.php" class="btn btn-primary btn-md" >Kegiatan Sesuai RKA</a>  
        <a href="../admin/kasbon.php" class="btn btn-primary btn-md">KAS BON</a>
        <a href="../admin/pettycash.php" class="btn btn-primary btn-md">PETTY CASH</a>
        <a href="../admin/data_transaksi.php" class="btn btn-primary btn-md">Data Base/ Edit Transaksi</a>
    </div>
    <div class="col col-md-5">
        <a href="../admin/rekap_keg_rka.php" class="btn btn-secondary btn-md">Rekap Kegiaan Rka</a>
        <a href="../admin/rekap_kasbon.php" class="btn btn-secondary btn-md">Rekap Kasbon</a>
        <a href="../back/logout.php" class="btn btn-secondary btn-md">Logout</a>
    </div>
</div>


<br>