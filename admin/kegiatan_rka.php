<?php
include "../back/conn.php";
$datakeg = mysqli_query($con, "SELECT * FROM kegiatan");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <?php include "../element/boots.php" ?>

    <title>Kegiatan RKA</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        include "../element/_nav.php";
        ?>
        <div class="row">
            <div class="col-lg-4">
                
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#debet"><h1>DEBET</h1></a></li>
                    <li><a href="#input_dana"><h1>INPUT DANA</h1></a></li>
                </ul>
                <div class="tab-content">
                    <div id="debet" class="tab-pane fade in active">
                        <form action="../back/insert_rka.php" method="post" autocomplete="off">
                        <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="tanggal">Tanggal :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="tanggal" value="<?php echo date('d-m-Y'); ?>" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="No / Kegiatan">No / Kegiatan : </label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <select name="no_kegiatan" id="no_kegiatand" class="form-control" onChange="GetNo_kegiatand(this.value)" required>
                                                <option value="">Pilih</option>
                                                <?php
                                                $list_no_keg = "SELECT * FROM kegiatan";
                                                $data = mysqli_query($con, $list_no_keg);
                                                while ($no_keg = mysqli_fetch_array($data)) {
                                                    if ($no_keg['no_keg'] < 10) {

                                                        ?>
                                                        <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_keg']; ?> </option>
                                                    <?php
                                                        } else { ?>
                                                        <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_keg']; ?> </option>
                                                    <?php    };
                                                    };
                                                print_r($data);
                                                ?>
                                            </select></div>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" name="nama_keg" id="nama_kegiatand" readonly> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Jml Sesuai RKA :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="anggaran_rka" class="form-control" id="jmlrka" placeholder="-" readonly> <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Jml Sudah DiDebet :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="sudah_debet" id="sudah_debet" class="form-control" placeholder="-" readonly> <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Jml DiDebet Sekarang :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="didebet" id="didebet" class="form-control" onChange="updatekurang(this.value)" placeholder="" required> <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Kurang :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="kurang" id="kurang" class="form-control" placeholder="-" readonly> <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Keterangan :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="keterangan" class="form-control" placeholder=""> <br>
                                </div>
                            </div>
                            <input style="float:right;" class="btn btn-primary" type="submit" value="Masukan Data">

                        </form>
                    </div>
                    <div id="input_dana" class="tab-pane fade">
                        <h2>Masukan Dana Kegiatan RKA</h2>
                        <form action="../back/insert_jumlah_tersedia.php" method="post" autocomplete="off" class="form-horizontal" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="tanggal" class="control-label">Tanggal</label>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="tanggal" value="<?php echo date('d-m-Y'); ?>"><br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="No / Nama Kegiatan" class="control-label align-self-center">No / Kegiatan</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <select class="form-control" name="no_kegiatan" id="no_kegiatand2" onChange="GetNo_kegiatan2(this.value)" required>
                                                <option value="">Pilih</option>
                                                <?php
                                                $list_no_keg = "SELECT * FROM kegiatan";
                                                $data = mysqli_query($con, $list_no_keg);
                                                while ($no_keg = mysqli_fetch_array($data)) {
                                                    if ($no_keg['no_keg'] < 10) {

                                                        ?>
                                                        <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_keg']; ?> </option>
                                                    <?php
                                                        } else { ?>
                                                        <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_keg']; ?> </option>
                                                <?php        };

                                                };
                                                print_r($data);
                                                ?>
                                            </select></div>
                                        <div class="col-lg-8">
                                            <input style="" class="form-control" type="text" name="nama_keg" id="nama_kegiatan2" readonly><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="control-label">Jumlah Dana</label>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control " type="text" name="jumlah_tersedia" onchange="cekangka(this.value)" required><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="control-label">Keterangan </label>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="keterangan" required><br>
                                </div>
                            </div>
                            <div style="float:right">
                            <input class="btn btn-primary" type="submit" value="Masukan">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">
            
                <?php $i = 1; ?>
                <h2>Tambah Kegiatan</h2>
                <form action="../back/tambah_kegiatan.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Kegiatan </label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="in_nama_keg" required><br>
                        </div>
                    </div>
                <div class="row" style="float:right">
                <div class="col-12">
                    <input class="btn btn-primary" type="submit" value="Tambah Kegiatan">
                    </div></div>

                </form>
                <br><br><br>
                <div class="row">
                    <div class="col-lg-12">

                        <div style="border:0.5px solid grey;border-radius:10px; overflow:hidden;">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th class="col-lg-3">NO.</th>
                                        <th class="col-lg-6">NAMA KEGIATAN</th>
                                        <th class="col-lg-3">AKSI</th>
                                    </tr>
                                </thead class="">
                            </table>
                            <div class="tbod">
                                <table class="table" >
                                    <tbody class="">
                                        <?php $i = 1;
                                        foreach ($datakeg as $row) : ?>
                                            <tr>
                                                <?php if ($row["no_keg"] < 10) { ?>
                                                    <td class="col-lg-2">0<?php echo $row["no_keg"]; ?></td>
                                                <?php } else {?>
                                                    <td class="col-lg-2"><?php echo $row["no_keg"]; ?></td>
                                                <?php } ?>
                                                <td class="col-lg-7"><?php echo $row["nama_kegiatan"]; ?></td>
                                                <td class="col-lg-3">
                                                    <a style="text-decoration:none;" onclick="return confirm('Hapus Data Kegiatan?');" href="../back/delete_keg.php?id=<?php echo $row['id']; ?>">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <h1>KREDIT</h1>
                <form action="../back/insert_rka_k.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="tanggal" class="control-label">Tanggal</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="tanggal" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="No / Nama Kegiatan">No / Kegiatan</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <select name="no_kegiatan" id="no_kegiatank" class="form-control" onChange="GetNo_kegiatank(this.value)" required>
                                        <option value="">Pilih</option>
                                        <?php
                                        $list_no_keg = "SELECT * FROM kegiatan";
                                        $data = mysqli_query($con, $list_no_keg);
                                        while ($no_keg = mysqli_fetch_array($data)) {
                                            if ($no_keg['no_keg'] < 10) {

                                                ?>
                                                <option value="<?= $no_keg['id'] ?>">0<?= $no_keg['no_keg']; ?> </option>
                                            <?php
                                                } else { ?>
                                                <option value="<?= $no_keg['id'] ?>"><?= $no_keg['no_keg']; ?> </option>
                                                <?php
                                                };
                                             }; 
                                        print_r($data);
                                        ?>
                                    </select></div>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="nama_keg" id="nama_kegiatank" readonly> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Sub Kegiatan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="sub_kegiatan" class="form-control" placeholder="" required> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Dana Yang Ada</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="dana_ada" id="jmlad" placeholder="-" class="form-control" readonly> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Total Dana Keluar</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="dana_sdh_keluar" id="jmlk" placeholder="-" readonly class="form-control"> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Keluarkan </label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="kredit" id="kredit" onChange="updatesaldo(this.value)" placeholder="" required> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Saldo</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="saldo" id="saldo" class="form-control" placeholder="-" readonly> <br>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Masukan Data" style="float:right">

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
                    xmlhttp.open("GET", "../back/GetNo_kegiatand.php?id=" + id, true);
                    xmlhttp.send();
                };
            };

            function set_nama_kegiatand(data) {
                // debugger;   
                // for (var i = 0; i < data.length; i++) {
                // $('#no_kegiatan').append(
                $('#nama_kegiatand').val(data[0].nama);

                // $('#jmlrka').val(convertToRupiah(data[2].seharusnya));
                // $('#sudah_debet').val(convertToRupiah(data[1].jumlah));
                $('#jmlrka').val(data[2].seharusnya);
                $('#sudah_debet').val(data[1].jumlah);
                // );
                // }
            }

            function GetNo_kegiatank(id) {
                if (id.length == 0) {
                    $('#nama_kegiatank').val('Pilih No Kegiatan');
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
                    xmlhttp.open("GET", "../back/GetNo_kegiatank.php?id=" + id, true);
                    xmlhttp.send();
                };
            };

            function set_nama_kegiatank(data) {
                // debugger;   
                // for (var i = 0; i < data.length; i++) {
                // $('#no_kegiatan').append(
                $('#nama_kegiatank').val(data[0].nama)
                $('#jmlad').val(data[1].jumlah);
                $('#jmlk').val(data[2].jumlah);
                // );
                // }
            };
function cekangka(angka){
    if(isNaN(angka)){
                    Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Masukan Harus Angka',
            
        });
        $("#didebet").val('');
        }else{}
}
            function updatekurang(debet) {
                if(isNaN(debet)){
                    Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Masukan Harus Angka',
            
        });
        $("#didebet").val('');
        }else{
                var jmlrkaa = $("#jmlrka").val();
                var sdhdebeta = $("#sudah_debet").val();
                var kurang = (jmlrkaa - sdhdebeta - debet);
                if (kurang < 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        html: 'Jumlah Yang Di Debet <br> Tidak Boleh Melebihi Jumlah Sesuai RKA <br> jumlah yang di debet : ' + debet,
                    })
                    $("#didebet").val('0');
                    $("#kurang").val('0');
                } else {
                    $("#kurang").val(kurang);
                }
            };}

            function updatesaldo(kredit) {
                if(isNaN(kredit)){
                    Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: 'Masukan Harus Angka',
            
        });
        $("#kredit").val('');
        }else{ 
                var jumlahada = $("#jmlad").val();
                var jumlahkredit = $("#jmlk").val();
                var saldo = (jumlahada - jumlahkredit - kredit);
                if (saldo < 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        html: 'Jumlah Yang Di Keluarkan <br> Tidak Boleh Melebihi Jumlah yang ada <br> jumlah yang di keluarkan : ' + kredit,
                    })
                    $("#kredit").val('0');
                    $("#saldo").val('0');
                } else {
                    $("#saldo").val(saldo);
                }

            };}
            // Change the selector if needed
            var $table = $('table'),
                $bodyCells = $table.find('tbody tr:first').children(),
                colWidth;

            // Get the tbody columns width array
            colWidth = $bodyCells.map(function() {
                return $(this).width();
            }).get();

            // Set the width of thead columns
            $table.find('thead tr').children().each(function(i, v) {
                $(v).width(colWidth[i]);
            });

            $(document).ready(function() {
                $(".nav-tabs a").click(function() {
                    $(this).tab('show');
                });
                $('.nav-tabs a').on('show.bs.tab', function() {

                });
                $('.nav-tabs a').on('shown.bs.tab', function() {

                });
                $('.nav-tabs a').on('hide.bs.tab', function(e) {

                });
                $('.nav-tabs a').on('hidden.bs.tab', function() {

                });
            });

            function GetNo_kegiatan2(id) {
                if (id.length == 0) {
                    $('#nama_kegiatan2').val('Pilih No Kegiatan');
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var myArr = JSON.parse(this.responseText);
                            console.log(myArr);
                            // removeOptions(document.getElementById("no_kegiatan"));
                            set_nama_kegiatan2(myArr);
                        }
                    };
                    xmlhttp.open("GET", "../back/GetNo_kegiataninput.php?id=" + id, true);
                    xmlhttp.send();
                };
            };

            function set_nama_kegiatan2(data) {

                $('#nama_kegiatan2').val(data[0].nama);

            };
            
//             function convertToRupiah(angka)
// {
// 	var rupiah = '';		
// 	var angkarev = angka.toString().split('').reverse().join('');
// 	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
// 	return rupiah.split('',rupiah.length-1).reverse().join('');
// }
        </script>
        
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
 }
 if(isset($_GET["hapus"])){
    if($_GET["hapus"] == "berhasil"){?><script>
       
       Swal.fire({
           type: 'success',
           title: 'Oops...',
           html: 'Kegiatan Telah Terhapus',
       }) </script>
       <?php
    }
}?>
 
 
</body>

</html>