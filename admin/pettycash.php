<?php
include "../back/conn.php";
$datap = mysqli_query($con, "SELECT * FROM data_transaksi where de='3'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php include "../element/boots.php" ?>

    <title>Sertifikasi</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "../element/_nav.php"
        ?>
        <div class="row">
            <div class="col-md-3">
                <h1>Masukan Dana PettyCash</h1>
                <form action="../back/insert_jumlah_tersediak.php" method="post" autocomplete="off" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal" class="control-label">Tanggal</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="tanggal" value="<?php echo date('d-m-Y'); ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Dana Dimasukan</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="jumlah_tersedia" value="25000000" readonly><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Keterangan </label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="keterangan"><br>
                        </div>
                    </div>
                    <div style="float:right">
                        <input type="submit" class="btn btn-primary" value="Masukan">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <!-- <button id="export" onclick="export()"></button> -->
                
                <?php $i = 1; ?>
                <a href="../back/clear_orang.php" class="btn btn-danger">Clear Kegiatan</a>
                <a href="../admin/akhiripetty.php" class="btn btn-warning">Akhiri Petty Sekarang</a><br><br>
                
                <div style="border:0.2px solid grey;border-radius:10px; overflow:hidden;">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">NO.</th>
                                <th class="col-4">NAMA KEGIATAN</th>
                                <th class="col-3">DANA</th>
                                <th class="col-3">AKSI</th>
                            </tr>
                        </thead class="">
                    </table>
                    <div class="tbod">
                        <div id="he" style="">
                            <table class="table" id="ss">
                                <tbody class="">
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
                                            <td class="col-4"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                                            <td class="col-3"><?php echo $row["kredit"]; ?></td>
                                            <td class="col-3"><a href="../back/delete_kegiatan_petty.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                                        </tr>
                                        <?php $i++; ?>

                                    <?php endforeach;

                                    // print_r($last_keg);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-md-4">

                <h1>KREDIT</h1>
                <form action="../back/insert_petty.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal">Tanggal :</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="tanggal" value="<?php echo date('d-m-Y'); ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="No / Nama Kegiatan"> Nama Kegiatan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_keg" id="nama_kegiatand"> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Nama Penerima">Nama Penerima </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"> <br>
                        </div>
                    </div>

                    <?php include "../back/get_jml_sisa.php"; ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Jml Dana Yang Tersedia</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="harus_bayar" id="dana" value="<?=$tersisa ?>" readonly> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Jumlah :</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="jumlah" id="jumlah" onChange="updatekurang(this.value)" placeholder=""> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Sisa:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="kurang" id="kurang" placeholder="-" readonly> <br>
                        </div>
                    </div>
                    <div style="float:right">
                        <input type="submit" class="btn btn-primary" value="Masukan Data">
                    </div>
                </form>

            </div>
        </div>

        <!-- <script src="../js/jquery.js"></script> -->
        
                   
                
        <script>
            

          
            function updatekurang(keluar) {
                var dana = $("#dana").val();
                var kurang = (dana - keluar);
                if (kurang < 0) {
                    Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Jumlah Tidak Boleh Melebihi Dana Yang Tersedia',
        })
                    $("#jumlah").val('0');
                    $("#kurang").val('0');
                } else {
                    $("#kurang").val(kurang);
                }
            };

            function updatesaldo(kredit) {
                var jumlahada = $("#jmlad").val();

                var saldo = (jumlahada - kredit);
                if (saldo <= 0) {
                    saldo = (saldo * -1);
                }
                $("#saldo").val(saldo);
            };

        </script>
</body>

</html>