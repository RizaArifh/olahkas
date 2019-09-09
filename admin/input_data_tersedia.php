<?php
include "../back/conn.php";
$datakeg = mysqli_query($con, "SELECT * FROM kegiatan");
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

    <?php include "../element/boots.php"; ?>

    <title>Document</title>
</head>

<body>
    <?php
    include "../element/_nav.php"
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h1>Masukan Dana Kegiatan RKA</h1>
                <form action="../back/insert_jumlah_tersedia.php" method="post" autocomplete="off" class="form-horizontal">
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
                    <label for=""class="control-label">Dana Yang Akan Dimasukan</label>
                    </div>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="jumlah_tersedia"><br>
                    </div></div>
                    <div class="row">
                    <div class="col-md-4">
                    <label for="No / Nama Kegiatan"class="control-label align-self-center">No / Nama Kegiatan</label>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                        <div class="col-md-4">
                    <select class="form-control" name="no_kegiatan" id="no_kegiatand" onChange="GetNo_kegiatan(this.value)" required>
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
                                }
                            <?php }; ?>

                        <?php };
                        print_r($data);
                        ?>
                    </select></div>
                    <div class="col-md-8">
                    <input style="" class="form-control" type="text" name="nama_keg" id="nama_kegiatan"><br>
                    </div></div></div></div>
                    <div class="row">
                    <div class="col-md-4">
                    <label for=""class="control-label">Keterangan     </label>
                    </div>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="keterangan"><br>
                    </div></div>
                    <input type="submit" value="Masukan">
                </form>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <h1>Masukan Dana PettyCash</h1>
                <form action="../back/insert_jumlah_tersedia_p.php" method="post">
                    <label for="tanggal">Tanggal :</label>
                    <input type="text" name="tanggal" value="<?php echo date('d-m-Y'); ?>"><br>
                    <label for="">Jumlah yang tersedia : </label>
                    <input type="text" name="jumlah_tersedia"><br>
                    <label for="">Keterangan : </label>
                    <input type="text" name="Keterangan"><br>
                    <input type="submit" value="Masukan">
                </form>
            </div>
        </div>

    </div>
    <script>
    function GetNo_kegiatan(id){
        if (id.length == 0) {
                $('#nama_kegiatan').val('Pilih No Kegiatan');
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
                xmlhttp.open("GET", "../back/GetNo_kegiataninput.php?id=" + id, true);
                xmlhttp.send();
            };
    };
    function set_nama_kegiatand(data) {
            
            $('#nama_kegiatan').val(data[0].nama);
            
        }
    </script>
</body>

</html>