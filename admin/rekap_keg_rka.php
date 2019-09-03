<?php

include "../back/conn.php";
 $datatotal = mysqli_query($con,"SElECT * FROM data_transaksi where de=1");

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
    <h2>REKAPITULASI KEGIATANN SESUAI RKA</h2>
    <h3>Per : <?= date('d-m-Y'); ?></h3> 
    
    <a href="../back/clear_data_keg.php">Clear Data</a>

    <button onclick="show_hide()">pilih tabel</button>

    <table class="table1" border="1" align=center cellpadding="10" cellspacing="0" id="tabel_kedua" >

<tr>
    <th>No.</th>
    <th>Aksi</th>
    <th>Kegiatan</th>
    <th>Sub Kegiatan</th>
    <th>Pemasukan</th>
    <th>Pengluaran</th>
    <th>Saldo</th>
    <th>Saldo Berjalan</th>
    
</tr>

<?php $i = 1;
    $saldo_rekap=0;
    $saldo_berjalan=0; ?>
<?php foreach ( $datatotal as $row ) : ?>
<tr>
    <td><?php echo $i; ?></td>
    <td>
        <a href="ubah.php?id=<?php echo $row ["id"]; ?>">ubah</a> |
        <a href="hapus.php?id=<?php echo $row ["id"]; ?>"onclick="return confirm ('yakin tak?');">hapus</a>
    </td>
    <?php 
    if($row['ko']=='D'){?>
        <td><?php echo $row["subnama_kegiatan"]; ?></td>    
    <?php
    }else{?>
        <td><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
        <?php
    };
    ?>
    <?php 
    if($row['ko']=='D'){?>
        <td><?php echo $row["keterangan"]; ?></td>    
    <?php
    }else{?>
        <td><?php echo $row["subnama_kegiatan"]; ?></td>
        <?php
    }
    ?>
    <td><?php echo $row["debet"]; ?></td>
    <td><?php echo $row["kredit"]; ?></td>
    <?php 
    $saldo_rekap=$saldo_rekap+$row['debet']-$row['kredit'];
    ?>
    <td><?php echo $saldo_rekap; ?></td>
    <?php 
    
    if($i==1){?>
    
    <td><?php $saldo_berjalan=$saldo_rekap; echo $saldo_rekap; ?></td>
    <?php
}else{
$saldo_berjalan=$saldo_berjalan+$saldo_rekap;?>
<td><?php echo $saldo_berjalan; ?></td><?php
}
        ?>
    
    
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>
<table class="table1" border="1" align=center cellpadding="10" cellspacing="0" id="tabel_pertama" >

<tr>
    <th>No.</th>
    <th>Aksi</th>
    <th>Kegiatan</th>
    <th>Pemasukan</th>
    <th>Pengluaran</th>
    <th>Saldo</th>
    <th>Saldo Berjalan</th>
    
</tr>
<tbody>
<?php $i = 1;
    $saldo_rekap=0;
    $saldo_berjalan=0; ?>
<?php foreach ( $datatotal as $row ) : ?>
<tr>
    <td><?php echo $i; ?></td>
    <td>
        <a href="ubah.php?id=<?php echo $row ["id"]; ?>">ubah</a> |
        <a href="hapus.php?id= <?php echo $row ["id"]; ?>"onclick="return confirm ('yakin tak?');">hapus</a>
    </td>
    <?php 
    if($row['de']='D'){?>
        <td><?php echo $row["subnama_kegiatan"]; ?></td>    
    <?php
    }else{?>
        <td><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
        <?php
    }
    ?>
    <td><?php echo $row["debet"]; ?></td>
    <td><?php echo $row["kredit"]; ?></td>
    <?php 
    $saldo_rekap=$saldo_rekap+$row['debet']-$row['kredit'];
    ?>
    <td><?php echo $saldo_rekap; ?></td>
    <?php 
    
    if($i==1){?>
    
    <td><?php $saldo_berjalan=$saldo_rekap; echo $saldo_rekap; ?></td>
    <?php
}else{
$saldo_berjalan=$saldo_berjalan+$saldo_rekap;?>
<td><?php echo $saldo_berjalan; ?></td><?php
}
        ?>
    
    
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</tbody>
</table>
<script>
$( document ).ready(function() {
    var y = document.getElementById("tabel_kedua");
    y.style.display = "none"; 
});
function show_hide() {
  var x = document.getElementById("tabel_pertama");
  var y = document.getElementById("tabel_kedua");
  if (x.style.display === "none") {
    x.style.display = "table";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "table";
  }
} 
</script>
</body>
</html>