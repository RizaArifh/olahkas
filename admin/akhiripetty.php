<?php
include "../back/conn.php";
include "../back/get_jml_sisa.php";
$datacek = mysqli_query(
  $con,
  "SELECT * FROM data_transaksi WHERE de='3' and keterangan='$last'"
);
$num = mysqli_num_rows($datacek);

$datap = mysqli_query($con, "SELECT * FROM data_transaksi where de='3' and keterangan='$last'");
$datap2 = mysqli_query($con, "SELECT * FROM data_transaksi where de='3' ORDER BY id DESC LIMIT '1';");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include "../element/boots.php" ?>
  <title>PettyCash</title>
  <style>
    th {
      text-align: center;
    }

    th,
    td {
      padding: 3px 3px;
    }
  </style>

</head>

<body>
  <div class="container-fluid">
    <?php
    include "../element/_nav.php"

    ?>
    <h2>AKHIRI PETTY KE : <?= $last ?></h2>
    <h2>Per : <?php if ($num == 0) {
                echo 'Data Masih Kosong';
              } else {
                echo DateTime::createFromFormat('Y-m-d', $st)->format('d M Y');
              } ?></h2>
    <?php $i = 1; ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-6" style="margin-left:-2%">
          <div class="col-lg-4">
            <a href="../back/clear_petty.php" class="btn btn-danger">Clear Kegiatan Petty</a>
          </div>
          <div class="col-lg-4">
            <a href="../export/laporan_petty.php" class="btn btn-success">Export Laporan Petty</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div style="float:right;margin-right:-8.5%;">
            <form action="../back/akhir_petty.php" method="post">
              <input type="text" name="sisa" id="sisapetty" value="" hidden>
              <input type="text" name="tgl_akhir" id="tgl_akhir" value="<?php echo date('Y-m-d'); ?>" hidden>
              <input type="text" name="sesi_petty" value="<?= $last ?>" hidden>
              <div class="col-lg-4">
                <input type="submit" value="Akhiri Petty Sekarang" id="akh" class="btn btn-warning">
              </div>
            </form>
          </div>
          <div style="float:right">
            <div class="col-lg-12">
              <select name="no_petty" id="petty" class="form-control" onChange="updatedata(this.value)" required>
                <option>Lihat Petty Lain</option>
                <?php
                while ($no = mysqli_fetch_array($listpetty)) {
                  if ($no['keterangan'] < 10) {
                    ?>
                    <option value="<?= $no['keterangan'] ?>">0<?= $no['keterangan']; ?> </option>
                  <?php
                    } else { ?>
                    <option value="<?= $no['keterangan'] ?>"><?= $no['keterangan']; ?> </option>
                <?php
                  };
                };

                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="row justify-content-center">
      <div class="row" style="width:98%;">
        <div class="table_rekap_keg" style="width:100%;">
          <div class="card " style="border:0.2px solid white;border-radius:10px; overflow:hidden;font-size:17px;">
            <table class="table-hover table-bordered">
              <tr style="background:#2891DD; color:white">
                <th class="col-lg-1" rowspan="2">NO.</th>
                <th class="col-lg-1" style="width:13%" rowspan="2">NAMA PENERIMA</th>
                <th class="col-lg-2" rowspan="2">URAIAN BELANJA</th>
                <th class="col-lg-3" colspan="2">BUKTI</th>
                <th class="col-lg-2" rowspan="2">JUMLAH</th>
                <th class="col-lg-2" rowspan="2">DANA BERJALAN</th>
                <th class="col-lg-1" rowspan="2">AKSI</th>
              </tr>
              <tr style="background:#2891DD; color:white">
                <th style="width:10%;">TANGGAL</th>
                <th class="col-lg-1">NO</th>
              </tr>
              </thead class="">
              <tbody>
                <?php $i = 1;
                $tot = 0;

                if ($num > 0) { // user ditemukan

                  $sis = 25000000;
                  foreach ($datap as $row) { ?>
                    <tr>
                      <?php if ($i < 10) { ?>
                        <td class="col-lg-1">0<?php echo $i; ?></td>
                      <?php
                          } else { ?>
                        <td class="col-lg-1"><?php echo $i; ?></td>
                      <?php
                          }
                          ?>
                      <td class="col-lg-1"><?php echo $row["subnama_kegiatan"]; ?></td>
                      <td class="col-lg-1"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                      <td class="col-lg-1"><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-M-Y'); ?></td>
                      <td class="col-lg-1"><?php echo $i ?></td>
                      <td class="col-lg-2"><?php echo rupiah($row["kredit"]); ?></td>
                      <?php $sis = $sis - $row["kredit"]; ?>
                      <?php $tot = $tot + $row["kredit"]; ?>
                      <td class="col-lg-2"><?php echo rupiah($sis) ?></td>
                      <td class="col-lg-1"><a href="../back/delete_kegiatan_petty_lap.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                    </tr>
                    <?php $i++; ?>

                  <?php };
                  } else { ?>
                  <tr>
                    <td class="col-1-lg">Data kosong</td>
                    <td style="col-1-lg">Data kosong</td>
                    <td class="col-1-lg">Data kosong</td>
                    <td class="col-1-lg">Data kosong</td>
                    <td class="col-1-lg">Data kosong</td>
                    <td class="col-2-lg">Data kosong</td>
                    <td class="col-2-lg">Data kosong</td>
                    <td class="col-1-lg"></a>Data kosong</td>
                  </tr>
                <?php
                } ?>

              </tbody>
              <tfoot>
                <tr class="bg-info" style="color:white">
                  <th colspan="5">Jumlah Belanja Keseluruhan </th>

                  <th><?php if ($num > 0) {
                        echo rupiah($tot);
                      } else {
                        echo 'RP 25.000.000,00';
                      } ?></th>
                  <th colspan="2" style="text-align:left;padding-left:1.75%;"><?php if ($num > 0) {
                                                                                echo rupiah($sis);
                                                                              } else {
                                                                                echo 'RP 25.000.000,00';
                                                                              } ?></th>

                </tr>
              </tfoot>

            </table>
          </div>
          <?php
          function rupiah($angka)
          {

            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
          }
          ?>
          <?php
          if ($tersisa == 0) {
            ?>
            <script>
              document.getElementById("akh").disabled = true;
            </script>
          <?php

          } else {
            ?>
            <script>
              document.getElementById("akh").disabled = false;
            </script>
          <?php
          }
          ?>
          <script>
            $(document).ready(function() {
              $('#sisapetty').val(<?= $sis ?>);
            });
          </script>
          <script>
            function updatedata(ids) {
              window.location.href = "../admin/semua_petty.php?ids=" + ids;
            }
          </script>
</body>

</html>