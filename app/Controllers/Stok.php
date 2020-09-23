<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;

class Stok extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}
	public function index()
	{
		
		$mpos = new Produk_model();
		$data['produk'] = $mpos->ceksisastok()->getResult();
		$data['kategori']=$mpos->getListKategori(0)->getResult();

		$data['suplier'] = $mpos->getSuplier()->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/stok', $data);
	}
}
