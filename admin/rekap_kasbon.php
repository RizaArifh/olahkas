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
    <div class="container-fluid">
<?php
    include "../element/_nav.php"
    ?>
    <h2>REKAPITULASI KASBON</h2>
    <h3>Per : <?= date('d-m-Y'); ?></h3> 
    
    <a href="../back/clear_data_sertifikasi.php">Clear Data</a>
    
<div class="row justify-content-center">

<div class="table_rekap_keg"style="width:70%;" >
<table class=" table table-hover" style="height:40%;">
        <tr style="background:#2891DD; color:white;">
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Pinjam</th>
            <th>Kembali</th>
            <th>Kas Bon</th>
            <th>Saldo Berjalan</th>
            <th>Detail</th>
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
            $kred=0;
            $debt=0;
            $p = 1;
            $sub=$row["subnama_kegiatan"];
            $data_kasbon= mysqli_query($con,"SElECT * FROM data_transaksi where subnama_kegiatan='$sub' and de=2");
            while($row2=mysqli_fetch_array($data_kasbon)){
                $kred=$kred+$row2['kredit'];
                $p++;
                $debt=$debt+$row2['debet'];
            }
            
            $saldo=$kred-$debt;
            ?>
            <td><?php echo $kred; ?></td>
            <td><?php echo $debt; ?></td>
            <td><?php echo $saldo?></td>
            <?php
            $saldo_berjalan=$saldo_berjalan+$kred;
            ?>
            <td><?php echo $saldo_berjalan;?>
        </td>
        <td><a href="rekap_kasbon_detail.php?nama=<?php echo $row['subnama_kegiatan']; ?>">Detail</a></td>
        </tr>
        <?php
        $i++;
    }?>
        </tbody>
    </table>
    </div></div></div>
</body>
</html>