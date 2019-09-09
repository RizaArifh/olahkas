<?php

    require_once "conn.php";
    $id = $_GET["id"];
    $sql = "SELECT * FROM kegiatan WHERE id = $id";
    $data = mysqli_query($con,$sql);
      
      foreach($data as $row) {
        //   print_r($row);
          
        $datasd[] = array('id' => $row["id"], 'nama' => $row["nama_kegiatan"]); 
      }
    
    
        echo json_encode($datasd);
    ?>