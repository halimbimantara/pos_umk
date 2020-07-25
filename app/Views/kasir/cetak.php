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
	font-size: 8pt;
}
</style>

<script>
myFunction();
function myFunction() {
    window.print();
}
</script>
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
  <table border="0" width="80%">
   <tr>
  -------------------------------------------------------
  </tr>
  <?php foreach ($list->getResult() as $row) { ?>
  <tr>
  	<td align="center"><?php echo $row->qty; ?></td>
  	<td align="center"><?php echo $row->nama_barang; ?></td>
  	<td align="center"><?php echo number_format($row->harga, 0 ,'' , '.' ); ?></td>
  	<td align="right"><?php echo number_format($row->total, 0 ,'' , '.' ); ?></td>
  </tr>
  <?php } ?>
  </table>
  <table width="80%">
  <tr>
  -------------------------------------------------------
  	<td align="left"></td>
  	<td align="right"></td>
  	<td align="right">Total</td>
  	<td align="right"><?php echo number_format($total, 0 ,'' , '.' ); ?></td>
  </tr>
  </table>
  </div>
  <div class="harga">
  <table hidden border="0" width="80%">
   <tr>
   -------------------------------------------------------
  <td align="left">Customer :<?php //echo $nama_petugas; ?></td>
  </tr>
  <tr>
  	<td align="left">Service Charge</td>
  	<td align="right">1%</td>
  	<td align="right"><?php //echo $sc; ?></td>
  </tr>
  <tr>
  	<td align="left">Delivery Charge</td>
  	<td align="right"></td>
  	<td align="right"><?php //echo $dc; ?></td>
  </tr>
  <tr>
  	<td align="left">Jarak <?php //echo $km; ?></td>
  	<td align="right">2000</td>
  	<td align="right"><?php //echo $dckm; ?></td>
  </tr>
  </table>
  </div>
   <div class="total">
  <table border="0" width="80%">
   <tr>
   --------------------------------------------------------
  <td align="left">Kasir : <?php //echo $nama_kasir; ?></td>
  <td align="right"></td>
  <td align="right">Total : <?php echo number_format($total, 0 ,'' , '.' ); ?></td>
  </tr>
  <tr>
  	<td align="left"></td>
  	<td align="right"></td>
  	<td align="right">Bayar      : <?= $bayar; ?></td>
  </tr>
  <tr>
  	<td align="left"></td>
  	<td align="right"></td>
  	<td align="right">Kembalian : <?= $kembalian; ?></td>
  </tr>
  <!-- <tr>
  	<td align="left">Nama Pelanggan <?php //echo $nama_pelanggan; ?></td>
  </tr>
  <tr>
  	<td align="left">Alamat Pelanggan <?php //echo $alamat_pelanggan; ?></td>
  </tr>
  <tr>
  	<td align="left">Telepon <?php //echo $tlpn; ?></td>
  </tr> -->
  </table>
  </div>
  <div class="footer">
  <p></p>
  	<center><b>TERIMA KASIH TELAH BERBELANJA DI Toko Kami</b></center>
    <table border="0" width="100%">
    <td align="left"></td>
    <td align="center"><b>"UTAMAKAN PELAYANAN"</b></td>
 	</table>
 </div>
</body>
</html>
