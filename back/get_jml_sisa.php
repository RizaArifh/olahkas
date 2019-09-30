<?php $_sql2 = "SELECT * FROM data_transaksi WHERE de='3' or de='2'";

      $_data2 = mysqli_query($con,$_sql2);
      
      $_sql3="select* from data_transaksi where de='4' and subnama_kegiatan='Petty dan Kas Bon'";
      $_data3 = mysqli_query($con,$_sql3);
      
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
      
      $_tersedia=0;
      while($_row = mysqli_fetch_array($_data3)){
        $_tersedia=$_tersedia+$_row['debet'];
      }
      $tersisa=$_tersedia+$_kasbon;
?>