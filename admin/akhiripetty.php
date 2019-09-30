<?php
include "../back/conn.php";
include "../back/get_jml_sisa.php";
$datap = mysqli_query($con, "SELECT * FROM data_transaksi where de='3'");
$datap2 = mysqli_query($con, "SELECT * FROM data_transaksi where de='3' ORDER BY id DESC LIMIT '1';");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "../element/boots.php"?>
    <title>Rekapitulasi Kegiatan RKA</title>
    <style>th{
    text-align: center;}</style>
    
</head>
<body>
    <div class="container-fluid">
<?php
    include "../element/_nav.php"
    ?>
    <h2>AKHIRI PETTY</h2>
    
    <?php $i = 1; ?>
                <a href="../back/clear_orang.php" class="btn btn-danger">Clear Kegiatan</a>
                <a href="../back/akhiripetty.php" class="btn btn-warning">Akhiri Petty Sekarang</a><br><br>
                
<div class="row justify-content-center">

<div class="table_rekap_keg"style="width:70%;" >
<table class=" table table-hover" style="height:40%;">
                            <tr  style="background:#2891DD; color:white">
                                <th class="col-1">NO.</th>
                                <th class="col-1">Tanggal</th>
                                <th class="col-2">NAMA KEGIATAN</th>
                                <th class="col-2">NAMA PENERIMA</th>
                                <th class="col-3">DANA</th>
                                <th class="col-2">AKSI</th>
                            </tr>
                        </thead class="">
                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($datap as $row) : ?>
                                        <tr>
                                            <?php if ($i < 10) { ?>
                                                <td class="col-1">0<?php echo $i; ?></td>
                                            <?php
                                                } else { ?>
                                                <td class="col-1"><?php echo $i; ?></td>
                                            <?php
                                                }
                                                ?>
                                            <td class="col-1"><?php echo $row["tanggal"]; ?></td>
                                            <td class="col-2"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                                            <td class="col-2"><?php echo $row["subnama_kegiatan"]; ?></td>
                                            <td class="col-3"><?php echo $row["kredit"]; ?></td>
                                            <td class="col-3"><a href="../back/delete_kegiatan_petty.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                                        </tr>
                                        <?php $i++; ?>

                                    <?php endforeach;

                                    // print_r($last_keg);
                                    ?>
                                </tbody>
                                <tfoot>
    <tr>
      <th>Sum</th>

      <th><?=$tersisa?></th>
    </tr>
  </tfoot>
                                
    </table>
    </div></div>
                        
    </div>
</body>
</html>