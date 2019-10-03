<?php

include "../back/conn.php";
$datatotal = mysqli_query($con, "SElECT * FROM data_transaksi order by id");
$datatotal = mysqli_query($con, "SElECT * FROM data_transaksi where de not in ('4') order by id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php include "../element/boots.php" ?>

  <style>

  </style>

  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <?php

    include "../element/_nav.php"
    ?>
    <a class="btn btn-danger" href="../back/clear_data.php">Clear Data</a><br><br>
    <!-- <div style="max-height:100px;overflow:hidden;overflow-y:auto">     -->

    <div class="row">
      <div class="col-lg-12">

        <div style="border:0.2px solid grey;border-radius:10px; overflow:hidden;">
          <table class="table">
            <thead>
              <tr>
                <th class="col-lg-1">No.</th>
                <th class="col-lg-1">Aksi</th>
                <th class="col-lg-1">Tanggal</th>
                <th class="col-lg-1">Kode</th>
                <th class="col-lg-2">Nama / Kegiatan / Keterangan</th>
                <th class="col-lg-2">Sub Nama Kegiatan</th>
                <th class="col-lg-1">Debet</th>
                <th class="col-lg-1">Kredit</th>
                <th class="col-lg-1">Saldo</th>
                <th class="col-lg-2">Keterangan</th>
              </tr>
            </thead>
          </table>
          <div class="tbod datas">
            <table class="table-fixed table">
              <thead hidden>
                <tr>
                  <th class="col-lg-1">No.</th>
                  <th class="col-lg-1">Aksi</th>
                  <th class="col-lg-1">Tanggal</th>
                  <th class="col-lg-1">Kode</th>
                  <th class="col-lg-2">Nama / Kegiatan / Keterangan</th>
                  <th class="col-lg-2">Sub Nama Kegiatan</th>
                  <th class="col-lg-1">Debet</th>
                  <th class="col-lg-1">Kredit</th>
                  <th class="col-lg-1">Saldo</th>
                  <th class="col-lg-2">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                $saldo = 0; ?>
                <?php foreach ($datatotal as $row) : ?>
                  <tr>
                    <td class="col-lg-1"><?php echo $i; ?></td>
                    <td class="col-lg-1">
                      <a id="a" href="../back/hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm ('yakin tak?');">hapus</a>
                    </td>
                    <td class="col-lg-1"><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-m-Y'); ?></td>
                    <td class="col-lg-1"><?php echo $row["ko"]; ?>.0<?php echo $row["de"]; ?></td>
                    <td class="col-lg-2"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                    <td class="col-lg-2"><?php echo $row["subnama_kegiatan"]; ?></td>
                    <td class="col-lg-1"><?php echo $row["debet"]; ?></td>
                    <td class="col-lg-1"><?php echo $row["kredit"]; ?></td>
                    <?php
                      $saldo = $saldo + $row['debet'] - $row['kredit'];
                      ?>
                    <td class="col-lg-1"><?php echo $saldo; ?></td>
                    <td class="col-lg-1"><?php echo $row["keterangan"]; ?></td>

                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
                <!-- </div> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('#ss').tableExport();
  </script>
  </div>
</body>

</html>