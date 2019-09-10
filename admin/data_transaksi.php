<?php

include "../back/conn.php";
 $datatotal = mysqli_query($con,"SElECT * FROM data_transaksi where de not in ('4') order by id");

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
.table-fixed thead {
  width: 100%;
}
.table-fixed tbody {
  height: 230px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}
.table-fixed tbody td,
.table-fixed thead > tr > th {
    text-align:center;
float: left;
}
.table-fixed tr:after {
content: "";
display: block;
visibility: hidden;
clear: both;
}
.table > thead > tr > th,
.table > thead > tr > td {
font-size: .9em;
font-weight: 400;
border-bottom: 0;
letter-spacing: 1px;
vertical-align: top;
padding: 8px;
background: #51596a;
text-transform: uppercase;
color: #ffffff;
}
th{
    height: 60px;
    text-align: center;
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
<div class="col-lg-10">
<table class="table-fixed table">
<thead>
<tr>
    <th class="col-0.5">No.</th>
    <th class="col-0.5">Aksi</th>
    <th class="col-1">Tanggal</th>
    <th class="col-1">Kode</th>
    <th class="col-2">Nama / Kegiatan / Keterangan</th>
    <th class="col-2">Sub Nama Kegiatan</th>
    <th class="col-1">Debet</th>
    <th class="col-1">Kredit</th>
    <th class="col-1">Saldo</th>
    <th class="col-2">Keterangan</th>
</tr>
</thead>
<tbody>
<?php $i = 1; 
$saldo=0;?>
<?php foreach ( $datatotal as $row ) : ?>
<tr>
    <td class="col-0.5"><?php echo $i; ?></td>
    <td class="col-0.5">
        
        <a href="../back/hapus.php?id=<?php echo $row ["id"]; ?>"onclick="return confirm ('yakin tak?');">hapus</a>
    </td>
    <td class="col-1"><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-m-Y');?></td>
    <td class="col-1"><?php echo $row["ko"]; ?>.0<?php echo $row["de"]; ?></td>
    <td class="col-2"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
    <td class="col-2"><?php echo $row["subnama_kegiatan"]; ?></td>
    <td class="col-1"><?php echo $row["debet"]; ?></td>
    <td class="col-1"><?php echo $row["kredit"]; ?></td>
    <?php 
    $saldo=$saldo+$row['debet']-$row['kredit'];
    ?>
    <td  class="col-1"><?php echo $saldo; ?></td>
    <td  class="col-1.75"><?php echo $row["keterangan"]; ?></td>
    
</tr>
<?php $i++; ?>
<?php endforeach; ?>
<!-- </div> -->
</tbody>
</table>
</div>
<script>

</script>
</body>
</html>