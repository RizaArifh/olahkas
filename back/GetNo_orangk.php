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

    //   // echo $jumlah;
      // $j[]=array('tersisa'=>$tersisa);
      // $dt=array_merge($datasd,$j);
      // print_r($dt);
        echo json_encode($datasd);
    ?>