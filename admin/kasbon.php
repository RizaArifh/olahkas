<?php
include "../back/conn.php";
$databon = mysqli_query($con, "SELECT * FROM orang_kasbon");
$databon2 = mysqli_query($con, "SELECT * FROM orang_kasbon");

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
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <?php include "../element/boots.php";?>
    
    <title>Kasbon</title>
</head>

<body>
    <?php
    include "../element/_nav.php"
    ?>
    <div class="row">
        <div class="col-md-4">
            
            <h1>KREDIT</h1>
        <form action="../back/insert_kasbon_k.php" method="post">
            
        <label for="">Tanggal :</label>
        <input type="text" name="tgl" value="<?php echo date('d-m-Y'); ?>">
                <input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" hidden><br>
            
            <label for="">No / Nama :</label>
            <select name="no_kegiatan" id="no_orangk" onChange="GetNo_kegiatank(this.value)" required>
                <option value="">Pilih</option>
                <?php
                $list_no_keg = "SELECT * FROM orang_kasbon";
                $data = mysqli_query($con, $list_no_keg);
                while ($no_keg = mysqli_fetch_array($databon2)) {
                    if($no_keg['no_orang']<10){
                        
                    ?>
                    <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_orang']; ?> </option>
                    <?php
                    }else{?>
                    <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_orang']; ?> </option>
                    }
                    <?php };?>
                
                <?php };
                print_r($data);
                ?>
            </select>
            <input type="text" name="nama_orang" id="nama_orangk"> <br>

            <label for="">Jml Dana Yang Tersedia :</label>
            <input type="text" name="dana_ada" id="jmlad" placeholder="-" value="<?=$jumlahsaldos?>"<br>
            
            <!-- <label for="">Jml Kas Bon :</label>
            <input type="text" name="harus_bayar" id="jmlkasbon" placeholder="-" value="0"> <br> -->

            <label for="">Jml Kas Bon Sekarang :</label>
            <input type="text" name="kasbon" id="jmlk" placeholder="" onchange="updatesaldo(this.value)" > <br>

            <input type="submit" value="Masukan Data">

        </form>
        </div>
        <div class="col-md-4">
        
        <?php $i = 1; ?>
        <h2>Tambah Orang</h2>
            <form action="../back/tambah_orang.php" method="post">
                <label for="">Nama : </label>
                <input type="text" name="in_nama"><br>
                <input type="submit" value="Tambahkan">
            </form>
            <a href="../back/clear_orang.php">clear orang</a>
                
            <table class="table1" border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kasbon</th>
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
                    <?php
                    $namak= $row["nama_orang"];
                    $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
                    $data2 = mysqli_query($con,$sql2);
                    
                    $jumlah=0;
                    $jumlahk=0;
                    $kasbonn=0;
                    while ($row = mysqli_fetch_array($data2)) {
                      $jumlahk=$jumlahk+$row['kredit'];
                      $jumlah=$jumlah+$row['debet'];
                      $kasbonn=$jumlahk-$jumlah;
                      if($kasbonn==0){
                        $jumlahk=0;
                        $jumlah=0;
                      }
                    }
                    ?>
                    <td><?=$kasbonn?></td>
                    <td><a href="../back/delete_orang.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                </tr>
                <?php $i++; ?>

                <?php endforeach;
                
                // print_r($last_keg);
                ?>

            </table>
            
        </div>
    
    
<div class="col-md-4">
<h1>DEBET</h1>
            <form action="../back/insert_kasbon.php" method="post">
                <label for="tanggal">Tanggal :</label>
                <input type="text" name="tgl" value="<?php echo date('d-m-Y'); ?>">
                <input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" hidden><br>
                <label for="No / Nama Kegiatan">No / Nama : </label>
                <select name="no_kegiatan" id="no_orang" onChange="GetNo_kegiatand(this.value)" required>
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
                </select>
                <input type="text" name="nama_orang" id="nama_orangd"> <br>
                <label for="">Jml Yang Harus Di Bayar :</label>
                <input type="text" name="harus_bayar" id="harus_bayar" placeholder="-" value="0"> <br>

                <label for="">Jml Sudah Di Bayar :</label>
                <input type="text" name="sudah_bayar" id="sudah_bayar" placeholder="-"> <br>

                <label for="">Jml DiBayar Sekarang :</label>
                <input type="text" name="dibayar" id="dibayar" onChange="updatekurang2(this.value)" placeholder=""> <br>

                <label for="">Kurang Di Setor:</label>
                <input type="text" name="kurang" id="kurang" placeholder="-"> <br>

                <input type="submit" value="Masukan Data">

            </form>
        </div>
    

    <!-- <script src="../js/jquery.js"></script> -->
    <script>
        function GetNo_kegiatand(id) {
            if (id.length == 0) {
                $('#nama_orangd').val('Pilih No Kegiatan');
                
                $('#harus_bayar').val(0);
                $('#sudah_bayar').val(0);
                $('#kurang').val(0);
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

        function GetNo_kegiatank(id) {
            if (id.length == 0) {
                $('#nama_orangk').val('Pilih No Orang');
               
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var myArr = JSON.parse(this.responseText);
                        console.log(myArr);
                        // removeOptions(document.getElementById("no_kegiatan"));
                        set_nama_kegiatank(myArr);
                    }
                };
                xmlhttp.open("GET", "../back/GetNo_orangk.php?id=" + id, true);
                xmlhttp.send();
            };
        };
        
        function set_nama_kegiatand(data) {
            // debugger;   
            // for (var i = 0; i < data.length; i++) {
            // $('#no_kegiatan').append(
            
            

            
            $("#dibayar").val('');
            $('#nama_orangd').val(data[0].nama);
            $('#harus_bayar').val(data[1].jumlahk);
            $('#sudah_bayar').val(data[2].jumlah)
            var hrs_bayar = $("#harus_bayar").val();
            var sdh_bayar = $("#sudah_bayar").val();
            var kurang = (hrs_bayar-sdh_bayar);
            if (kurang <= 0) {
                kurang = (kurang * -1);
            }
            
            $("#kurang").val(kurang);
            // );
            // }
        }

        function set_nama_kegiatank(data) {
            // debugger;   
            // for (var i = 0; i < data.length; i++) {
            // $('#no_kegiatan').append(
            $('#nama_orangk').val(data[0].nama);
            $('#jmlkasbon').val(data[1].kasbon);
            // $('#sudah_bayar').val(data[2].jumlahk)
            // );
            // }
        }
        

        
        
        function updatekurang2(dibayar) {
            var hrs_bayar = $("#harus_bayar").val();
            var sdh_bayar = $("#sudah_bayar").val();
            var kurang = (hrs_bayar-sdh_bayar-dibayar);
            // if (kurang <= 0) {
            //     kurang = (kurang * -1);
            // }
            if (kurang<0){
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                html: 'Jumlah Yang Di Bayar <br> Tidak Boleh Melebihi Jumlah Yang Harus Di Bayar',
                })
            
                $("#kurang").val(0);
            }else{
            
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