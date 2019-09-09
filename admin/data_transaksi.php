<?php

include "../back/conn.php";
 $datatotal = mysqli_query($con,"SElECT * FROM data_transaksi order by id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
    table{
        /* display:flex; */
        /* flex-flow: column; */
        /* width:100%; */
    }
    
    </style>
    <title>Document</title>
</head>
<body>
<?php
    include "../element/_nav.php"
    ?>
    <a href="../back/clear_data.php">Clear Data</a>
    <!-- <div style="max-height:100px;overflow:hidden;overflow-y:auto">     -->
<div class="col-lg-9">
<table class="table1" border="1" align=center cellpadding="10" cellspacing="0">
<thead>
<tr>
    <th >No.</th>
    <th class="col">Aksi</th>
    <th class="col">Tanggal</th>
    <th class="col">Kode</th>
    <th class="col">Nama / Kegiatan / Keterangan</th>
    <th class="col">Sub Nama Kegiatan</th>
    <th class="col">Debet</th>
    <th class="col">Kredit</th>
    <th class="col">Saldo</th>
    <th class="col">Keterangan</th>
</tr>
</thead>
<?php $i = 1; ?>
<?php foreach ( $datatotal as $row ) : ?>
<tr>
    <td><?php echo $i; ?></td>
    <td>
        <a href="ubah.php?id=<?php echo $row ["id"]; ?>">ubah</a> |
        <a href="hapus.php?id=<?php echo $row ["id"]; ?>"onclick="return confirm ('yakin tak?');">hapus</a>
    </td>
    <td><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-m-Y');?></td>
    <td><?php echo $row["ko"]; ?>.0<?php echo $row["de"]; ?></td>
    <td><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
    <td><?php echo $row["subnama_kegiatan"]; ?></td>
    <td><?php echo $row["debet"]; ?></td>
    <td><?php echo $row["kredit"]; ?></td>
    <td><?php echo $row["saldo"]; ?></td>
    <td><?php echo $row["keterangan"]; ?></td>
    
</tr>
<?php $i++; ?>
<?php endforeach; ?>
<!-- </div> -->
</table>
</div>
</body>
</html>