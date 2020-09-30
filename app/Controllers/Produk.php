<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Pos_model;
use App\Models\Produk_model;
use App\Models\Auth_model;

class Produk extends BaseController
{
	protected $request;
	function __construct()
	{
		$request = \Config\Services::request();
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$mpos = new Produk_model();
		$m_margin = new Pos_model();
		$margin 	   = $m_margin->getmargin()->getRow()->margin;
		$data = [
			'produk' => $mpos->showproduk()->getResult()
		];
		$data['margin'] = $margin;
		$data['kemasan'] = $mpos->getListKemasan(0)->getResult();
		$data['kategori'] = $mpos->getListKategori(0)->getResult();
		$data['suplier'] = $mpos->getSuplier()->getResult();
		if($this->session->username){
			$data['username'] = $this->session->username;
			$modelaut = new Auth_model();
			$menu = '';
			foreach($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu){

				$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							'.$getmenu->menu.'
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
				$menu .=	'<ul class="nav nav-treeview">';
					foreach($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu){
						$menu .=	'<li class="nav-item">
								<a href="'.base_url("$getsubmenu->url").'" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>'.$getsubmenu->submenu.'</p>
								</a>
							</li>';
					}
				$menu .= '</ul>';

				$menu .= '</li>';
			}

			$data['menu'] = $menu;
			return view('admin/product_view', $data);
		} else {
			return redirect()->to(base_url('login'));
		}
	}



	public function addProduk()
	{
		$model = new Produk_model();
		$data = array(
			'kd_barcode' => $this->request->getVar('kd_barcode'),
			'kd_produk' => $this->request->getVar('kd_barcode'),
			'nama_produk' => $this->request->getVar('nama_produk'),
			'id_kategori'  => $this->request->getVar('id_kat'),
			'k1'  => $this->request->getVar('kemasan_k1'),
			'batas_grosir'  => $this->request->getVar('batas_grosir'),
			'id_kategori'  => $this->request->getVar('kategori'),
			'harga_eceran'  => $this->request->getVar('add_harga'),
			'harga_grosir'  => $this->request->getVar('harga_grosir'),
			'batas_min_stok'  => $this->request->getVar('b_min_stok'),
			'batas_max_stok'  => $this->request->getVar('b_max_stok'),
			'created_date'  => date('Y-m-d')
		);

		$response = array();
		// if (!$this->validate([
		// 	'kd_barcode' => 'required',
		// 	'kd_produk' => 'required',
		// ])) {
		// 	$response['success'] = false;
		// 	$response['message'] = "Harap isi data dengan benar";
		// } else {
		$avatar = $this->request->getFile('customFile');
		$avatar->move(ROOTPATH . 'public/uploads');

		$data = [
			'gambar_produk' => $avatar->getName()
		];
		$r_insert = $model->addProduk($data);
		if ($r_insert != NULL) {
			$response['success'] = true;
		} else {
			$response['success'] = false;
		}
		// }
		echo json_encode($response);
	}

	public function editProduk()
	{
		$model = new Produk_model();

		$kd_produk = $this->request->getVar('Ekd_produk');
		$harga_eceran = $this->request->getVar('eharga_meceran');
		$h_manual = $this->request->getVar('c_setharga');

		$data = array(
			'kd_barcode' => $this->request->getVar('Ekd_barcode'),
			// 'kd_produk' => $this->request->getVar('Ekd_produk'),
			'nama_produk' => $this->request->getVar('Enama_produk'),
			// 'kd_satuan'  => $this->request->getVar('kd_satuan'),
			// 'batas_grosir'  => $this->request->getVar('batas_grosir'),
			// 'harga_grosir'  => $this->request->getVar('harga_grosir'),
			'batas_min_stok'  => $this->request->getVar('eb_min_stok'),
			'batas_max_stok'  => $this->request->getVar('eb_max_stok'),
			'created_date'  => date('Y-m-d')
		);

		// $r_update = $model->editproduk($kd_produk,$data);
		// if ($r_update != NULL) {
		// 	session()->setFlashdata('success', 'Update Suplier successfully');
		// } else {
		// 	session()->setFlashdata('failed', 'Update Suplier failed');
		// }
		// return redirect()->to(base_url('suplier'));

		if ($h_manual) {
			echo "manual";
		} else {
			echo "margin";
		}
	}

	public function genbarcode()
	{
		// cek di db
		$model = new Produk_model();
		$random_number = substr(number_format(time() * rand(), 0, '', ''), 0, 12);
		$isready = $model->cekBarcode($random_number);

		// echo $random_number;
		if ($isready > 0) {
			$random_number = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
		} else {
			$result = $random_number;
		}
		echo $result;
	}
}
