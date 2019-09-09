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
      $sql2 = "SELECT * FROM data_transaksi WHERE nama_kegiatan_keterangan = '$namak' and de='1'";
      $data2 = mysqli_query($con,$sql2);
      
      $jumlah=0;
      $jumlahk=0;
      while ($row = mysqli_fetch_array($data2)) {
        // $jumlah=$jumlah+$row['debet'];
        $jumlahk=$jumlahk+$row['kredit'];
      }
      $sql3 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak' and de='4'";
      $data3 = mysqli_query($con,$sql3);
      $px=0;
      while ($row = mysqli_fetch_array($data3)) {
        $px=$px+$row['debet'];
      }
      
      // echo $jumlahk;
      
      $j[]=array('jumlah'=>$px);
      $l[]=array('jumlah'=>$jumlahk);
      $dt=array_merge($dataskp,$j,$l);
      // print_r($dt);
// print_r(($datask));

        echo json_encode($dt);
    ?>