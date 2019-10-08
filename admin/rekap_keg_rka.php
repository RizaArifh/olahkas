<?php

include "../back/conn.php";

$sttgl = date('Y-m-d');
if (isset($_GET['jangka'])) {
    $tgl = $_GET['jangka'];


    if ($tgl == 0) {
        $sttgl = date('Y-m-d');
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=1 and ko='D' group by subnama_kegiatan order by id");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=1 order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    } else {
        $sttgl = date('Y-m-d');
        // date_default_timezone_get();
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " -$tgl day"));
        // $x = date("Y-m-d", strtotime("-$tgl days", $tanggal_now));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=1 and ko='D' and tanggal between '$x' and '$tanggal_now' group by subnama_kegiatan order by id");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=1 and tanggal between '$x' and '$tanggal_now' order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    }
} else {
    $sttgl = date('Y-m-d');
    $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
    $datatotal = mysqli_query($con, "select * from data_transaksi where de=1 and ko='D' group by subnama_kegiatan order by id");
    $sttanggal = mysqli_query($con, "select * from data_transaksi where de=1 order by tanggal asc LIMIT 1");
    while ($row = mysqli_fetch_array($sttanggal)) {
        $sttgl = $row['tanggal'];
    }
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
        <h3>Per : <?= DateTime::createFromFormat('Y-m-d', $sttgl)->format('d-M-Y'); ?></h3>

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-danger" href="../back/clear_data_keg.php" onclick="return confirm('Hapus Semua Data Kegiatan RKA?');">Clear Data</a>

            </div>
            <br><br>
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

                                <th class="col-lg-2">Nama</th>
                                <th class="col-lg-2">Debet</th>
                                <th class="col-lg-2">Kredit</th>
                                <th class="col-lg-2">Saldo</th>
                                <th class="col-lg-2">Detail</th>

                            </tr>
                            <tbody>
                                <?php $i = 1;
                                $saldo_rekap = 0;
                                $saldo_berjalan = 0; ?>
                                <?php foreach ($datatotal as $row) : ?>
                                    <tr>
                                        <td class="col-lg-4"><?php echo $row["subnama_kegiatan"]; ?></td>

                                        <?php
                                            $kred = 0;
                                            $debt = 0;
                                            $p = 1;
                                            $sub = $row["subnama_kegiatan"];
                                            $data_kegiatan = mysqli_query($con, "SElECT * FROM data_transaksi where subnama_kegiatan='$sub' and de=1 and tanggal between '$x' and '$tanggal_now'");
                                            $data_kegiatank = mysqli_query($con, "SElECT * FROM data_transaksi where nama_kegiatan_keterangan='$sub' and de=1 and tanggal between '$x' and '$tanggal_now'");
                                            while ($row2 = mysqli_fetch_array($data_kegiatan)) {    
                                                $p++;
                                                $debt = $debt + $row2['debet'];
                                            }
                                            while ($row2 = mysqli_fetch_array($data_kegiatank)) {
                                                $kred = $kred + $row2['kredit'];
                                        
                                            }

                                            $saldo = $debt - $kred;
                                            ?>
                                        <td class="col-lg-2"><?php echo rupiah($debt); ?></td>
                                        <td class="col-lg-2"><?php echo rupiah($kred); ?></td>
                                        <td class="col-lg-2"><?php echo rupiah($saldo); ?></td>
                                        
                                        <td class="col-lg-2"><a class="btn btn-secondary" href="rekap_keg_rka_detail.php?nama=<?php echo $row['subnama_kegiatan'];?>">Detail</a></td>

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
            window.location.href = "../admin/rekap_keg_rka2.php?jangka=" + waktu;
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