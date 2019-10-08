<?php

include "../back/conn.php";
$nama = $_GET['nama'];
// $sttgl = '';
$sttgl = date('d-M-Y');
if (isset($_GET['jangka'])) {
    $tgl = $_GET['jangka'];


    if ($tgl == 0) {
        $sttgl = date('Y-m-d');
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama'");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama' order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    } else {
        $sttgl = date('d-M-Y');
        
        // date_default_timezone_get();
        $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " -$tgl day"));
        // $x = date("Y-m-d", strtotime("-$tgl days", $tanggal_now));
        $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama' and tanggal between '$x' and '$tanggal_now'");
        $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama' and tanggal between '$x' and '$tanggal_now' order by tanggal asc LIMIT 1");
        while ($row = mysqli_fetch_array($sttanggal)) {
            $sttgl = $row['tanggal'];
        }
    }
} else {
    $sttgl = date('d-M-Y');
    $tanggal_now = date('Y-m-d');
        $x = date('Y-m-d', strtotime(date("Y-m-d", mktime()) . "-1000000000 day"));
    $datatotal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama'");
    $sttanggal = mysqli_query($con, "select * from data_transaksi where de=2 and subnama_kegiatan='$nama' order by tanggal asc LIMIT 1");
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

        <h2>Detail Kasbon Atas Nama : <?= $nama; ?></h2>
        <h3>Per : <?= DateTime::createFromFormat('Y-m-d', $sttgl)->format('d-M-Y'); ?></h3>
        
        
        <div class="row">
            <div class="col-lg-12">
            <a href="rekap_kasbon.php" class="btn btn-warning">Back</a>
            <a class="btn btn-danger" href="../back/clear_data_kasbon_orang.php?nama=<?= $nama ?>" onclick="return confirm('Hapus Semua Kasbon <?=$nama?>?');">Clear Data</a>

            </div>
            <br>
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
        
        <?php
        $k = 0;
        ?>
<br>
<div class="col-lg-12">
        <div class="row justify-content-center">

            <div class="row" style="width:100%;">
                <div class="table_rekap_keg" style="width:100%;">
                    <div class="card " style="border:0.5px solid grey;border-radius:10px; overflow:hidden;font-size:17px;">
                        <table class="table-hover table-bordered">
                            <tr style="background:#2891DD; color:white">
                        <th class="col-lg-1" style="width:5%;">No</th>
                        <th class="col-lg-1">Tanggal</th>
                        <th class="col-lg-2">Nama</th>
                        <th class="col-lg-2">Keterangan</th>
                        <th class="col-lg-2">Pinjam</th>
                        <th class="col-lg-2">Kembali</th>
                        <th class="col-lg-2">Kas Bon</th>
                    </tr>
                    <tbody>
                        <?php
                        $i = 1;
                        $saldo_berjalan = 0;
                        foreach ($datatotal as $row) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row["tanggal"]; ?></td>
                                <td><?php echo $row["subnama_kegiatan"]; ?></td>
                                <?php
                                    if ($row['ko'] == 'K') {
                                        ?><td>Pinjam</td><?php
                                        } else {
                                            ?><td>Kembali</td><?php
                                        }
                                        ?>
                                <td><?php echo rupiah($row["kredit"]); ?></td>
                                <td><?php echo rupiah($row["debet"]); ?></td>
                                <?php

                                    $kred = $row['kredit'];
                                    $debt = $row['debet'];
                                    $k = $k + $kred - $debt;

                                    ?>
                                <td><?= rupiah($k); ?></td>
                                
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div></div></div></div>
    <script>
        function gantitanggal(waktu) {
            window.location.href = "../admin/rekap_kasbon_detail.php?nama=<?=$nama?>&jangka=" + waktu ;
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