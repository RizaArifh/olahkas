<?php

include "../back/conn.php";


if (isset($_GET['jangka'])) {
    $tgl = $_GET['jangka'];


    if ($tgl == 0) {
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=1");
    } else {
        // date_default_timezone_get();
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " -$tgl day"));
        // $x = date("Y-m-d", strtotime("-$tgl days", $tanggal_now));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=1 and tanggal between '$x' and '$tanggal_now'");
    }
} else {
    $datatotal = mysqli_query($con, "select * from data_transaksi where de=1");
}
// $datatotal = mysqli_query($con, "SElECT * FROM data_transaksi where ");
// $datatotal = mysqli_query($con, "select * from data_transaksi where de=1");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "../element/boots.php" ?>
    <title>Rekapitulasi Kegiatan RKA</title>
    <style>
        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "../element/_nav.php"
        ?>
        <h2>REKAPITULASI KEGIATANN SESUAI RKA</h2>
        <h3>Per : <?= date('d-m-Y'); ?></h3>

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-danger" href="../back/clear_data_keg.php">Clear Data</a>

            </div>
            <div class="col-lg-3">
                <form method="get">
                    <select name="jangka" id="jangkawkt" onchange="gantitanggal(this.value)" class="form-control">
                        <option value="0">Pilih Rentang Waktu</option>
                        <option value="0">Semua</option>
                        <option value="7">7 Hari Sebelumnya</option>
                        <option value="30">30 Hari Sebelumnya</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="row justify-content-center">

            <div class="row" style="width:98%;">
                <div class="table_rekap_keg" style="width:100%;">
                    <div class="card " style="border:0.5px solid grey;border-radius:10px; overflow:hidden;font-size:17px;">
                        <table class="table-hover table-bordered">
                            <tr style="background:#2891DD; color:white">

                            <tr style="background:#2891DD; color:white;">
                                <th>No.</th>
                                <th>Aksi</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Pemasukan</th>
                                <th>Pengluaran</th>
                                <th>Saldo</th>
                                <th>Saldo Berjalan</th>

                            </tr>
                            <tbody>
                                <?php $i = 1;
                                $saldo_rekap = 0;
                                $saldo_berjalan = 0; ?>
                                <?php foreach ($datatotal as $row) : ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            
                                            <a href="hapus.php?id= <?php echo $row["id"]; ?>" onclick="return confirm ('yakin tak?');">hapus</a>
                                        </td>
                                        <td><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-M-Y'); ?></td>
                                        <?php
                                            if ($row['de'] = 'D') { ?>
                                            <td><?php echo $row["subnama_kegiatan"]; ?></td>
                                        <?php
                                            } else { ?>
                                            <td><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                                        <?php
                                            }
                                            ?>
                                        <td><?php echo rupiah($row["debet"]); ?></td>
                                        <td><?php echo rupiah($row["kredit"]); ?></td>
                                        <?php
                                            $saldo_rekap = $saldo_rekap + $row['debet'] - $row['kredit'];
                                            ?>
                                        <td><?php echo rupiah($saldo_rekap); ?></td>
                                        <?php

                                            if ($i == 1) { ?>

                                            <td><?php $saldo_berjalan = $saldo_rekap;
                                                        echo rupiah($saldo_rekap); ?></td>
                                        <?php
                                            } else {
                                                $saldo_berjalan = $saldo_berjalan + $saldo_rekap; ?>
                                            <td><?php echo rupiah($saldo_berjalan); ?></td><?php
                                                                                        }
                                                                                        ?>


                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function gantitanggal(waktu) {
            window.location.href = "../admin/rekap_keg_rka.php?jangka=" + waktu;
        }

        <?php
          function rupiah($angka)
          {

            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
          }
          ?>
    </script>
</body>

</html>