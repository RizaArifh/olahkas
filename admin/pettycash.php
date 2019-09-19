<?php
include "../back/conn.php";
$databon = mysqli_query($con, "SELECT * FROM orang_kasbon");

    $sqlsm = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan='Kasbon Masuk'";
    $datasm = mysqli_query($con,$sqlsm);
    $sqlsk = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan='Kasbon Keluar'";
    $datask = mysqli_query($con,$sqlsk);
      
      $jumlah=0;
      while ($row = mysqli_fetch_array($datasm)) {
        $jumlah=$jumlah+$row['debet'];
      }
      $jumlahk=0;
      while ($row = mysqli_fetch_array($datask)) {
        $jumlahk=$jumlahk+$row['kredit'];
        
      }
      $jumlahsaldos=($jumlah-$jumlahk);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php include "../element/boots.php" ?>

    <title>Sertifikasi</title>
</head>

<body>
    <div class="container-fluid">
    <?php
    include "../element/_nav.php"
    ?>
    <div class="row">
        <div class="col-md-4">
        <h1>Masukan Dana PettyCash</h1>
                <form action="../back/insert_jumlah_tersediak.php" method="post" autocomplete="off" class="form-horizontal">
                <div class="row">
                    <div class="col-md-4">
                    <label  for="tanggal" class="control-label">Tanggal</label>
                    </div>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="tanggal" value="<?php echo date('d-m-Y'); ?>"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <label for=""class="control-label">Dana Dimasukan</label>
                    </div>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="jumlah_tersedia"><br>
                    </div></div>
                    <div class="row">
                    <div class="col-md-4">
                    <label for=""class="control-label">Keterangan     </label>
                    </div>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="keterangan"><br>
                    </div></div>
                    <div style="float:right">
                    <input type="submit"  class="btn btn-primary" value="Masukan">
                    </div>
                </form>
        </div>
        <div class="col-md-3">
        
        <?php $i = 1; ?>
            <a href="../back/clear_orang.php">Clear Kegiatan</a>
                
            <table class="table1" border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <th>No.</th>
                    <th>Nama Kegiatan</th>
                    <th>aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($databon as $row) : ?>
                <tr>
                    <?php if($i<10){?>
                    <td>0<?php echo $row["no_orang"]; ?></td>    
                    <?php
                    }else{?>
                    <td><?php echo $row["no_orang"]; ?></td>    
                        <?php
                    }
                    ?>
                    
                    

                    <td><?php echo $row["nama_orang"]; ?></td>
                    <td><a href="../back/delete_orang.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                </tr>
                <?php $i++; ?>

                <?php endforeach;
                
                // print_r($last_keg);
                ?>

            </table>
            
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
                <label for="No / Nama Kegiatan">Kegiatan / (No Bukti) : </label>
                </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                <select name="no_kegiatan" class="form-control" id="no_kegiatand" onChange="GetNo_kegiatand(this.value)" required>
                    <option value="">Pilih</option>
                    <?php
                    $list_no_keg = "SELECT * FROM orang_kasbon";
                    $data = mysqli_query($con, $list_no_keg);
                    while ($no_keg = mysqli_fetch_array($data)) { 
                    if($no_keg['no_orang']<10){
                        
                    ?>
                    <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_orang']; ?> </option>
                    <?php
                    }else{?>
                        <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_orang']; ?> </option>
                    }
                    <?php };
                    };

                    print_r($data);
                    ?>
                </select></div><div class="col-md-8">
                <input type="text" class="form-control" name="nama_keg" id="nama_kegiatand"readonly> <br>
                </div></div>
                </div></div>
                <?php include "../back/get_jml_sisa.php";?>
                <div class="row">
                    <div class="col-md-4">
                <label for="">Jml Dana Yang Tersedia :</label>
                </div>
                    <div class="col-md-8">
                <input type="text" class="form-control" name="harus_bayar" id="harus_bayar" value="<?=$tersisa?>"readonly> <br>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                <label for="">Jumlah :</label>
                </div>
                    <div class="col-md-8">
                <input type="text" class="form-control" name="dibayar" id="dibayar" onChange="updatekurang(this.value)" placeholder=""> <br>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                <label for="">Sisa:</label>
                </div>
                    <div class="col-md-8">
                <input type="text" class="form-control" name="kurang" id="kurang" placeholder="-"readonly> <br>
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
        function GetNo_kegiatand(id) {
            if (id.length == 0) {
                $('#nama_kegiatand').val('Pilih No Kegiatan');
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var myArr = JSON.parse(this.responseText);
                        console.log(myArr);
                        // removeOptions(document.getElementById("no_kegiatan"));
                        set_nama_kegiatand(myArr);
                    }
                };
                xmlhttp.open("GET", "../back/GetNo_orang.php?id=" + id, true);
                xmlhttp.send();
            };
        };

        function set_nama_kegiatand(data) {
            // debugger;   
            // for (var i = 0; i < data.length; i++) {
            // $('#no_kegiatan').append(
            $('#nama_kegiatand').val(data[0].nama);
            
            $('#sudah_bayar').val(data[2].jumlahk)
            // );
            // }
        }

        

        function updatekurang(dibayar) {
            var hrs_bayar = $("#harus_bayar").val();
            // var sdh_bayar = $("#sudah_bayar").val();
            var kurang = (hrs_bayar-dibayar);
            if (kurang <= 0) {
                kurang = (kurang * -1);
            }
            $("#kurang").val(kurang);
        };

        function updatesaldo(kredit) {
            var jumlahada = $("#jmlad").val();
            
            var saldo = (jumlahada - kredit);
            if (saldo <= 0) {
                saldo = (saldo * -1);
            }
            $("#saldo").val(saldo);
        };
    
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
</body>

</html>