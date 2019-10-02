<?php $_sql2 = "SELECT * FROM data_transaksi WHERE de='2'";

      $_data2 = mysqli_query($con,$_sql2);
      $datalast = mysqli_query($con, "SELECT * FROM data_transaksi where de='4' and subnama_kegiatan='Petty dan Kas Bon' ORDER BY id DESC LIMIT 1");
      $datatglfirst = mysqli_query($con, "SELECT * FROM data_transaksi where de='3' ORDER BY id asc LIMIT 1");

      
      $_data3 = mysqli_query($con,"select* from data_transaksi where de='3' or de='4' and subnama_kegiatan='Petty dan Kas Bon' or de='3' and subnama_kegiatan='Petty dan Kas Bon'");
      
      $_jumlah=0;
      $_jumlahk=0;
      $_kasbon=0;
      while ($_row = mysqli_fetch_array($_data2)) {
        $_jumlah=$_jumlah+$_row['kredit'];
        $_jumlahk=$_jumlahk+$_row['debet'];
        $_kasbon=$_jumlahk-$_jumlah;
        if($_kasbon==0){
          $_jumlahk=0;
          $_jumlah=0;
        }
      }
      $last=0;
      
      while ($row = mysqli_fetch_array($datalast)) {
        $last=$row['keterangan'];
      }
      while ($row = mysqli_fetch_array($datatglfirst)) {
        $st=$row['tanggal'];
      }
      
      
      $_tersedia=0;
      while($_row = mysqli_fetch_array($_data3)){
        $_tersedia=$_tersedia+$_row['debet'];
        $_tersedia=$_tersedia-$_row['kredit'];
        
      }
      $tersisa=$_tersedia+$_kasbon;
      $listpetty = mysqli_query($con,"SElECT * FROM data_transaksi where de=4 and subnama_kegiatan='Petty dan Kas Bon' group by keterangan order by id");
     
?>