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
    
    <title>Document</title>
</head>
<body>
<?php
    include "../element/_nav.php"
    ?>
    <div class="container-fluid">
    <div class="row">
    <form action="../back/insert_jumlah_tersedia.php">
    <label for="tanggal">Tanggal :</label>
    <input type="text" name="tgl" value="<?php echo date('d-m-Y'); ?>"><br>
    <label for="">Jumlah yang tersedia : </label>
    <input type="text" name="jumlah_tersedia">
    <input type="submit" value="Masukan">
    </form>
    </div>
    </div>
</body>
</html>