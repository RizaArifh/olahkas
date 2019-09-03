<?php

    require_once "conn.php";
    $nilai = $_GET["nilai"];
    $sql = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
    $data = mysqli_query($con,$sql);
    $jumlah=0;
    
        // print_r($namak);
        // $b = mysqli_fetch_array($data);
        // print_r($b
        while ($row = mysqli_fetch_array($data)) {
            $jumlah=$jumlah+$row['debet'];
        }
        $datak= array('jumlah'=>$jumlah);
        
        // print$jumlah;
        echo json_encode($datak);
    ?>