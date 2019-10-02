<?php


$id = intval($_GET['id']);


$d_petty = mysqli_query($con,"SElECT * FROM data_transaksi where de=3 and keterangan='$id' order by id");
?>
<table class="table-hover table-bordered">
                        <tr style="background:#2891DD; color:white">
                            <th class="col-1" rowspan="2">NO.</th>
                            <th style="width:15%" rowspan="2">NAMA PENERIMA</th>
                            <th class="col-3" rowspan="2">URAIAN BELANJA</th>
                            <th class="col-3" colspan="2">BUKTI</th>
                            <th class="col-1" rowspan="2">JUMLAH</th>
                            <th class="col-2" rowspan="2">DANA BERJALAN</th>
                            <th class="col-1" rowspan="2">AKSI</th>
                        </tr>
                        <tr style="background:#2891DD; color:white">
                            <th style="width:14%;">TANGGAL</th>
                            <th class="col-1">NO</th>
                        </tr>
                        </thead class="">
                        <tbody>
                            <?php $i = 1;
                            $tot = 0;

                            if ($num > 0) { // user ditemukan

                                $sis = 25000000;
                                foreach ($d_petty as $row) { ?>
                                    <tr>
                                        <?php if ($i < 10) { ?>
                                            <td class="col-1">0<?php echo $i; ?></td>
                                        <?php
                                                } else { ?>
                                            <td class="col-1"><?php echo $i; ?></td>
                                        <?php
                                                }
                                                ?>
                                        <td class="col-1"><?php echo $row["subnama_kegiatan"]; ?></td>
                                        <td class="col-1"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                                        <td class="col-1"><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-M-Y'); ?></td>
                                        <td class="col-1"><?php echo $i ?></td>
                                        <td class="col-2"><?php echo rupiah($row["kredit"]); ?></td>
                                        <?php $sis = $sis - $row["kredit"]; ?>
                                        <?php $tot = $tot + $row["kredit"]; ?>
                                        <td class="col-2"><?php echo rupiah($sis) ?></td>
                                        <td class="col-1"><a href="../back/delete_kegiatan_petty_lap.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                                    </tr>
                                    <?php $i++; ?>

                                <?php };
                                } else { ?>
                                <tr>
                                    <td class="col-1">Data kosong</td>
                                    <td style="col-1">Data kosong</td>
                                    <td class="col-1">Data kosong</td>
                                    <td class="col-1">Data kosong</td>
                                    <td class="col-1">Data kosong</td>
                                    <td class="col-2">Data kosong</td>
                                    <td class="col-2">Data kosong</td>
                                    <td class="col-1"></a>Data kosong</td>
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

?>