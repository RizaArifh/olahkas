<?php
include "../back/conn.php";
include "../back/get_jml_sisa.php";
$datap = mysqli_query($con, "SELECT * FROM data_transaksi where de='3' and keterangan='$last'");
$datacek = mysqli_query($con,
"SELECT * FROM data_transaksi WHERE de='3'");
$num=mysqli_num_rows($datacek);
 
?>
<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
    td{
        text-align: center;
    }
    .ket{
        font-size:13px;
        font-family:Arial;
    }
    </style>
    
 <?php 
 header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
if($last==0){
    header("Content-Disposition: attachment;filename=\"Petty_Cash_per_.xls\"");
}else{
 $ab=DateTime::createFromFormat('Y-m-d', $st)->format('d/M/Y');
 header("Content-Disposition: attachment;filename=\"Petty_Cash_per_$ab.xls\"");
}
    header("Cache-Control: max-age=0");
	?>
 <h3>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA (SPTB) <br>Nomor :</h3> 
 <pre class="ket">

 Yang bertanda tangan di bawah ini:
 Nama   : Waskito, S.Pd.
 Jabatan: Kepala Sekolah
 Selaku : Penanggungjawab
 
 Menyatakan bahwa saya bertanggung jawab secara formal dan material atas segala pengeluaran
 yang telah dibayar lunas oleh bagian keuangan sekolah kepada yang berhak menerima
 dengan perincian sebagai berikut:
 </pre>
 
	<table border="1">
        <thead>
        <tr>
            <th class="col-1" rowspan="2">NO.</th> 
            <th style="width:20%" rowspan="2">NAMA PENERIMA</th>
            <th class="col-3" rowspan="2">URAIAN BELANJA</th>
            <th class="col-3" colspan="2">BUKTI</th>
            <th class="col-1" rowspan="2">JUMLAH</th>
            <th class="col-2" rowspan="2">SISA</th>
          </tr>
          <tr>
            <th class="col-1">TANGGAL</th>
            <th class="col-1">NO</th>
          </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            $sis=25000000;
            $tot=0; ?>
            <?php foreach ($datap as $row) : ?>
            <tr>
                <?php if ($i < 10) { ?>
                  <td class="col-1">0<?php echo $i; ?></td>
                <?php
                  } else { ?>
                  <td class="col-1"><?php echo $i; ?></td>
                <?php
                  }
                  ?>
                <td class="col-1"><?php echo $row["subnama_kegiatan"]; ?></td>
                <td class="col-1"><?php echo $row["nama_kegiatan_keterangan"]; ?></td>
                <td class="col-1"><?php echo DateTime::createFromFormat('Y-m-d', $row['tanggal'])->format('d-M-Y'); ?></td>
                <td class="col-1" ><?php echo $i ?></td>
                <td class="col-2"><?php echo rupiah($row["kredit"]); ?></td>
                <?php $sis=$sis-$row["kredit"];?>
                <?php $tot=$tot+$row["kredit"];?>
                <td class="col-2"><?php echo rupiah($sis) ?></td>
               
              </tr>
              <?php $i++; ?>


            <?php endforeach;

            // print_r($last_keg);
            ?>
            
            <tr >
              <th  colspan="5">Jumlah Belanja Keseluruhan </th>
              

              <th><?php if($num>0){echo rupiah($tot);}else{echo 'RP 25.000.000,00';} ?></th>
              <th><?php if($num>0){echo rupiah($sis);}else{echo 'RP 25.000.000,00';} ?></th>
              
            </tr>
          </tbody>
        </table>
        <br>
        <pre class="ket">
Bukti-bukti pengeluaran anggaran tersebut di atas disimpan oleh bagian keuangan sekolah
Untuk kelengkapan administrasi dan pemeriksaan/pengawasan internal Yayasan,
Demikian Surat Pernyataan ini dibuat dengan sebenarnya.

                                                                                                            Surakarta. <?=date('d F Y')?>

                                                                                                            Kepala Sekolah



                                                                                                            Waskito, S.Pd.

</pre>
        <?php
  function rupiah($angka){
	
	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}
?>
</body>
</html>