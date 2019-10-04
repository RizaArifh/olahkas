<?php

include "../back/conn.php";

$sttgl = '';
if (isset($_GET['jangka'])) {
    $tgl = $_GET['jangka'];


    if ($tgl == 0) {
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 group by subnama_kegiatan order by id");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    } else {
        // date_default_timezone_get();
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " -$tgl day"));
        // $x = date("Y-m-d", strtotime("-$tgl days", $tanggal_now));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 and tanggal between '$x' and '$tanggal_now' group by subnama_kegiatan order by id");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 and tanggal between '$x' and '$tanggal_now' order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    }
} else {
    $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
    $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 group by subnama_kegiatan order by id");
    $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 order by tanggal asc LIMIT 1");
    while ($row = mysqli_fetch_array($sttanggal)) {
        $sttgl = $row['tanggal'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "../element/boots.php" ?>
    <title>Rekapitulasi Kegiatan RKA</title>
    <style>th{text-align:center}</style>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "../element/_nav.php"
        ?>
        <h2>REKAPITULASI KASBON</h2>
        <h3>Per : <?= DateTime::createFromFormat('Y-m-d', $sttgl)->format('d-M-Y'); ?></h3>

        
        <div class="row">
            <div class="col-lg-12">
            <a href="../back/clear_data_kasbon.php" class="btn btn-danger">Clear Data</a>

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
        <br>
        <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="row" style="width:98%;">
                <div class="table_rekap_keg" style="width:100%;">
                    <div class="card " style="border:0.5px solid grey;border-radius:10px; overflow:hidden;font-size:17px;">
                        <table class="table-hover table-bordered">
                            <tr style="background:#2891DD; color:white">
                        
                        <th>Nama</th>
                        <th>Pinjam</th>
                        <th>Kembali</th>
                        <th>Kas Bon</th>
                        <th>Saldo Berjalan</th>
                        <th>Detail</th>
                    </tr>
                    <tbody>
                        <?php
                        $i = 1;
                        $saldo_berjalan = 0;
                        foreach ($datatotal as $row) { ?>
                            <tr>
                                
                                <td><?php echo $row["subnama_kegiatan"]; ?></td>

                                <?php
                                    $kred = 0;
                                    $debt = 0;
                                    $p = 1;
                                    $sub = $row["subnama_kegiatan"];
                                    $data_kasbon = mysqli_query($con, "SElECT * FROM data_transaksi where subnama_kegiatan='$sub' and de=2 and tanggal between '$x' and '$tanggal_now'");
                                    while ($row2 = mysqli_fetch_array($data_kasbon)) {
                                        $kred = $kred + $row2['kredit'];
                                        $p++;
                                        $debt = $debt + $row2['debet'];
                                    }

                                    $saldo = $kred - $debt;
                                    ?>
                                <td><?php echo rupiah($kred); ?></td>
                                <td><?php echo rupiah($debt); ?></td>
                                <td><?php echo rupiah($saldo) ?></td>
                                <?php
                                    $saldo_berjalan = $saldo_berjalan + $saldo;
                                    ?>
                                <td><?php echo rupiah($saldo_berjalan); ?>
                                </td>
                                <td><a href="rekap_kasbon_detail.php?nama=<?php echo $row['subnama_kegiatan']; ?>">Detail</a></td>
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div></div></div>
        <script>
        function gantitanggal(waktu) {
            window.location.href = "../admin/rekap_kasbon.php?jangka=" + waktu;
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