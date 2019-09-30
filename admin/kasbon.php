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
    
    
    <?php include "../element/boots.php";?>
    <style>label{
        padding:5px 3px;
    }
</style>
    <title>Kasbon</title>
</head>

<body>
    <div class="container-fluid">
    <?php
    include "../element/_nav.php"
    ?>
    <div class="row">
        <div class="col-md-4">
            
            <h1>KREDIT</h1>
        <form action="../back/insert_kasbon_k.php" method="post" autocomplete="off">
        <div class="row">
        <div class="col-md-4">
        <label for="">Tanggal</label>
        </div><div class="col-md-8">
        <input type="text" class="form-control" name="tanggal" value="<?php echo date('d-m-Y'); ?>" readonly><br>
        </div></div>
        <div class="row">
        <div class="col-md-4">
            <label for="">No / Nama </label>
            </div>
            <div class="col-md-8">
                <div class="row">
                <div class="col-md-4">
            <select name="no_kegiatan" class="form-control" id="no_orangk" onChange="GetNo_kegiatank(this.value)" required>
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
            </select></div><div class="col-md-8">
            <input type="text" name="nama_orang" id="nama_orangk" class="form-control" readonly>
            </div>
            </div></div></div>
            <?php include "../back/get_jml_sisa.php";?><br>
            <div class="row">
        <div class="col-md-4">
            <label for="">Jml Dana Yang Tersedia</label>
            </div><div class="col-md-8">
            <input type="text" name="dana_ada" id="jmlad" class="form-control" placeholder="-" value="<?=$tersisa?>"readonly><br>
            </div></div>
            <div class="row">
        <div class="col-md-4">
            <label for="">Jml Kas Bon Sekarang</label>
            </div><div class="col-md-8">
            <input type="text" name="kasbon" id="jmlk" class="form-control" placeholder="Masukan Jumlah Kas Bon" onChange="cek(this.value)" required > <br>
            </div></div>
<div style="float:right">
            <input type="submit"  class="btn btn-primary" value="Masukan Data">
            </div>
        </form>
        </div>
        <div class="col-md-3">
        
        <?php $i = 1; ?>
        <h2>Tambah Orang</h2>
        
            <form action="../back/tambah_orang.php" method="post">
            <div class="row">
                        <div class="col-4">
                <label for="">Nama : </label>
                        </div><div class="col-8">
                <input class="form-control" type="text" name="in_nama" required><br>
                </div></div>
                <div class="row" >
                <div class="col-12">
                <input type="submit"style="float:right" class="btn btn-primary" value="Tambahkan">
                </div>
                </div>
            </form>
            <!-- <div class="row"> -->
            <!-- <a href="../back/clear_orang.php">clear orang</a> -->
            <!-- </div> --><br>
            <div class="row">
            <div class="col-md-12">
            <div style="border:0.2px solid grey;border-radius:10px; overflow:hidden;">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th class="col-3">NO.</th>
                                        <th class="col-3">NAMA</th>
                                        <th class="col-3">KASBON</th>
                                        <th class="col-3">AKSI</th>
                                    </tr>
                                </thead class="">
                            </table>
                            <div class="tbod">
                                <table class="table" >
                                    <tbody class="">
                <?php $i = 1; ?>
                <?php foreach ($databon as $row) { ?>
                <tr>
                    <?php if($i<10){?>
                    <td class="col-3">0<?php echo $row["no_orang"]; ?></td>    
                    <?php
                    }else{?>
                    <td class="col-3"><?php echo $row["no_orang"]; ?></td>    
                        <?php
                    }
                    ?>

                    <td class="col-3"><?php echo $row["nama_orang"]; ?></td>
                    <?php
                    $namak= $row["nama_orang"];
                    $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
                    $data2 = mysqli_query($con,$sql2);
                    
                    $jumlah=0;
                    $jumlahk=0;
                    $kasbonn=0;
                    while ($rows = mysqli_fetch_array($data2)) {
                      $jumlahk=$jumlahk+$rows['kredit'];
                      $jumlah=$jumlah+$rows['debet'];
                      $kasbonn=$jumlahk-$jumlah;
                      if($kasbonn==0){
                        $jumlahk=0;
                        $jumlah=0;
                      }
                    }
                    ?>
                    <td class="col-3"><?=$kasbonn?></td>
                    <td class="col-3"><a href="../back/delete_orang.php?id=<?php echo $row['id']; ?>"onclick="return confirm('Yakin Ingin Menghapus?')" id="$i">hapus</a></td>
                </tr>
                <?php $i++; ?>

                <?php };
                
                // print_r($last_keg);
                ?>

            </table>
            </div>
                        </div>

                    </div>
                </div>
            </div>
    
<div class="col-md-5">
<h1>DEBET</h1>
            <form action="../back/insert_kasbon.php" method="post">
            <div class="row">
                <div class="col-md-4">
                <label for="tanggal">Tanggal </label>
                </div><div class="col-md-8">
                <input type="text" name="tanggal" class="form-control"value="<?php echo date('d-m-Y'); ?>"readonly><br>
                </div></div>
                <div class="row">
                <div class="col-md-4">
                <label for="No / Nama Kegiatan">No / Nama  </label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                    <div class="col-md-4">
                <select name="no_kegiatan" id="no_orang" class="form-control" onChange="GetNo_kegiatand(this.value)" required>
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
                <input type="text" name="nama_orang" class="form-control" id="nama_orangd"readonly> <br>
                </div></div></div></div>
                <div class="row">
                <div class="col-md-4">
                <label for="">Jml Yang Harus Di Bayar </label>
                </div><div class="col-md-8">
                <input type="text" name="harus_bayar" id="harus_bayar" class="form-control" placeholder="-" value="0"> <br>
                </div></div>
                <div class="row">
                <div class="col-md-4">
                <label for="">Jml Sudah Di Bayar </label>
                </div><div class="col-md-8">
                <input type="text" name="sudah_bayar" id="sudah_bayar" placeholder="-" class="form-control"readonly> <br>
                </div></div>
                <div class="row">
                <div class="col-md-4">
                <label for="">Jml DiBayar Sekarang </label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                <div class="col-md-9">
                <div class="input-group mb-3">
                <input type="text" name="dibayar" class="form-control"id="dibayar" onChange="updatekurang2(this.value)" placeholder="" required> <br>
                </div></div><div class="col-md-3">
                <div class="input-group-append">
                <button class="btn btn-success" type="button" onclick="lunas()" id="button-lunas">Lunas</button>
                </div>
                </div>
                </div>
                </div></div>
                <div class="row">
                <div class="col-md-4">
                <label for="">Kurang Di Setor</label>
                </div><div class="col-md-8">
                <input type="text" name="kurang" id="kurang" class="form-control"placeholder="-"readonly> <br>
                </div></div>
                
                <div style="float:right">
                <input type="submit" class="btn btn-primary" value="Masukan Data">
                </div>
                

            </form>
        </div>
        <?php
    print_r($_SESSION);
    ?></div>
    
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
            // $('#jmlad').val(data[1].tersisa);
            // $('#sudah_bayar').val(data[2].jumlahk)
            // );
            // }
        }
        function lunas(){
            var tagihan = $("#harus_bayar").val();
            $('#dibayar').val(tagihan);
        }

        
        
        function updatekurang2(dibayar) {
            var hrs_bayar = $("#harus_bayar").val();
            var sdh_bayar = $("#sudah_bayar").val();
            var kurang = (hrs_bayar-sdh_bayar-dibayar);
            // if (kurang <= 0) {
            //     kurang = (kurang * -1);
            // }
            
            if (kurang==0){
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                html: 'Jumlah Yang Di Bayar <br> Tidak Boleh 0',
                });
            
                $("#dibayar").val('');
            }
            if (kurang<0){
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                html: 'Jumlah Yang Di Bayar <br> Tidak Boleh Melebihi Jumlah Yang Harus Di Bayar <br> jumlah yang di Bayar : '+dibayar,
                })
            
                $("#dibayar").val(0);
                $("#kurang").val(0);
            }else{
            
            $("#kurang").val(kurang);
            }
            

        };
        function cek(bon) {
            
            var dana = $("#jmlad").val();
            var kurang = (dana-bon);
            // if (kurang <= 0) {
            //     kurang = (kurang * -1);
            // }
            if (kurang<0){
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                html: 'Jumlah Yang Di Kas Bon <br> Tidak Boleh Lebih dari Jumlah Dana Yang Ada <br> jumlah yang di Kas Bon : '+bon,
                })
                $("#jmlk").val(0);
            }
            
            
            
            

        };
    
    </script>
    <?php
if(isset($_GET["hapus"])){
     if($_GET["hapus"] == "gagal"){?><script>
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Kas Bon Harus Di Lunasi Terlebih Dahulu',
        }) </script>
        <?php
     } else {
         ?>
         <script>
        
        Swal.fire({
            type: 'success',
            title: 'Oops...',
            html: 'Orang Telah Terhapus',
        })
        </script><?php
     }
 }?>
 <?php
if(isset($_GET["hasil"])){
     if($_GET["hasil"] == "ada_sama"){?><script>
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Nama Kegiatan Sudah Ada Yang Sama',
        }) </script>
        <?php
     } else {
         echo "Data berhasil diinput";
     }
 }?>
 
</body>

</html>