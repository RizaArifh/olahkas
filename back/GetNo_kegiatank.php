<?php

    require_once "conn.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM kegiatan WHERE id = $id";
    $data = mysqli_query($con,$sql);
      
      foreach($data as $row) {
        //   print_r($row);
          
        $dataskp[] = array('id' => $row["id"], 'nama' => $row["nama_kegiatan"]); 
      }
      $namak= $dataskp[0]['nama'];
      $sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
      $data2 = mysqli_query($con,$sql2);
      $sql3 = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan = '$namak'";
      $data3 = mysqli_query($con,$sql3);
      $jumlah=0;
      while ($row = mysqli_fetch_array($data2)) {
        $jumlah=$jumlah+$row['debet'];
      }
      $jumlahk=0;
      while ($row = mysqli_fetch_array($data3)) {
        $jumlahk=$jumlahk+$row['kredit'];
        
      }
      // echo $jumlahk;
      
      $j[]=array('jumlah'=>$jumlah);
      $l[]=array('jumlah'=>$jumlahk);
      $dt=array_merge($dataskp,$j,$l);
      // print_r($dt);
// print_r(($datask));

        echo json_encode($dt);
    ?>