<?php

include "conn.php";
$id = $_GET["id"];

$pp = mysqli_query($con, "SELECT * FROM orang_kasbon WHERE id='$id'");

foreach ($pp as $row) {
  //   print_r($row);

  $dat[] = array('id' => $row["id"], 'nama' => $row["nama_orang"]);
}
$namak = $dat[0]['nama'];
//   $namak= $row["nama_orang"];
$sql2 = "SELECT * FROM data_transaksi WHERE subnama_kegiatan = '$namak'";
$data2 = mysqli_query($con, $sql2);

$jumlah = 0;
$jumlahk = 0;
$kasbonn = 0;
while ($rows = mysqli_fetch_array($data2)) {
  $jumlahk = $jumlahk + $rows['kredit'];
  $jumlah = $jumlah + $rows['debet'];
  $kasbonn = $jumlahk - $jumlah;
  if ($kasbonn == 0) {
    $jumlahk = 0;
    $jumlah = 0;
  }
}
if ($kasbonn > 0) {

  header("location:../admin/kasbon.php?hapus=gagal");
} else {

  mysqli_query($con, "DELETE FROM orang_kasbon WHERE id='$id'");
  $m=1;
  $dataupdate=mysqli_query($con,"select * FROM orang_kasbon");
  foreach ($dataupdate as $row){
      $b=$row['id'];
      mysqli_query($con,"update orang_kasbon set no_orang='$m' where id='$b'");
      $m++;
  }
  header("location:../admin/kasbon.php?hapus=berhasil");
}
// print_r($id);   
