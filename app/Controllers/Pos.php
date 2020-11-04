<?php

namespace App\Controllers;

use App\Models\Pos_model;
use App\Models\Pembelian_model;
use App\Models\Setting_model;
use App\Models\Auth_model;

class Pos extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}


	public function index()
	{
		if ($this->session->username) :
			$modelPos = new Pos_model();
			$data = array();
			$data = array(
				'nota_penjualan' => $this->getNotaPenjualan(),
				'item_produk' => $modelPos->getListProduk()->getResult(),
				'item_kategori' => $modelPos->getKategoriProduk()->getResult(),
			);

			//empty data sebelumnya
			$modelPos->delTablePenjualantmp($this->getNotaPenjualan());
			$data['username'] = $_SESSION['username'];
			$modelaut = new Auth_model();
			$menu = '';
			foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

				$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
				$menu .=	'<ul class="nav nav-treeview">';
				foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
					$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
				}
				$menu .= '</ul>';

				$menu .= '</li>';
			}

			$data['menu'] = $menu;
			return view('kasir/kasir_view', $data);
		else :
			return redirect()->to(base_url('login'));
		endif;
	}

	public function mobile()
	{
		$modelPos = new Pos_model();
		$data = array();
		$data = array(
			'nota_penjualan' => $this->getNotaPenjualan(),
			'item_produk' => $modelPos->getListProduk()->getResult(),
			'item_kategori' => $modelPos->getKategoriProduk()->getResult(),
		);

		//empty data sebelumnya
		$modelPos->delTablePenjualantmp($this->getNotaPenjualan());
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('kasir/mobile_kasir_view', $data);
	}

	//--------------------------------------------------------------------

	public function getNotaPenjualan()
	{
		$var_head = "JL";
		return $var_head . date('ymdHis');
	}

	public function updateQtyTemp()
	{
		$modelPos = new Pos_model();
		$qty = $this->request->getVar('qty');
		$id_item_temp = $this->request->getVar('id_item_penjualan');
		$response = array();

		$cekRow = $modelPos->getProdukSearch($id_item_temp);
		$u_subtotal = $cekRow->getRow()->harga;
		$update = $modelPos->updateTempQtyPenjualan($id_item_temp, $qty, intval($u_subtotal) * $qty);
		// $response['']
		if ($update != NULL) {
			$response['success'] = true;
			$response['harga'] = $cekRow->getRow()->harga;
		} else {
			$response['success'] = false;
		}
		echo json_encode($response);
	}

	public function getTempCheck($kode_trx)
	{
		$modelPos = new Pos_model();
		$listTemp = $modelPos->getTrxPenjualanTemporary($kode_trx);

		foreach ($listTemp->getResult('array') as $rows) {
			// echo "<pre>";
			// var_dump($rows);
			// echo "</pre>";
			$this->cekKolom($rows['kd_produk'], $rows['qty'], $rows);
		}
	}
	/**
	 * Untuk mengupdate data stok di tr pembelian
	 * 1.loop dari tr pemb_tmp 
	 * 2.update stok peritem
	 */
	public function cekKolom($kode_produk, $jumlah_beli, $data = array())
	{
		$dataTemp = $data;
		$mbeli = new Pembelian_model();
		$modelPos = new Pos_model();
		$sql_cek = $mbeli->cekStok($kode_produk);
		$ceking = $sql_cek->getRow();

		// var_dump($ceking);
		// echo "</br>";
		// // $data['qty_2']=10;
		// var_dump($data);
		// // exit();
		// echo "</br>";
		$_row = $sql_cek->getRow();

		// var_dump($_row);

		// exit();

		if (isset($_row)) {
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
				$dataTemp['qty'] = $stokIntemp;
				$dataTemp['kd_trx_pembelian'] = $id_mpembelian;
				$dataTemp['id_pembelian'] = $id_beli;
				$dataTemp['total'] = doubleval($dataTemp['harga'] * $stokIntemp);
				// var_dump($dataTemp);
				// exit();
				$r_insert = $modelPos->addDataTrxPenjualan($dataTemp);
				// var_dump($data);
				// exit();
				//cek jika update berhasil lakukan cek lagi apabila sisa masih minus
				if ($sisa < 0) {
					$min_stok = $this->hasilminus($sisa);
					$this->cekKolom($kode_produk, $x, $dataTemp);
				} else {
					// echo "Update Selesai";
					// $response = array();
					// if ($r_insert != NULL) {
					// 	$response['success'] = true;
					// } else {
					// 	$response['success'] = false;
					// }
					// echo json_encode($response);
				}
			} else {
				//kosong end!
				// $response = array();
				// $response['success'] = false;
				// $response['message'] = 'kosong';
				// echo json_encode($response);
			}
		} 
		else {
			//echo 0;
			// $response = array();
			// $response['success'] = false;
			// $response['message'] = 'kosong';
			// echo json_encode($response);
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
		$modelPos = new Pos_model();
		$mbeli = new Pembelian_model();

		$isupdate  = $this->request->getVar('update_qty');
		$Isicon    = $this->request->getVar('is_icon');
		$kd_produk = $this->request->getVar('kd_produk');
		$tipe_trx = $this->request->getVar('tipe_search');
		$margin 	   = $modelPos->getmargin()->getRow()->margin;

		if ($tipe_trx == 0) {
			$qty       = $this->request->getVar('qty');
			//if from icon
			$dataProduk    = $modelPos->getDataProdukBySearch($kd_produk)->getRow();
			$hbeliterakhir = $mbeli->getHargaBeliTerakhir($kd_produk)->getRow();

			$hbeli = 0;
			$stok = 0;

			if ($hbeliterakhir != NULL) {
				$hbeli = $hbeliterakhir->harga;
			}
			$hjual = $hbeli + ($hbeli * ($margin / 100));
			$stok = $dataProduk->stok == NULL ? 0 : $dataProduk->stok;
			// $disableqty = $stok == 0 ? "disabled" : "";
			$inqty = $stok > 0 ? 1 : 0;

			$margin   = $modelPos->getmargin()->getRow()->margin;
			$hg_ecer = 0;
			$nama_brg = "";
			if ($Isicon != NULL) {
				if ($Isicon == "yes") {
					$hg_ecer = $hjual;
					$nama_brg = $this->request->getVar('nama_barang');
				} else {
					$hg_ecer = $this->request->getVar('hrg_eceran');
					$nama_brg = $this->request->getVar('nama_produk');
				}
			} else {
				$hg_ecer = $this->request->getVar('hrg_eceran');

				$nama_brg = $this->request->getVar('nama_produk');
			}

			$data = array(
				'kd_trx_penjualan' => $this->request->getVar('kd_trxpenjualan'),
				'kd_produk'  => $kd_produk,
				'harga'  => $hg_ecer,
				'nama_barang'  => $nama_brg,
				'diskon' => 0,
				'created_date' => date("Y-m-d"),
			);
			if ($isupdate > 0) {
				//update 
				$modelPos->deleteproduk($kd_produk);
				// $this->cekKolom($kd_produk, $qty, $data);
			} else {
				//cek dlu
				// $this->cekKolom($kd_produk, $qty, $data);
				$response = array();
				$data['qty'] = $qty;
				$data['kd_trx_pembelian'] = '1000';
				$data['id_pembelian'] = '1000';
				$data['sub_total'] = intval($data['harga'] * $qty);

				$r_insert = $modelPos->addDataPenjualanTemp($data);
				if ($r_insert != NULL) {
					$response['success'] = true;
				} else {
					$response['success'] = false;
				}
				echo json_encode($response);
			}
		} else if ($tipe_trx == 2) {
			// if (strpos($searchby, '=') !== false) {
			// 	$_arrsearch = array(
			// 		'nama_produk' => $searchby,
			// 		'harga' => 0,
			// 		'count' => 1
			// 	);
			// 	$model->addTotempSearch($_arrsearch);
			// }

			$var_item = explode("=", $kd_produk);
			$_arrsearch = array(
				'nama_produk' => $var_item[0],
				'harga' => sizeof($var_item) > 2 ? $var_item[2] : 0,
				'count' => 1
			);
			// $_arrsearch = array(
			// 			'nama_produk' => $var_item[0],
			// 			'harga' => 0,
			// 			'count' => 1
			// 		);
			// $model->addTotempSearch($_arrsearch);
			//jika ada yg sama update sesuai idnya 
			$hasil_temp = $modelPos->getDataProdukSearchTemp($var_item[0])->getResult('array');
			// print_r($hasil_temp[0]['id']);
			// exit();
			if (sizeof($hasil_temp) > 0) {
				$idTempS = $hasil_temp[0]['id'];
				$modelPos->updateTempSearch($idTempS, $var_item[0], sizeof($var_item) > 2 ? $var_item[2] : 0);
			} else {
				$modelPos->addTotempSearch($_arrsearch);
			}
			$qty = 1;
			$data = array(
				'kd_trx_penjualan' => $this->request->getVar('kd_trxpenjualan'),
				'kd_produk'  => $kd_produk,
				'harga'  => sizeof($var_item) > 2 ? $var_item[2] : 0,
				'qty'  => $var_item[1],
				'nama_barang'  => $var_item[0],
				'diskon' => 0,
				'created_date' => date("Y-m-d"),
			);
			$response = array();
			// $data['qty'] = $qty;
			$data['kd_trx_pembelian'] = '1000';
			$data['id_pembelian'] = '1000';
			$data['sub_total'] = sizeof($var_item) > 2 ? doubleval($var_item[2]) * doubleval($var_item[1]) : 0;
			$r_insert2 = $modelPos->addDataPenjualanTemp($data);
			if ($r_insert2 != NULL) {
				$response['success'] = true;
			} else {
				$response['success'] = false;
			}
			echo json_encode($response);
		} else {
			$qty = 1;
			$data = array(
				'kd_trx_penjualan' => $this->request->getVar('kd_trxpenjualan'),
				'kd_produk'  => $kd_produk,
				'harga'  => 0,
				'nama_barang'  => $this->request->getVar('nama_produk'),
				'diskon' => 0,
				'created_date' => date("Y-m-d"),
			);
			$r_insert2 = $modelPos->addDataPenjualanTemp($data);
			$response = array();
			$data['qty'] = $qty;
			$data['kd_trx_pembelian'] = '1000';
			$data['id_pembelian'] = '1000';
			$data['sub_total'] = 0;
			if ($r_insert2 != NULL) {
				$response['success'] = true;
			} else {
				$response['success'] = false;
			}
			echo json_encode($response);
		}
	}

	public function selesai()
	{
		$id_trx_penjualan = $this->request->getVar('kd_trxpenjualan');
		// $id_trx_penjualan = 'JL201024180555';
		$modelPos = new Pos_model();
		$this->getTempCheck($id_trx_penjualan);
		$response = array();
		$data = array();
		$data['total_penjualan'] = $modelPos->getTotalPenjualan($id_trx_penjualan)->getRow('sub_total');
		// var_dump($data);
		// exit();
		$data['kd_trx_penjualan'] = $id_trx_penjualan;
		$data['ongkir'] = 0;
		$data['diskon_nota'] = 0;
		$data['delivery'] = '0';
		$data['id_pelanggan'] = 0;
		$data['nama_pelanggan'] = "-";
		$data['id_kasir'] = 0;
		$data['created_by'] = 0;
		$data['keterangan'] = "-";
		$data['created_date'] = date("Y-m-d");

		$res_add = $modelPos->addMasterPenjualan($data);
		$modelPos->selesaiTrx();
		if ($res_add != NULL) {
			$response['success'] = true;
			echo json_encode($response);
		} else {
			//gagal
			$response['success'] = false;
			echo json_encode($response);
		}
	}

	public function getTotalBelanjaItem($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$r_total_item = $mdata->getTotalJenisProduk($kd_trxjual);
		$r_total_qty = $mdata->getTotalProdukQty($kd_trxjual);
		$totalelanja = $r_total->getRow('sub_total');
		echo '<input placeholder="Total" name="mtotal_belanja" disabled id="mtotal_belanja" value="' . number_format($totalelanja, 0, '', '.') . '" type="text"  class="form-control">
									<span class="help-block"></span>
									<label>Jenis Produk</label>
                                    <h3>' . $r_total_item->getRow('total') . '</h3>
									</div>
									<div><label>Total Produk</label>
									<h3>' . $r_total_qty->getRow('qty') . '</h3>
									</div>';
	}

	public function getTotalBelanja($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$r_total_item = $mdata->getTotalJenisProduk($kd_trxjual);
		$r_total_qty = $mdata->getTotalProdukQty($kd_trxjual);
		$totalelanja = $r_total->getRow('sub_total');
		echo '<input placeholder="Total" name="mtotal_belanja" disabled id="mtotal_belanja" value="' . number_format($totalelanja, 0, '', '.') . '" type="text"  class="form-control">
									</div>';
	}

	public function showTableTemp($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_temp  = $mdata->getTablePenjualantmp($kd_trxjual);
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$result = '';
		$no = 1;
		$total_temp = number_format($r_total->getRow('sub_total'), 0, '', '.');

		foreach ($r_temp->getResult() as $rows) {
			$info_tooltip = $rows->nama_barang . "\n" . "Sisa 10";
			$gambar = $rows->gambar == null ? "-" : $rows->gambar;
			$result .= '<tr class="tb-trx" rel-tb="' . $gambar . '" data-toggle="tooltip" data-placement="left" title="' . $info_tooltip . '">' .
				// '<td>' . $no . '</td>' .
				'<td >' . substr($rows->nama_barang, 0, 12) . '<br>' . $rows->qty . ' x ' . number_format($rows->harga, 0, '', '.') . '</td>' .
				// '<td align="right">' .  number_format($rows->harga, 0, '', '.') . '</td>' .
				// '<td align="right" style="background-color:#bdbdbd" onClick="show_qtyedit('.$rows->id_penjualan.')">' . $rows->qty . '</td>' .
				// '<td>' . $rows->diskon . '</td>' .
				'<td align="right">' . number_format($rows->sub_total, 0, '', '.') . '</td>' .
				'<td><div class="hidden-md hidden-lg">
				<div class="inline pos-rel">
					<a href="#" data-toggle="tooltip" data-placement="top" title="Hapus Item" class="btn-xs small danger" onclick=hapus_temp(' . $rows->id_penjualan . ')> <i class="fa fa-trash"></i></a>
				</div>
				</div>
				</td>' .
				'</tr>';
			$no++;
		}
		$total = '<tr>' .
			'<td colspan="1"></td>' .
			'<td >Total</td>' .
			'<td colspan="2" align="right">' . $total_temp . '</td>' .
			// '<td></td>' .
			'</tr>';
		echo $result . $total;
	}
	public function showTableTempv1($kd_trxjual)
	{
		$mdata = new Pos_model();
		$r_temp  = $mdata->getTablePenjualantmp($kd_trxjual);
		$r_total = $mdata->getTotalPenjualan($kd_trxjual);
		$result = '';
		$no = 1;
		$total_temp = number_format($r_total->getRow('sub_total'), 0, '', '.');

		print_r($r_temp->getResult());
		foreach ($r_temp->getResult() as $rows) {
			$info_tooltip = $rows->nama_barang . "\n" . "Sisa 10";
			$gambar = $rows->gambar == null ? "-" : $rows->gambar;
			$result .= '<tr class="tb-trx" rel-tb="' . $gambar . '" data-toggle="tooltip" data-placement="left" title="' . $info_tooltip . '">' .
				// '<td>' . $no . '</td>' .
				'<td >' . substr($rows->nama_barang, 0, 10) . '</td>' .
				'<td align="right">' .  number_format($rows->harga, 0, '', '.') . '</td>' .
				'<td align="right" style="background-color:#bdbdbd" onClick="show_qtyedit(' . $rows->id_penjualan . ')">' . $rows->qty . '</td>' .
				// '<td>' . $rows->diskon . '</td>' .
				'<td align="right">' . number_format($rows->sub_total, 0, '', '.') . '</td>' .
				'<td><div class="hidden-md hidden-lg">
				<div class="inline pos-rel">
					<a href="#" data-toggle="tooltip" data-placement="top" title="Hapus Item" class="btn-xs small danger" onclick=hapus_temp('  . $rows->id_penjualan . ')> <i class="fa fa-trash"></i></a>
				</div>
				</div>
				</td>' .
				'</tr>';
			$no++;
		}
		$total = '<tr>' .
			'<td colspan="3"></td>' .
			'<td >Total</td>' .
			'<td colspan="2" align="right">' . $total_temp . '</td>' .
			// '<td></td>' .
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
		$dataProduk      = $model->getDataProdukBySearch($searchby)->getRow();
		$dataProduk_size = sizeof($model->getDataProdukBySearch($searchby)->getResult('array'));
		$hbeliterakhir   = $mbeli->getHargaBeliTerakhir($searchby)->getRow();
		$margin 	     = $model->getmargin()->getRow()->margin;

		$hbeli = 0;
		$stok = 0;

		if ($hbeliterakhir != NULL) {
			$hbeli = $hbeliterakhir->harga;
		} else {
			$hbeli = 0;
		}
		$hjual = $hbeli + ($hbeli * ($margin / 100));
		if ($dataProduk_size > 0) {
			$stok = $dataProduk->stok == NULL ? 0 : $dataProduk->stok;
		} else {
			$stok = 0;
		}
		$disableqty = $stok == 0 ? "disabled" : "";
		$inqty = $stok > 0 ? 1 : 0;
		$hgrosir = $dataProduk_size > 0 ? $dataProduk->harga_grosir : 0;
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
						<input name="hgrosir" disabled id="hgrosir" class="form-control" value="' . $hgrosir . '" type="number">
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
					onkeyup="subTotal(this.value)"  class="form-control" type="number" max="' . $stok . '" value="' . $inqty . '" >
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
		';
		if ($dataProduk_size > 0) {
			echo '
		<input type="hidden" name="kd_produk" id="kd_produk" value="' . $dataProduk->kd_produk . '"/>
		<input type="hidden" name="nama_produk" id="nama_produk" value="' . $dataProduk->nama_produk . '"/>
		<input type="hidden" name="tot_stok" id="tot_stok" value="' . $dataProduk->stok . '"/>
		<input type="hidden" name="url_image" id="url_image" value="' . $dataProduk->gambar . '"/>
		<input type="hidden" name="hrg_eceran" id="hrg_eceran" value="' . $hjual . '"/>
		<input type="hidden" name="hrg_grosir" id="hrg_grosir" value="' . $dataProduk->harga_grosir . '"/>
		<input type="hidden" name="tipe_search" id="tipe_search" value="0"/>';
		} else {
			$dataProdukV2      = $model->getDataProdukSearchByKodeTemp($searchby)->getRow();
			//cari di kolom tb
			echo '<input type="hidden" name="kd_produk" id="kd_produk" value="' . $dataProdukV2->kd_produk . '"/>
		          <input type="hidden" name="nama_produk" id="nama_produk" value="' . $dataProdukV2->nama_produk . '"/>';
			echo '<input type="hidden" name="tipe_search" id="tipe_search" value="1"/>';
		}
	}

	public function showprodukkategori($kat)
	{
	}
}
