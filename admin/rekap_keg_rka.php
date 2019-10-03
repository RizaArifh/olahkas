<?php

include "../back/conn.php";
$datatotal = mysqli_query($con, "SElECT * FROM data_transaksi where de=1");

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

        <a class="" href="../back/clear_data_keg.php">Clear Data</a>


        <div class="row justify-content-center">

            <div class="table_rekap_keg" style="width:70%;">
                <table class=" table table-hover" style="height:40%;">

                    <tr style="background:#2891DD; color:white;">
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
                        $saldo_rekap = 0;
                        $saldo_berjalan = 0; ?>
                        <?php foreach ($datatotal as $row) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <a href="ubah.php?id=<?php echo $row["id"]; ?>">ubah</a> |
                                    <a href="hapus.php?id= <?php echo $row["id"]; ?>" onclick="return confirm ('yakin tak?');">hapus</a>
                                </td>
                                <?php
                                    if ($row['de'] = 'D') { ?>
                                    <td><?php echo $row["subnama_kegiatan"]; ?></td>
                                <?php
                                    } else { ?>
                                    <td><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                                <?php
                                    }
                                    ?>
                                <td><?php echo $row["debet"]; ?></td>
                                <td><?php echo $row["kredit"]; ?></td>
                                <?php
                                    $saldo_rekap = $saldo_rekap + $row['debet'] - $row['kredit'];
                                    ?>
                                <td><?php echo $saldo_rekap; ?></td>
                                <?php

                                    if ($i == 1) { ?>

                                    <td><?php $saldo_berjalan = $saldo_rekap;
                                                echo $saldo_rekap; ?></td>
                                <?php
                                    } else {
                                        $saldo_berjalan = $saldo_berjalan + $saldo_rekap; ?>
                                    <td><?php echo $saldo_berjalan; ?></td><?php
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
    <script>
    </script>
</body>

</html>