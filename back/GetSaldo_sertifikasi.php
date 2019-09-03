<?php

    require_once "conn.php";
    
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
    
      $j[]=array('jumlah'=>$jumlahsaldos);

    ?>