<?php

namespace App\Controllers;

use App\Models\Pos_model;
use App\Models\Pembelian_model;

class Pos extends BaseController
{
	public function index()
	{
		$modelPos = new Pos_model();
		$data = array();
		$data = array(
			'nota_penjualan' => $this->getNotaPenjualan()
		);

		//empty data sebelumnya
		$modelPos->delTablePenjualantmp($this->getNotaPenjualan());
		return view('kasir/kasir_view', $data);
	}

	//--------------------------------------------------------------------

	public function getNotaPenjualan()
	{
		$var_head = "JL";
		return $var_head . date('ymdHis');
	}
	public function addproduktemp()
	{
		$qty=$this->request->getVar('qty');
		$data = array(
			'kd_trx_penjualan' => $this->request->getVar('kd_trxpenjualan'),
			'kd_produk'  => $this->request->getVar('kd_produk'),
			'harga'  => $this->request->getVar('hrg_eceran'),
			'qty'  => $qty,
			'nama_barang'  => $this->request->getVar('nama_produk'),
			'sub_total'  => doubleval($this->request->getVar('hrg_eceran')) *$qty,
			'diskon' => 0,
			'created_date' => date("Y-m-d"),
			// 'diskon'  => $this->request->getVar('diskon')
		);
		$modelPos = new Pos_model();
		$r_insert = $modelPos->addDataPenjualanTemp($data);
		// var_dump($data);
		// exit();
		$response = array();
		if ($r_insert != NULL) {
			$response['success'] = true;

		} else {
			$response['success'] = false;
		}
		echo json_encode($response);
		// echo json_encode($data);
	}

	public function getTotalBelanja($kd_trxjual){
		$mdata = new Pos_model();
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$totalelanja=$r_total->getRow('sub_total');
		echo '<div class="info-box-content">
		<input type="hidden" name="total_belanja" id="total_belanja" value="' . $totalelanja . '"/>
		<span class="info-box-text">Total</span>
		<span class="info-box-number">'.number_format($totalelanja, 0, '', '.').'</span>
		</div>';
	}

	public function showTableTemp($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_temp = $mdata->getTablePenjualantmp($kd_trxjual);
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$result = '';
		$no = 1;
		$total_temp =number_format($r_total->getRow('sub_total'), 0, '', '.');
		foreach ($r_temp->getResult() as $rows) {
			$result .= '<tr>' .
				'<td>' . $no . '</td>' .
				'<td>' . $rows->nama_barang . '</td>' .
				'<td>' . $rows->harga . '</td>' .
				'<td>' . $rows->qty . '</td>' .
				'<td>' . $rows->diskon . '</td>' .
				'<td>' . number_format($rows->sub_total, 0, '', '.') . '</td>' .
				'<td><div class="hidden-md hidden-lg">
				<div class="inline pos-rel">
					<button type="button" class="btn-xs	 btn-block btn-outline-danger small" onclick=delete_tabtemp(' . "'" . $rows->id_penjualan . "'" . ')> <i class="fa fa-trash"></i> Hapus</button>
				</div>
				</div>
				</td>' .
				'</tr>';
			$no++;
		}
		$total = '<tr>' .
			'<td colspan="5"></td>' .
			'<td>Total</td>' .
			'<td>' . $total_temp . '</td>' .
			'</tr>';
		echo $result . $total;
	}

	public function showproduk($searchby = null)
	{
		// $something = $this->request->getVar('foo');
		$model = new Pos_model();
		$mbeli = new Pembelian_model();
		$dataProduk = $model->getDataProdukBySearch($searchby)->getRow();
		$hbeliterakhir = $mbeli->getHargaBeliTerakhir($searchby)->getRow();
		$margin = $model->getmargin()->getRow()->margin;


		$hbeli = 0;
		$stok = 0;

		if ($hbeliterakhir != NULL) {
			$hbeli = $hbeliterakhir->harga;
		}
		$hjual = $hbeli + ($hbeli * ($margin / 100));
		$stok = $dataProduk->stok == NULL ? 0 : $dataProduk->stok;
		$disableqty = $stok == 0 ? "disabled" : "";

		echo '
		<div class="form-group">
		<div class="col-sm-6">
				<img hidden id="img_produk" src="' . base_url("resources/dist/img/avatar.png") . '" style="width: inherit;height: inherit;" />
		</div>
			<div class="row" style="padding: 10px;">
				<label class="control-label col-md-3">Eceran</label>
				<div class="col-md-3">
					<input name="heceran" disabled id="heceran" class="form-control" value="' . $hjual . '" type="number">
					<span class="help-block"></span>
				</div>

				<label class="control-label col-md-3">Grosir</label>
				<div class="col-md-3">
					<input name="hgrosir" disabled id="hgrosir" class="form-control" value="' . $dataProduk->harga_grosir . '" type="number">
					<span class="help-block"></span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row" style="padding: 10px;">
				<div class="col-md-6">
				<label class="control-label col-md-5">Sisa Stok</label>
					<input name="stok" disabled id="stok" class="form-control" value="' . $stok . '" type="number">
					<span class="help-block"></span>
				</div>
				<div class="col-md-6">
				<label class="control-label col-md-3">Qty</label>
					<input min=0 oninput="validity.valid||(value="");" name="qty" ' . $disableqty . ' id="qty" onchange="subTotal(this.value)" 
					onkeyup="subTotal(this.value)"  class="form-control" type="number">
					<span class="help-block"></span>
				</div>
			</div>
			<div class="col-md-6">
                            <label class="control-label col-md-5">Sub Total</label>
                            <input name="subtotal" disabled id="subtotal" class="form-control">
                            <span class="help-block"></span>
						</div>
						
		</div>
		

		<input type="hidden" name="kd_produk" id="kd_produk" value="' . $dataProduk->kd_produk . '"/>
		<input type="hidden" name="nama_produk" id="nama_produk" value="' . $dataProduk->nama_produk . '"/>
		<input type="hidden" name="tot_stok" id="tot_stok" value="' . $dataProduk->stok . '"/>
		<input type="hidden" name="url_image" id="url_image" value="' . $dataProduk->gambar . '"/>
		<input type="hidden" name="hrg_eceran" id="hrg_eceran" value="' . $dataProduk->harga_eceran . '"/>
		<input type="hidden" name="hrg_grosir" id="hrg_grosir" value="' . $dataProduk->harga_grosir . '"/>
	';
	}
}
