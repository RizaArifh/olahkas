<?php

    require_once "conn.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM kegiatan WHERE id = $id";
    $data = mysqli_query($con,$sql);
      
      foreach($data as $row) {
        //   print_r($row);
          
        $datasd[] = array('id' => $row["id"], 'nama' => $row["nama_kegiatan"]); 
      }
      // echo $a = array_pluck($datasd,'nama');
      $namak= $datasd[0]['nama'];
      $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
      $data2 = mysqli_query($con,$sql2);
      $jumlah=0;
      while ($row = mysqli_fetch_array($data2)) {
        $jumlah=$jumlah+$row['debet'];
      }
      // echo $jumlah;
      $j[]=array('jumlah'=>$jumlah);
      $dt=array_merge($datasd,$j);
      // print_r($dt);
        echo json_encode($dt);
    ?>