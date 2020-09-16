<!DOCTYPE html>
<html>
<body>

<style type="text/css">

body{
      width:80mm;
      height: inherit;
} 
td{
  font-size: 8pt;
}

td-h{
   text-align: center;     
    }
.footer{
  font-size: 6pt;
}
</style>

<script>
myFunction();
function myFunction() {
    window.print();
}
</script>

<?php  $tgl_now=date('Y-m-d'); ?>
<p><b>Nota Pembelian</b></p>
<table border="0" width="100%">
<tr>
    <td width="3%"><b><?= $data[0]->nama_usaha; ?></b></td><!-- setting -->
    <!-- <td width="2%"><b>Delivery :</b></td> -->
  </tr>
  <tr>
    <td width="2%">Jl.</td>
    <td width="2%"><?= $data[0]->no_tlpn; ?></td> 
  </tr>
  <tr>
    <td width="2%">Kediri</td>
    <td >WA: <?= $data[0]->no_wa; ?></td> 
  </tr>
  <tr>
    <td width="2%">No Nota <?php echo $no_nota; ?></td>
    <td><?php echo $tgl; ?></td> 
  </tr>
</table>
  <div>
  <table border="0" width="90%">
   <tr>
   ----------------------------------------------------
  </tr>
  
  
  <?php foreach ($list->getResult() as $row) { ?>
  <tr>
  	<td align="center"><?php echo $row->qty; ?></td>
  	<td align="center"><?php echo $row->nama_barang; ?></td>
  	<td align="center"><?php echo number_format($row->harga, 0 ,'' , '.' ); ?></td>
  	<td align="center"><?php echo number_format($row->diskon, 0 ,'' , '.' ); ?></td>
  	<td align="right"><?php echo number_format($row->total, 0 ,'' , '.' ); ?></td>
  </tr>
  <?php } ?>

  </table>
  <table width="90%">
  <tr>
    -----------------------------------------------------
  	<td align="left">Total</td>
  	<td align="right"></td>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right"></td>
    <td align="right"></td>
  	<td align="right"><?php echo number_format($total, 0 ,'' , '.' ); ?></td>

  </tr>
  
  </table>
  <table width="90%">
  <tr>
  <?php
  // $total_B=doubleval($balance)+doubleval($totalnota->row()->total);
    
   
  //   if ($balance != 0) {
  //   echo '<td align="left">Total + Balance</td>
  //   <td align="right">'.$balance.'</td>
    
  //   <td align="right">'.number_format($total_B, 0 ,'' , '.' ).'</td>';
  //     }
  ?>

  <?php
    
  //   if ($ut != 0) {
  //   echo '<tr><td align="left">Menggunakan Uang Toko</td>
  //   <td align="right"></td><tr>';
  //     }
  ?>
   
     </tr>
 </table>
 <!--
  karena panjang
  <table width="90%">
    <tr>
    <td>Diskon ke 1 </td>
    <td align="right"><?php //echo $totalnota->row()->potdiskon1."%";?></td>
    </tr>
    <tr>
    <td>Diskon ke 2 </td>
    <td align="right"><?php //echo $totalnota->row()->potdiskon2."%";?></td>
    </tr>
    <tr>
    <td>Potongan Nominal 1 </td>
    <td align="right"><?php //echo $totalnota->row()->potnominal1;?></td>
    </tr>
    <td>Potongan Nominal 2 </td>
    <td align="right"><?php //echo $totalnota->row()->potnominal2;?></td>
    </tr>
    <tr>
    <td>Total Potongan : </td>
    <td align="right"><?php //echo $potonganpembelian;?></td>
    </tr>
  </table>
  -->
  </div>

   <div class="total">
  <table border="0" width="80%">
   <tr>
   ------------------------------------------------------
  <td align="left">Kasir   : <?php //echo $data->row()->petugas; ?></td>

  </tr>
  
  </table>
  </div>
  <div class="footer">
  <p></p>
  	<center><b>STRUK SEBAGAI BUKTI DATA SUDAH DI MASUKAN</b></center>
    <table border="0" width="100%">
    <td align="left"></td>
    <td align="center"><b>"UTAMAKAN PELAYANAN"</b></td>
  	<td align="right"></td>
 	</table>
 </div>

</body>
</html>
