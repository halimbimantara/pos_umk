<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;

class Produk extends BaseController
{
	protected $request;
	function __construct()
	{
		$request = \Config\Services::request();
    }

    public function index()
	{
		$mpos= new Produk_model();
		$data = [
			'pager' => $mpos->pager,
			'produk' => $mpos->paginate(10),
		];
		return view('admin/product_view', $data);
	}

	public function addProduk()
	{
		$model = new Produk_model();
		$data = array(
			'kd_barcode' => $this->request->getVar('kd_barcode'),
			'kd_produk' => $this->request->getVar('kd_produk'),
			'nama_produk' => $this->request->getVar('nama_produk'),
			'id_kategori'  => $this->request->getVar('id_kat'),
			'kd_satuan'  => $this->request->getVar('kd_satuan'),
			'batas_grosir'  => $this->request->getVar('batas_grosir'),
			'harga_eceran'  => $this->request->getVar('add_harga'),
			'harga_grosir'  => $this->request->getVar('harga_grosir'),
			'batas_min_stok'  => $this->request->getVar('b_min_stok'),
			'batas_max_stok'  => $this->request->getVar('b_max_stok'),
			'created_date'  => date('Y-m-d')
		);

		$r_insert = $model->addProduk($data);
		$response = array();
		if ($r_insert != NULL) {
			$response['success'] = true;
		} else {
			$response['success'] = false;
		}
		echo json_encode($response);
	}

	public function editProduk()
	{
		$model = new Produk_model();
		$data = array(
			'kd_barcode' => $this->request->getVar('kd_barcode'),
			'kd_produk' => $this->request->getVar('kd_produk'),
			'nama_produk' => $this->request->getVar('nama_produk'),
			'id_kategori'  => $this->request->getVar('id_kat'),
			'kd_satuan'  => $this->request->getVar('kd_satuan'),
			'batas_grosir'  => $this->request->getVar('batas_grosir'),
			'harga_grosir'  => $this->request->getVar('harga_grosir'),
			'batas_min_stok'  => $this->request->getVar('b_min_stok'),
			'batas_max_stok'  => $this->request->getVar('b_max_stok'),
			'created_date'  => date('Y-m-d')
		);

		// $r_update = $model->editProduk($id,$data)
		// $response = array();
		// if ($r_insert != NULL) {
		// 	$response['success'] = true;
		// } else {
		// 	$response['success'] = false;
		// }
		// echo json_encode($response);
	}
}