<?php

namespace App\Controllers;

use App\Models\Pos_model;
use App\Models\Pembelian_model;
use App\Models\Setting_model;

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

	public function cekKolom($kode_produk, $jumlah_beli, $data = array())
	{
		$dataTemp = $data;
		$mbeli = new Pembelian_model();
		$modelPos = new Pos_model();
		$sql_cek = $mbeli->cekStok($kode_produk);
		$ceking = $sql_cek->getRow();
		// var_dump($ceking);
		// echo "</br>";
		// $data['qty_2']=10;
		// var_dump($data);
		// exit;
		if ($sql_cek != null) {
			//cek jumlah stok yang tersedia di row yang pertama
			$result = $ceking;

			$id_detailpemb = $result->id_pembelian;
			$st_tersedia   = $result->stok; //stok tersedia
			$id_mpembelian = $result->kd_trx_pembelian;
			$hg_beli       = $result->harga;
			$id_beli       = $result->id_pembelian;

			//a=8,b=10
			//x=a-b
			//y=b-x
			if ($st_tersedia > 0) {
				//mengembalikan nilai stok yang tersedia apakah minus atau sisa
				//kemudian update dulu berdasarkan id_detail pembelian
				//dan apabila return minus maka lakukan pengecekan lagi di row selanjutnya 
				$sisa = intval($st_tersedia) - intval($jumlah_beli);

				$x = 0;
				$stotal = 0;
				$temp_stok = 0;
				$stokIntemp = 0;
				$Totallabas = 0.00;
				$total_laba = "";

				if ($sisa < 0) { //apabila ada sisa stok
					$temp_stok = 0;
					$x = $this->hasilminus($sisa);
					// echo "sisa :".$x."</br>";
					// $stotal = intval($hjual)*$x;
					// $stotal = intval($hjual) * $st_tersedia;
					$stokIntemp = $st_tersedia;
					// $Totallabas = doubleval($laba) * doubleval($st_tersedia);
					// $total_laba = strval($Totallabas);

				} else { //jika stok normal
					$temp_stok = $sisa;
					$x = $sisa;
					// echo "stok :".$x."</br>";
					// $stotal = intval($hjual) * ($st_tersedia - $x);
					$stokIntemp = $st_tersedia - $x; //qty yg terambil
					// $Totallabas  = doubleval($laba) * doubleval($stokIntemp);
					// $total_laba = strval($Totallabas);
				}
				//stok yang masuk ke temp
				//update pembelian => mengurangi stok di pembelian
				$update_stok = $mbeli->UpdateStokPembelian($id_detailpemb, $temp_stok);
				// insert ke table tmp
				$data['qty'] = $stokIntemp;
				$data['kd_trx_pembelian'] = $id_mpembelian;
				$data['id_pembelian'] = $id_beli;
				$data['sub_total'] = doubleval($data['harga'] * $stokIntemp);
				$r_insert = $modelPos->addDataPenjualanTemp($data);
				// var_dump($data);
				// exit();
				//cek jika update berhasil lakukan cek lagi apabila sisa masih minus
				if ($sisa < 0) {
					$min_stok = $this->hasilminus($sisa);
					$this->cekKolom($kode_produk, $x, $data);
				} else {
					// echo "Update Selesai";
					$response = array();
					if ($r_insert != NULL) {
						$response['success'] = true;
					} else {
						$response['success'] = false;
					}
					echo json_encode($response);
				}
			} else {
				//kosong end!
				$response = array();
				$response['success'] = false;
				$response['message'] = 'kosong';
				echo json_encode($response);
			}
		} else {
			//echo 0;
		}
	}

	private function hasilminus($jml)
	{
		$s = 0;
		$r = $s - $jml;
		return $r;
	}


	public function addproduktemp()
	{
		$qty       = $this->request->getVar('qty');
		$kd_produk = $this->request->getVar('kd_produk');

		$data = array(
			'kd_trx_penjualan' => $this->request->getVar('kd_trxpenjualan'),
			'kd_produk'  => $kd_produk,
			'harga'  => $this->request->getVar('hrg_eceran'),
			'nama_barang'  => $this->request->getVar('nama_produk'),
			'diskon' => 0,
			'created_date' => date("Y-m-d"),
		);

		//cek dlu
		$this->cekKolom($kd_produk, $qty, $data);
	}

	public function selesai()
	{
		$id_trx_penjualan = $this->request->getVar('kd_trxpenjualan');
		$modelPos = new Pos_model();
		$_excute = $modelPos->selesaiTrx();
		$response = array();
		if ($_excute != NULL) {
			// $this->cetak($id_trx_penjualan);
			$response['success'] = true;
			echo json_encode($response);
		} else {
			//gagal
			$response['success'] = false;
			echo json_encode($response);
		}
	}

	public function getTotalBelanja($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$totalelanja = $r_total->getRow('sub_total');
		echo '<div class="info-box-content">
		<label class="control-label">Total</label>
		<input type="hidden" name="mtotal_belanja" id="mtotal_belanja" value="' . $totalelanja . '"/>
		<h3><span style=" color: red;" class="info-box-number">' . number_format($totalelanja, 0, '', '.') . '</span></h3>
		</div>';
	}

	public function showTableTemp($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_temp = $mdata->getTablePenjualantmp($kd_trxjual);
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$result = '';
		$no = 1;
		$total_temp = number_format($r_total->getRow('sub_total'), 0, '', '.');
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
					<button type="button" class="btn-xs	 btn-block btn-outline-danger small" onclick=hapus_temp(' . "'" . $rows->id_penjualan . "'" . ')> <i class="fa fa-trash"></i> Hapus</button>
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

	public function hapus_temp()
	{
		$model = new Pos_model();
		$id_tempPenjualan = $this->request->getVar('id_penjualan');
		//kembalikan stok ke table origin
		//update 

		$r_delete = $model->delTempKasir($id_tempPenjualan);
		$response = array();
		if ($r_delete != NULL) {
			$response['success'] = true;
		} else {
			$response['success'] = false;
		}
		echo json_encode($response);
	}

	public function cetak($id_trx)
	{
		$msetting = new Setting_model();
		$data = array();
		$data['data'] = $msetting->getSetting();
		$mpos = new Pos_model();
		$_totalCetak = $mpos->getTotalPenjualanCetak($id_trx);
		$listItem = $mpos->cetakPenjualan($id_trx);

		$data = array();
		$data['total'] = $_totalCetak->getRow('total');
		// var_dump($listItem);
		// exit;
		$data['list'] = $listItem;
		$data['kembalian'] = 0;
		$data['bayar'] = 0;
		$data['no_nota'] = $id_trx;
		$data['tgl'] = date("d-m-Y");
		return view('kasir/cetak', $data);
	}

	public function showproduk($searchby = null)
	{
		$model = new Pos_model();
		$mbeli = new Pembelian_model();
		$dataProduk    = $model->getDataProdukBySearch($searchby)->getRow();
		$hbeliterakhir = $mbeli->getHargaBeliTerakhir($searchby)->getRow();
		$margin 	   = $model->getmargin()->getRow()->margin;


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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Eceran</label>
						<input name="heceran" disabled id="heceran" class="form-control" value="' . $hjual . '" type="number">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Grosir</label>
						<input name="hgrosir" disabled id="hgrosir" class="form-control" value="' . $dataProduk->harga_grosir . '" type="number">
                      </div>
                    </div>
                  </div>
		</div>
			<div class="row" style="padding: 10px;">
				<div class="col-sm-6">
				<label class="control-label">Stok</label>
					<input name="stok" disabled id="stok" class="form-control" value="' . $stok . '" type="number">
					<span class="help-block"></span>
				</div>
				<div class="col-sm-6">
				<label class="control-label ">Qty</label>
					<input min=0 oninput="validity.valid||(value="");" name="qty" ' . $disableqty . ' id="qty" onchange="subTotal(this.value)" 
					onkeyup="subTotal(this.value)"  class="form-control" type="number" max="' . $stok . '">
					<span class="help-block"></span>
				</div>
			</div>
		</div>
		<div class="card card-warning">
       <div class="card-body">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label class="control-label">Sub Total</label>
					<input name="subtotal" disabled id="subtotal" class="form-control">
				</div>
			<div class="col-sm-6">
			<label class="control-label col-sm-6" style="margin-top: 18px;"></label>
				<button id="btn_addtmp" type="submit" onclick="addbarangtemp()" class="btn btn-primary form-control">Tambah</button>
			</div>		
		</div>
		</div>
		

		<input type="hidden" name="kd_produk" id="kd_produk" value="' . $dataProduk->kd_produk . '"/>
		<input type="hidden" name="nama_produk" id="nama_produk" value="' . $dataProduk->nama_produk . '"/>
		<input type="hidden" name="tot_stok" id="tot_stok" value="' . $dataProduk->stok . '"/>
		<input type="hidden" name="url_image" id="url_image" value="' . $dataProduk->gambar . '"/>
		<input type="hidden" name="hrg_eceran" id="hrg_eceran" value="' . $hjual . '"/>
		<input type="hidden" name="hrg_grosir" id="hrg_grosir" value="' . $dataProduk->harga_grosir . '"/>
	';
	}
}
