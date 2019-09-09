<?php

    require_once "conn.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM guru_sertifikasi WHERE id = $id";
    $data = mysqli_query($con,$sql);
      
      foreach($data as $row) {
        //   print_r($row);
          
        $datasd[] = array('id' => $row["id"], 'nama' => $row["nama_guru"]); 
      }
    //   echo $a = array_pluck($datasd,'nama');
      $namak= $datasd[0]['nama'];
      $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
      $data2 = mysqli_query($con,$sql2);
      $jumlah=0;
      while ($row = mysqli_fetch_array($data2)) {
        $jumlah=$jumlah+$row['debet'];
      }
      $sql3 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
      $data3 = mysqli_query($con,$sql3);
      $jumlahk=0;
      while ($row = mysqli_fetch_array($data3)) {
        $jumlahk=$jumlahk+$row['kredit'];
      }
    //   // echo $jumlah;
    $totalbayar=0;
    $totalbayar=$jumlahk-$
      $j[]=array('jumlah'=>$jumlah);
      $k[]=array('jumlah'=>$jumlahk);
      $dt=array_merge($datasd,$j);
      $da=array_merge($dt,$k);
      // print_r($dt);
        echo json_encode($da);
    ?>