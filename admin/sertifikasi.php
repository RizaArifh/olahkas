<?php
include "../back/conn.php";
$dataguru = mysqli_query($con, "SELECT * FROM guru_sertifikasi");

    $sqlsm = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan='Sertifikasi Masuk'";
    $datasm = mysqli_query($con,$sqlsm);
    $sqlsk = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan='Sertifikasi Keluar'";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <title>Sertifikasi</title>
</head>

<body>
    <?php
    include "../element/_nav.php"
    ?>
    <div class="row">
        <div class="col-md-4">
            <h1>DEBET</h1>
            <form action="../back/insert_sertifikasi.php" method="post">
                <label for="tanggal">Tanggal :</label>
                <input type="text" name="tgl" value="<?php echo date('d-m-Y'); ?>">
                <input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" hidden><br>
                <label for="No / Nama Kegiatan">No / Nama : </label>
                <select name="no_kegiatan" id="no_kegiatand" onChange="GetNo_kegiatand(this.value)" required>
                    <option value="">Pilih</option>
                    <?php
                    $list_no_keg = "SELECT * FROM guru_sertifikasi";
                    $data = mysqli_query($con, $list_no_keg);
                    while ($no_keg = mysqli_fetch_array($data)) { 
                    if($no_keg['no_orang']<10){
                        
                        ?>
                        <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_guru']; ?> </option>
                        <?php
                        }else{?>
                        <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_guru']; ?> </option>
                        }
                        <?php };?>
                    
                    <?php };
                    print_r($data);
                    ?>
                </select>
                <input type="text" name="nama_keg" id="nama_kegiatand"> <br>
                <label for="">Jml Harus Di Setor :</label>
                <input type="text" name="harus_setor" id="harus_setor" placeholder="-" value="0"> <br>

                <label for="">Jml Sudah Di Setor :</label>
                <input type="text" name="sudah_setor" id="sudah_setor" placeholder="-"> <br>

                <label for="">Jml DiSetor Sekarang :</label>
                <input type="text" name="disetor" id="disetor" onChange="updatekurang(this.value)" placeholder=""> <br>

                <label for="">Kurang Di Setor:</label>
                <input type="text" name="kurang" id="kurang" placeholder="-"> <br>

                <label for="">Keterangan :</label>
                <input type="text" name="keterangan" placeholder=""> <br>
                <input type="submit" value="Masukan Data">

            </form>
        </div>
        <div class="col-md-4">
        
        <?php $i = 1; ?>
                <?php foreach ($dataguru as $row) : ?>
                <?php $i++; ?>

                <?php endforeach;
                $last_keg = $i;
                // print_r($last_keg);
                ?>
                <h2>Tambah Guru</h2>
            <form action="../back/tambah_guru.php" method="post">
            <?php
            if($last_keg<10){
?>
                <input type="text" name="in_no" value="0<?= $last_keg ?>" hidden>
                <?php
            }else{?>
                <input type="text" name="in_no" value="<?= $last_keg ?>" hidden>
                <?php
            }
            ?>
                <label for="">Nama Guru : </label>
                <input type="text" name="in_nama">
                <input type="submit" value="Tambah Guru">
            </form>
            <table class="table1" border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <th>No.</th>
                    <th>Nama Guru</th>
                    <th>aksi</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($dataguru as $row) : ?>
                <tr>
                    <td>0<?php echo $row["no_guru"]; ?></td>
                    <td><?php echo $row["nama_guru"]; ?></td>
                    <td><a href="../back/delete_guru.php?id=<?php echo $row['id']; ?>">hapus</a></td>
                </tr>
                <?php $i++; ?>

                <?php endforeach;
                
                // print_r($last_keg);
                ?>

            </table>
            
        </div>
    
    
<div class="col-md-4">
        <h1>KREDIT</h1>
        <form action="../back/insert_sertifikasi_k.php" method="post">
            
        <label for="">Tanggal :</label>
        <input type="text" name="tgl" value="<?php echo date('d-m-Y'); ?>">
                <input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" hidden><br>
            
            <label for="">Keterangan :</label>
            <input type="text" name="sub_kegiatan" placeholder=""> <br>

            <label for="">Jml Dana Yang Tersedia :</label>
            <input type="text" name="dana_ada" id="jmlad" placeholder="-" value="<?=$jumlahsaldos?>"<br>

            <label for="">Jml DiKeluarkan Sekarang :</label>
            <input type="text" name="dana_sdh_keluar" id="jmlk" placeholder="" onchange="updatesaldo(this.value)" > <br>

            <label for="">Saldo :</label>
            <input type="text" name="saldo" id="saldo" placeholder="-"> <br>
            <input type="submit" value="Masukan Data">

        </form>
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
                xmlhttp.open("GET", "../back/GetNo_guru.php?id=" + id, true);
                xmlhttp.send();
            };
        };

        function set_nama_kegiatand(data) {
            // debugger;   
            // for (var i = 0; i < data.length; i++) {
            // $('#no_kegiatan').append(
            $('#nama_kegiatand').val(data[0].nama);
            // $('#jmlrka').val(data[1].jumlah);
            $('#sudah_setor').val(data[1].jumlah)
            // );
            // }
        }

        

        function updatekurang(setor) {
            var hrs_setor = $("#harus_setor").val();
            var sdh_setor = $("#sudah_setor").val();
            var kurang = (hrs_setor-sdh_setor-setor);
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