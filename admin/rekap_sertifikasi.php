<?php

include "../back/conn.php";
 $datatotal = mysqli_query($con,"SElECT * FROM data_transaksi where de=2 group by subnama_kegiatan order by id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "../element/boots.php"?>
    <title>Rekapitulasi Kegiatan RKA</title>
</head>
<body>
<?php
    include "../element/_nav.php"
    ?>
    <h2>REKAPITULASI SERTIFIKASI</h2>
    <h3>Per : <?= date('d-m-Y'); ?></h3> 
    
    <a href="../back/clear_data_sertifikasi.php">Clear Data</a>
    <table class="table1" border="1" align=center cellpadding="10" cellspacing="0" id="tabel_pertama">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama</th>
            <th style="text-align:center" colspan="4">JUMLAH</th>
        </tr>
        <tr>
        <th>Yg Harus Di Bayar</th>
        <th>Sudah Di Bayar</th>
        <th>Kurang Di Bayar</th>
        <th>Saldo Berjalan</th>
        </tr>
        <?php $i = 1;
    $saldo_rekap=0;
    $saldo_berjalan=0; ?>
<?php foreach ( $datatotal as $row ) : ?>
<tr>
    
    <td><?php echo $i; ?></td>
    <td><?php echo $row["subnama_kegiatan"]; ?></td>    
    <?php
    
    $sub=$row["subnama_kegiatan"];
    $kred=0;
    $debt=0;
    $kurang=0;
    $data_orang= mysqli_query($con,"SElECT * FROM data_transaksi where subnama_kegiatan='$sub'");
    $data_orang2= mysqli_query($con,"SElECT * FROM data_transaksi where subnama_kegiatan='$sub'");
    while($row2=mysqli_fetch_array($data_orang)){
        $kred=$kred+$row2['kredit'];
    }
    while($row3=mysqli_fetch_array($data_orang2)){
        $debt=$debt+$row3['debet'];
    }
    ?>
    <td><?php echo $kred;?></td>
    <td><?php echo $debt;?></td>
    <?php 
    
    $kurang=$row['kredit']-$row['debet'];
    $saldo_rekap=$saldo_rekap+$row['debet']-$row['kredit'];
    
if($kurang<0){
        $kurang=0;
    }?>
    <td><?php echo $kurang; ?></td>
    
    <?php 
    
    if($i==1){?>
    
    <td><?php $saldo_berjalan=$debt; echo $saldo_berjalan; ?></td>
    <?php
}else{
$saldo_berjalan=$saldo_berjalan+$debt;?>
<td><?php echo $saldo_berjalan; ?></td><?php
}
        ?>
    
    
</tr>
<?php $i++; ?>
<?php endforeach; ?>
    </table>
</body>
</html>