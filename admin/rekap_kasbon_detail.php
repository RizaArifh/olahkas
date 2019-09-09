<?php

include "../back/conn.php";
$nama_get=$_GET['nama'];
 $datatotal = mysqli_query($con,"SElECT * FROM data_transaksi where subnama_kegiatan='$nama_get'");

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
    
    <h2>Detail Kasbon Atas Nama : <?= $nama_get;?></h2>
    <h3>Per : <?= date('d-m-Y'); ?></h3> 
    
    <a href="../back/clear_data_sertifikasi.php">Clear Data</a>
    <?php
    $k=0;
    ?>
    <table class="table1" border="1" align=center cellpadding="10" cellspacing="0" id="tabel_pertama">
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Pinjam</th>
            <th>Kembali</th>
            <th>Kas Bon</th>
            <th>Saldo Berjalan</th>
        </tr>
        <tbody>
        <?php 
        $i=1;
        $saldo_berjalan=0;
        foreach($datatotal as $row){?>
        <tr>
            <td><?php echo $row["tanggal"]; ?></td>    
            <td><?php echo $row["subnama_kegiatan"]; ?></td>
            <?php
            if($row['ko']=='K'){
                ?><td>Pinjam</td><?php
            }else{
                ?><td>Kembali</td><?php
            }
            ?>    
            <td><?php echo $row["kredit"]; ?></td>    
            <td><?php echo $row["debet"]; ?></td>    
            <?php
            
            $kred=$row['kredit'];
            $debt=$row['debet'];
            $k=$k+$kred-$debt;
            
            ?>
            <td><?= $k;?></td>
            <?php 
            $saldo_berjalan=$saldo_berjalan+$row['kredit'];
            ?>
        <td><?= $saldo_berjalan?></td>
        </tr>
        <?php
        $i++;
    }?>
        </tbody>
    </table>
    
</body>
</html>