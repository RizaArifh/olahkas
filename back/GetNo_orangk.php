<?php

    require_once "conn.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM orang_kasbon WHERE id = $id";
    $data = mysqli_query($con,$sql);
      
      foreach($data as $row) {
        //   print_r($row);
          
        $datasd[] = array('id' => $row["id"], 'nama' => $row["nama_orang"]); 
      }
    //   echo $a = array_pluck($datasd,'nama');
      $namak= $datasd[0]['nama'];
      $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
      $data2 = mysqli_query($con,$sql2);
      
      $jumlah=0;
      $jumlahk=0;
      while ($row = mysqli_fetch_array($data2)) {
        $jumlah=$jumlah+$row['kredit'];
        $jumlahk=$jumlahk+$row['debet'];
      }
      $kasbon=$jumlah-$jumlahk;
      

    //   // echo $jumlah;
      $j[]=array('kasbon'=>$kasbon);
      $dt=array_merge($datasd,$j);
      // print_r($dt);
        echo json_encode($dt);
    ?>